<?php

namespace App\Services;


use App\Interfaces\ISupplyRepository;
use App\Interfaces\ISupplyService;
use Yajra\DataTables\DataTables;

class SupplyService implements ISupplyService
{
    /**
     * @var ISupplyRepository
     */
    private $supplyRepository;

    public function __construct(ISupplyRepository $supplyRepository)
    {
        $this->supplyRepository = $supplyRepository;
    }

    /**
     * Create a Supply
     * @param $attributes
     * @return mixed|void
     */
    public function createSupply($attributes)
    {
        return $this->supplyRepository->createSupply($attributes);
    }

    /**
     * Get All Supplies into A Databable
     * @param int $supplier_id
     * @return mixed
     * @throws \Exception
     */
    public function getAllSuppliesToDataTables($supplier_id = 0)
    {

        if ($supplier_id > 0) {
            $supplies = $this->supplyRepository->getSuppliesBySupplierId($supplier_id);
        } else {
            $supplies = $this->supplyRepository->getAllSupplies();

        }



        $start = 1;
        return DataTables::of($supplies)
            ->addColumn('id', function ($supplies) use (&$start) {
                return $start++;
            })
            ->editColumn('date_delivered', function ($supplies) {
                return $supplies->date_delivered->toString();

            })
            ->editColumn('supplier', function ($supplies) {
                return ucwords($supplies->Supplier->name);

            }) ->editColumn('amount', function ($supplies) {
                return number_format($supplies->amount);

            })
            ->editColumn('action', function ($supplies) {
                return '<a href="/supply/view/' . $supplies->id . '" class="btn btn-warning btn-sm">View </a>';

            })
            ->make(true);
    }

    /**
     * Get A Supply by Supply ID
     * @param int $supply_id
     * @return mixed
     */
    public function getASupply($supply_id = 0)
    {
        return $this->supplyRepository->getASupplyBySupplyID($supply_id);
    }
}
