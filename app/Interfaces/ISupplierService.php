<?php


namespace App\Interfaces;


use App\Repository\SupplierRepository;

interface ISupplierService
{

    /**
     * Get a list of all suppliers and return it in a datatable
     * @return mixed
     */
    public function getAllSuppliersToDataTables();


    /**
     * Get A Supplier details
     * @param $supplier_id
     * @return mixed
     */
    public function getASupplier($supplier_id);

    /**
     * Create a new Supplier
     * @param $attributes
     */
    public function createSupplier($attributes);


    /**
     * Make Payment and store information in database
     * @param $attributes
     * @param $supplier_id
     * @return string
     */
    public function makePaymentToSupplier($attributes, $supplier_id);
}
