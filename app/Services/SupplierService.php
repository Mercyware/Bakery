<?php

namespace App\Services;


use App\API\PayStackAPI;
use App\Interfaces\IBankService;
use App\Interfaces\IPaymentRepository;
use App\Interfaces\IPaymentService;
use App\Interfaces\ISupplierRepository;
use App\Interfaces\ISupplierService;
use App\Repository\SupplierRepository;
use GuzzleHttp\Exception\GuzzleException;
use http\Encoding\Stream\Inflate;
use Yajra\DataTables\DataTables;

class SupplierService implements ISupplierService
{
    /**
     * @var SupplierRepository
     */
    private $supplierRepository;
    /**
     *
     * /**
     * @var IBankService
     */
    private $bankService;
    /**
     * @var IPaymentRepository
     */
    private $paymentRepository;
    /**
     * @var PayStackAPI
     */
    private $payStackAPI;

    /**
     * SupplierService constructor.
     * @param ISupplierRepository $supplierRepository
     * @param PayStackAPI $payStackAPI
     * @param IBankService $bankService
     * @param IPaymentRepository $paymentRepository
     */
    public function __construct(ISupplierRepository $supplierRepository, PayStackAPI $payStackAPI,
                                IBankService $bankService,
                                IPaymentRepository $paymentRepository)
    {
        $this->supplierRepository = $supplierRepository;

        $this->bankService = $bankService;
        $this->paymentRepository = $paymentRepository;
        $this->payStackAPI = $payStackAPI;
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
            ->editColumn('amount', function ($suppliers) {
                return "#" . number_format($suppliers->Supplies->sum('amount') - $suppliers->Payment->sum('amount'));
            })
            ->editColumn('action', function ($suppliers) {
                $view = ' <a href="/suppliers/view/' . $suppliers->id . '" class="btn btn-warning btn-sm">View </a>';
                $update = ' <a href="/suppliers/edit/' . $suppliers->id . '" class="btn btn-primary btn-sm">Update </a>';
                return $update . $view;

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
            $payment_details = $this->payStackAPI->registerTransferRecipient($attributes);

            if ($payment_details != null) {
                if ($payment_details->getStatusCode() == 201) { // 201  Created
                    $response_data = json_decode($payment_details->getBody()->getContents());

                    $attributes->paystack_recipient_code = $response_data->data->recipient_code;
                    $supplier = $this->supplierRepository->addASupplier($attributes);
                    return "";

                }
                return json_decode($payment_details->getBody()->getContents())->message;
            }
            return "An unknown error has occurred";


        } catch (\Exception $exception) {

            return $exception->getMessage();
        } catch (GuzzleException $exception) {
            return $exception->getMessage();
        }


    }

    /**
     * Update Supplier Record
     * @param $attributes
     * @param $supplier_id
     * @return string
     */
    public function updateSupplierDetails($attributes, $supplier_id)
    {
        try {
            //Get  Bank Code
            $bank = $this->bankService->getABankByBankID($attributes->bank_id);
            $attributes->bank_code = $bank->bank_code;

            //Call API to store User details into Paystack API
            $payment_details = $this->payStackAPI->registerTransferRecipient($attributes);

            if ($payment_details != null) {
                if ($payment_details->getStatusCode() == 201) { // 201  Created
                    $response_data = json_decode($payment_details->getBody()->getContents());

                    $attributes->paystack_recipient_code = $response_data->data->recipient_code;
                    $supplier = $this->supplierRepository->updateASupplier($attributes, $supplier_id);
                    return "";

                }

                return json_decode($payment_details->getBody()->getContents())->message;
            }

            return "An error has occurred";
        } catch (\Exception $exception) {

            return $exception->getMessage();
        } catch (GuzzleException $exception) {
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
        $message = "Unknown error has occurred. Please try again";

        try {

            $supplier = $this->supplierRepository->getASupplierById($supplier_id);
            if (!$supplier) {

                $message = "Invalid Supplier Selected. Please Selected a valid Supplier";
            }


            //Check That User have balance to Pay
            $balance = $supplier->Supplies->sum('amount') - $supplier->Payment->sum('amount');

            if ($balance < $attributes->amount) {

                $message = "Unable to make payment to the user. You are trying to pay more than you owe. Please Selected a valid Supplier";
            }


            $attributes['recipient_code'] = $supplier->paystack_recipient_code; //Set Receipient Code
            //Call API to store User details into Paystack API
            $payment_details = $this->payStackAPI->initiateTransfer($attributes);
            if ($payment_details != null) {
                if ($payment_details->getStatusCode() == 200) { // 200  OKAY

                    $response_data = json_decode($payment_details->getBody()->getContents());
                    $attributes['transfer_code'] = $response_data->data->transfer_code;
                    $payment = $this->paymentRepository->storePaymentDetails($attributes);
                    $message = ""; // Payment Successful


                } else {
                    $message = json_decode($payment_details->getBody()->getContents())->message;
                }


            }

            return $message;

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
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function payMultipleSuppliers($attributes)
    {

        $selected_suppliers_id = $attributes->selected_suppliers;
        $transfer_details = array();
        $message = "Unknown error has occurred. Please try again";
        $status = false;

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
                "amount" => $attributes->amount_payed[$supplier_index] * 100,
                "recipient" => $supplier->paystack_recipient_code,
                "description"
            ];

            array_merge($transfer_details);

        }


        $attributes['suppliers_transfer_details'] = $transfer_details;
        $response = $this->payStackAPI->initiateBulkTransfer($attributes);

        if ($response != null) {
            if ($response->getStatusCode() == 200) {
                //Store Supplier Payment information into the Database
                $this->paymentRepository->storeBulkPaymentDetails($transfer_details);
                $message = "Bulk transfer is successful.";
                $status = true;
            } else {
                $message = json_decode($response->getBody()->getContents())->message;

                $status = false;
            }
        }


        //Pay Supplier

        $result = ["status" => $status, "message" => $message];

        return $result;
    }


    /**
     * @param $supplier_id
     * @return mixed|void
     * @throws \Exception
     */
    public function getAllSuppliersPaymentHistoryToDataTable($supplier_id)
    {
        if ($supplier_id > 0) {
            $payment = $this->paymentRepository->getPaymentsBySupplierId($supplier_id);
        } else {
            $payment = $this->paymentRepository->getAllPayments();

        }


        $start = 1;
        return DataTables::of($payment)
            ->addColumn('id', function ($payment) use (&$start) {
                return $start++;
            })
            ->editColumn('supplier', function ($payment) {
                return ($payment->Supplier->name);
            })
            ->editColumn('amount', function ($payment) {
                return "#" . number_format($payment->amount);
            })
            ->editColumn('date', function ($payment) {
                return ($payment->created_at->format('l jS \\of F Y h:i:s A'));
            })
            ->make(true);
    }
}
