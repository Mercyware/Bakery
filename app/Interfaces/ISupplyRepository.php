<?php

namespace App\Interfaces;


interface ISupplyRepository
{
    /**
     * Get list of all supplies
     * @return mixed
     */
    public function getAllSupplies();

    /**
     * Get Supply by A Supply ID
     * @param $supply_id
     * @return mixed
     */
    public function getASupplyBySupplyID($supply_id);


    /**
     * Get Supplies by A Supplier ID
     * @param $supplier_id
     * @return mixed
     */
    public function getSuppliesBySupplierId($supplier_id);


    /**
     * Create/ Store a new Supply Information
     * @param $attributes
     * @return mixed
     */
    public function createSupply($attributes);

}
