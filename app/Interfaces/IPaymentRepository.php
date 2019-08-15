<?php

namespace App\Interfaces;


interface IPaymentRepository
{

    /**
     * Receives ans store Payment/Transfer Details
     * @param $attributes
     * @return mixed
     */
    public function storePaymentDetails($attributes);

    /**
     * Get All Payments Information stored in the Database
     * @return mixed
     */
    public function getAllPayments();


    /**
     * Get Payments By Supplier ID
     * @param $supplier_id
     * @return mixed
     */
    public function getPaymentsBySupplierId($supplier_id);


    /**
     * Get the details of a payment
     * @param $payment_id
     * @return mixed
     */
    public function getAPayment($payment_id);


    /**
     * Store Bulk User payment into the database
     * @param $suppliers_details
     * @return mixed
     */
    public function storeBulkPaymentDetails($suppliers_details);
}
