<?php

namespace App\Services;


use App\Interfaces\IBankService;
use App\Interfaces\IPaymentService;
use App\Interfaces\ISupplierRepository;
use App\Interfaces\ISupplierService;
use App\Repository\SupplierRepository;
use Yajra\DataTables\DataTables;

class SupplierService implements ISupplierService
{
    /**
     * @var SupplierRepository
     */
    private $supplierRepository;
    /**
     * @var IPaymentInterface
     */
    private $payment;
    /**
     * @var IBankService
     */
    private $bankService;

    /**
     * SupplierService constructor.
     * @param ISupplierRepository $supplierRepository
     * @param IPaymentService $payment
     * @param IBankService $bankService
     */
    public function __construct(ISupplierRepository $supplierRepository, IPaymentService $payment, IBankService $bankService)
    {
        $this->supplierRepository = $supplierRepository;
        $this->payment = $payment;
        $this->bankService = $bankService;
    }


    /**
     * Get All Supplies into A Databable
     * @return mixed
     * @throws \Exception
     */
    public function getAllSuppliersToDataTables()
    {
        $suppliers = $this->supplierRepository->allSuppliers();


        $start = 1;
        return DataTables::of($suppliers)
            ->addColumn('check', function ($suppliers) use (&$start) {
                return '<input type="checkbox" name="selected_suppliers[]" value="' . $suppliers->id . '">';
            })

//            ->addColumn('id', function ($suppliers) use (&$start) {
//                return $start++;
//            })
            ->editColumn('amount', function ($suppliers) {
                return "#" . number_format($suppliers->Supplies->sum('amount') - $suppliers->Payment->sum('amount'));
            })
            ->editColumn('action', function ($suppliers) {
                return '<a href="/suppliers/view/' . $suppliers->id . '" class="btn btn-warning btn-sm">View </a>';

            })
            ->rawColumns(['check', 'action'])
            ->make(true);
    }

    /**
     * Get A Supplier details
     * @param $supplier_id
     * @return mixed
     */
    public function getASupplier($supplier_id)
    {
        $supplier = $this->supplierRepository->getASupplierById($supplier_id);
        return $supplier;

    }

    /**
     * Create new Supplier
     * @param $attributes
     * @return mixed|null
     */
    public function createSupplier($attributes)
    {
        try {
            //Get  Bank Code
            $bank = $this->bankService->getABankByBankID($attributes->bank_id);
            $attributes->bank_code = $bank->bank_code;

            //Call API to store User details into Paystack API
            $payment_details = $this->payment->registerTransferRecipient($attributes);


            if ($payment_details->getStatusCode() == 201) { // 201  Created
                $response_data = json_decode($payment_details->getBody()->getContents());

                $attributes->paystack_recipient_code = $response_data->data->recipient_code;
                $supplier = $this->supplierRepository->addASupplier($attributes);
                return "";

            }
            return json_decode($payment_details->getBody()->getContents())->message;

        } catch (\Exception $exception) {

            return $exception->getMessage();
        }


    }

    /**
     * Make Payment and store information in database
     * @param $attributes
     * @param $supplier_id
     * @return string
     */
    public function makePaymentToSupplier($attributes, $supplier_id)
    {
        try {

            $supplier = $this->supplierRepository->getASupplierById($supplier_id);

            if ($supplier) {

                $attributes['recipient_code'] = $supplier->paystack_recipient_code;


                //Call API to store User details into Paystack API
                $payment_details = $this->payment->initiateTransfer($attributes);


                if ($payment_details->getStatusCode() == 200) { // 200  OKAY

                    $response_data = json_decode($payment_details->getBody()->getContents());


                    $attributes['transfer_code'] = $response_data->data->transfer_code;

                    $payment = $this->payment->storePayment($attributes);

                    return "";

                }

                return json_decode($payment_details->getBody()->getContents())->message;
            }


        } catch (\Exception $exception) {

            return $exception->getMessage();
        }


    }

    /**
     * Get Suppliers Information using ID
     * @param $suppliers_id
     * @return mixed
     */
    public function getSuppliers($suppliers_id)
    {
        return $this->supplierRepository->getSuppliersByID($suppliers_id);
    }


    /**
     * Make Payment to Selected Multiple Suppliuers
     * @param $attributes
     */
    public function payMultipleSuppliers($attributes)
    {

        $selected_suppliers_id = $attributes->selected_suppliers;

        $transfer_details = array();

        //Check that There is a Selected Supplier
        if (count($selected_suppliers_id) <= 0) {
            $message = "Invalid Suppliers Selected. Please Selected a valid Suppliers";
            $status = false;
        }

        //Check that The Suppliers aren't getting more than owed
        $suppliers = $this->supplierRepository->getSuppliersByID($selected_suppliers_id);
        foreach ($suppliers as $supplier) {
            //Get Supplier Index
            $supplier_index = array_search($supplier->id, $selected_suppliers_id);

            $balance = $supplier->Supplies->sum('amount') - $supplier->Payment->sum('amount');


            if ($attributes->amount_payed[$supplier_index] > $balance) {
                $message = "You are trying to pay a supplier more than you owed. Supplier Name  : $supplier->name";
                $status = false;
                break;
            }
            $transfer_details[] = [
                'supplier_id' => $supplier->id,
                "amount" => $attributes->amount_payed[$supplier_index],
                "recipient" => $supplier->paystack_recipient_code,
                "description"
            ];

            array_merge($transfer_details);

        }

        $attributes['suppliers_transfer_details'] = $transfer_details;
        $response = $this->payment->initiateBulkTransfer($attributes);

        if ($response->getStatusCode() == 200) {

        //Store Supplier Payment information into the Databse

        }
        dd($response->getBody()->getContents());
        //  dd($transfer_details);


        //Pay Supplier

        $result = array(["status" => $status, "message" => $message]);

        return $result;
    }


}
