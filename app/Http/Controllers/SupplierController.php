<?php

namespace App\Http\Controllers;


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
    public function createSupplier(Request $request)
    {
        $response = $this->supplierService->createSupplier($request);
        if ($response != "")
            return redirect()->back()->withErrors($response . ', Please try again');
        session()->flash('message', "New Supplier information has been created");
        return redirect()->back();
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
        $supplier = $this->supplierService->getASupplier($supplier_id);
        if (!$supplier)
            return redirect()->back()->withErrors('Invalid Supplier Selected. Please Selected a valid Supplier');

        //Check That User have balance to Pay
        $balance = $supplier->Supplies->sum('amount') - $supplier->Payment->sum('amount');

        if ($balance < $request->amount)
            return redirect()->back()->withErrors('Unable to make payment to the user. You are trying to pay more than you owe. Please Selected a valid Supplier');
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

        if (count($selected_suppliers_id) <= 0)
            return redirect()->back()->withErrors('Invalid Suppliers Selected. Please Selected a valid Suppliers');

        $suppliers = $this->supplierService->getSuppliers($selected_suppliers_id);
        return view('suppliers.suppliers_payment', compact('suppliers'));
    }

    /**
     * Make Payment to selected Customers
     * @param Request $request
     */
    public function payAllSuppliers(Request $request)
    {
        dd($this->supplierService->payMultipleSuppliers($request));


    }
}
