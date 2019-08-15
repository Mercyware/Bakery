<?php

namespace App\Interfaces;


interface ISupplyService
{

    /**
     * Create A new Supply
     * @param $attributes
     * @return mixed
     */
    public function createSupply($attributes);

    /**
     * Get All Supplies to Datatables
     * @return mixed
     */
    public function getAllSuppliesToDataTables($supplier_id = 0);

    /**
     * Get A Supply by Supply ID
     * @param int $supply_id
     * @return mixed
     */
    public function getASupply($supply_id = 0);
}
