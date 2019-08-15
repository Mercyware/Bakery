<?php

namespace App\Repository;


use App\Interfaces\ISupplyRepository;
use App\Models\Supply;

class SupplyRepository implements ISupplyRepository
{
    /**
     * @var Supply
     */
    private $supply;

    public function __construct(Supply $supply)
    {
        $this->supply = $supply;
    }

    /**
     * Get list of all supplies
     * @return mixed
     */
    public function getAllSupplies()
    {
        return $this->supply->all();
    }

    /**
     * Get Supply by A Supply ID
     * @param $supply_id
     * @return mixed
     */
    public function getASupplyBySupplyID($supply_id)
    {
        return $this->supply->where('id', $supply_id)->first();
    }


    /**
     * Get Supplies by A Supplier ID
     * @param $supplier_id
     * @return mixed
     */
    public function getSuppliesBySupplierId($supplier_id)
    {
        return $this->supply->where('supplier_id', $supplier_id)->get();
    }

    /**
     * Create/ Store a new Supply Information
     * @param $attributes
     * @return mixed
     */
    public function createSupply($attributes)
    {
        return $this->supply->create([
            'supplier_id' => $attributes->supplier_id,
            'description' => $attributes->description,
            'more_details' => $attributes->more_details,
            'date_delivered' => $attributes->date_delivered,
            'amount' => $attributes->amount,
        ]);
    }
}
