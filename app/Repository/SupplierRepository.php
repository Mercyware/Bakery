<?php

namespace App\Repository;


use App\Interfaces\ISupplierRepository;
use App\Models\Supplier;

class SupplierRepository implements ISupplierRepository
{
    /**
     * @var Supplier
     */
    private $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * Get a list of all suppliers
     * @return Supplier[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allSuppliers()
    {
        return $this->supplier->all();
    }

    /**
     * Get A Supplier by Supplier ID
     * @param $supplier_id
     * @return mixed
     */
    public function getASupplierById($supplier_id)
    {
        return $this->supplier->where('id', $supplier_id)->first();
    }

    /**
     * Get A supllier by Slug
     * @param $slug
     * @return mixed
     */
    public function getASupplierBySlug($slug)
    {
        return $this->supplier->where('slug', $slug)->first();
    }

    /**
     * Add a new Suppler
     * @param $attributes
     * @return mixed
     */
    public function addASupplier($attributes)
    {
        try{
            return $this->supplier->create([
                'name' => $attributes->name,
                'email' => $attributes->email,
                'phone' => $attributes->phone,
                'description' => $attributes->description,
                'account_number' => $attributes->account_number,
                'bank_id' => $attributes->bank_id,
                'paystack_recipient_code' => $attributes->paystack_recipient_code,
            ]);
        } catch (\Exception $exception) {
            return $exception;
        }
    }


    /**
     * update a supplier record
     * @param $attributes
     * @param $supplier_id
     * @return mixed
     */
    public function updateASupplier($attributes, $supplier_id)
    {
        try {
            return $this->supplier->where('id', $supplier_id)->update([
                'name' => $attributes->name,
                'email' => $attributes->email,
                'phone' => $attributes->phone,
                'description' => $attributes->description,
                'account_number' => $attributes->account_number,
                'bank_id' => $attributes->bank_id,
                'paystack_recipient_code' => $attributes->paystack_recipient_code,
            ]);
        } catch (\Exception $exception) {
            return $exception;
        }

    }


    /**
     * Get Suppliers Information using ID
     * @param $suppliers_ids
     * @return mixed
     */
    public function getSuppliersByID($suppliers_ids)
    {
        return $this->supplier->whereIn('id', $suppliers_ids)->get();
    }


}
