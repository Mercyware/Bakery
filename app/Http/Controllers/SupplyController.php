<?php

namespace App\Http\Controllers;

use App\Interfaces\ISupplierService;
use App\Interfaces\ISupplyService;
use App\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    /**
     * @var ISupplyService
     */
    private $supplyService;
    /**
     * @var ISupplierService
     */
    private $supplierService;

    /**
     * SupplyController constructor.
     * @param ISupplyService $supplyService
     * @param ISupplierService $supplierService
     */
    public function __construct(ISupplyService $supplyService, ISupplierService $supplierService)
    {
        $this->middleware('auth');
        $this->supplyService = $supplyService;
        $this->supplierService = $supplierService;
    }

    /**
     * Create Supplies
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSupply(Request $request)
    {

        try {
            $supply = $this->supplyService->createSupply($request);
            if ($supply) {
                session()->flash('message', 'New Supply Stored');
                return redirect()->route('supplies.view', $supply->supplier_id);
            } else {
                return redirect()->back()->withErrors('Unable to complete operations');
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors('An error has occurred. Unable to complete operations');
        }
    }

    /**
     * View All Supplies View
     * @param $supplier_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allSupplies($supplier_id = 0)
    {
        $supplier = $this->supplierService->getASupplier($supplier_id);

        return view('supply.index', compact('supplier'));
    }

    /**
     * Get All Supplies in DataTable
     * @param $supplier_id
     * @return mixed
     */
    public function getAllSuppliesToDataTable($supplier_id = 0)
    {
        return $this->supplyService->getAllSuppliesToDataTables($supplier_id);
    }

    /**
     * Selected Supply View
     * @param $supply_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function viewSupplyDetails($supply_id)
    {
        $supply = $this->supplyService->getASupply($supply_id);
        if (!$supply)
            return redirect()->back()->withErrors("No Supply Information for the selected Supply");
        return view('supply.view', compact('supply'));
    }
}
