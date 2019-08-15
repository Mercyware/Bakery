<?php


namespace App\Interfaces;


interface ISupplierRepository
{
    /**
     * Get a list of all suppliers
     * @return Supplier[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allSuppliers();

    /**
     * Get A Supplier by Supplier ID
     * @param $supplier_id
     * @return mixed
     */
    public function getASupplierById($supplier_id);

    /**
     * Get A supllier by Slug
     * @param $slug
     * @return mixed
     */
    public function getASupplierBySlug($slug);

    /**
     * Add a new Suppler
     * @param $attributes
     * @return mixed
     */
    public function addASupplier($attributes);


    /**
     * update a supplier record
     * @param $attributes
     * @param $supplier_id
     * @return mixed
     */
    public function updateASupplier($attributes, $supplier_id);

    /**
     * Get Suppliers Information using ID
     * @param $suppliers_ids
     * @return mixed
     */
    public function getSuppliersByID($suppliers_ids);

}
