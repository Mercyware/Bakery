<?php

namespace App\Http\Controllers;


use App\Http\Requests\SupplierRequest;
use App\Interfaces\IBankService;
use App\Interfaces\ISupplierService;
use App\Models\Supplier;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    //

    /**
     * @var ISupplierService
     */
    private $supplierService;
    /**
     * @var IBankService
     */
    private $bankService;

    /**
     * SupplierController constructor.
     * @param ISupplierService $supplierService
     * @param IBankService $bankService
     */
    public function __construct(ISupplierService $supplierService, IBankService $bankService)
    {
        $this->middleware('auth');
        $this->supplierService = $supplierService;
        $this->bankService = $bankService;
    }

    /**
     * Suppliers View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allSuppliers()
    {
        $banks = $this->bankService->allBanks();

        return view('suppliers.index', compact('banks'));

    }

    /**
     * return a list of suppliers
     * @return mixed
     */
    public function getAllSuppliersToDataTable()
    {
        return $this->supplierService->getAllSuppliersToDataTables();
    }

    /**
     * View Supplier Information
     * @param $supplier_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function viewSupplier($supplier_id)
    {
        $supplier = $this->supplierService->getASupplier($supplier_id);
        if (!$supplier)
            return redirect()->back()->withErrors('Invalid Supplier Selected. Please Selected a valid Supplier');
        $balance = $supplier->Supplies->sum('amount') - $supplier->Payment->sum('amount');
        return view('suppliers.view', compact('supplier', 'balance'));
    }


    /**
     * Create a New Supplier
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createSupplier(SupplierRequest $request)
    {
        $response = $this->supplierService->createSupplier($request);
        if ($response != "")
            return redirect()->back()->withErrors($response . ', Please try again');
        session()->flash('message', "New Supplier information has been created");
        return redirect()->back();
    }

    /**
     * Edit Supplier Details
     * @param int $supplier_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editSupplier($supplier_id = 0)
    {
        $supplier = $this->supplierService->getASupplier($supplier_id);
        if (!$supplier)
            return redirect()->back()->withErrors('Invalid Supplier Selected. Please Selected a valid Supplier');
        $banks = $this->bankService->allBanks();
        return view('suppliers.edit', compact('supplier', 'banks'));
    }

    /**
     * Update Supplier Record
     * @param SupplierRequest $request
     * @param $supplier_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSupplier(SupplierRequest $request, $supplier_id)
    {
        $response = $this->supplierService->updateSupplierDetails($request, $supplier_id);
        if ($response != "")
            return redirect()->back()->withErrors($response . ', Please try again');
        session()->flash('message', " Supplier information has been updated");
        return redirect()->route('suppliers.view', $supplier_id);
    }

    /**
     * Make Payment / Transfer to Client's Account
     *
     * @param Request $request
     * @param $supplier_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paySupplier(Request $request, $supplier_id)
    {
        $response = $this->supplierService->makePaymentToSupplier($request, $supplier_id);
        if ($response != "")
            return redirect()->back()->withErrors($response . ', Please try again');

        session()->flash('message', "Payment Successfully Transferred");
        return redirect()->back();
    }


    /**
     * Get A list of Selected Supplier to Pay
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function payMultipleSupplier(Request $request)
    {

        $selected_suppliers_id = $request->selected_suppliers;

        if (!$selected_suppliers_id || count($selected_suppliers_id) <= 0)
            return redirect()->back()->withErrors('Invalid Suppliers Selected. Please Selected a valid Suppliers');

        $suppliers = $this->supplierService->getSuppliers($selected_suppliers_id);
        $i = 0;
        return view('suppliers.suppliers_payment', compact('suppliers', 'i'));
    }

    /**
     * Make Payment to selected Customers
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payAllSuppliers(Request $request)
    {
        $response = $this->supplierService->payMultipleSuppliers($request);

        if ($response['status'] == false) {
            return redirect()->route('suppliers')->withErrors($response['message']);
        }

        session()->flash("message", $response['message']);
        return redirect()->route('suppliers.payment');

    }

    /**
     * Suppliers Payment Histoy Page
     * @param int $supplier_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supplierPaymentHistory($supplier_id = 0)
    {
        $supplier = $this->supplierService->getASupplier($supplier_id);

        return view('suppliers.payment_history', compact('supplier'));
    }

    /**
     * Add all payment information to datatable
     * @param int $supplier_id
     * @return mixed
     */
    public function getAllSuppliersPaymentHistoryToDataTable($supplier_id = 0)
    {
        return $this->supplierService->getAllSuppliersPaymentHistoryToDataTable($supplier_id);
    }
}
