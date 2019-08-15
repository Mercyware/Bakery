<?php

namespace App\Repository;


use App\Interfaces\IPaymentRepository;
use App\Models\Payment;

class PaymentRepository implements IPaymentRepository
{

    /**
     * @var Payment
     */
    private $payment;

    /**
     * PaymentRepository constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Receives ans store Payment/Transfer Details
     * @param $attributes
     * @return mixed
     */
    public function storePaymentDetails($attributes)
    {
        return $this->payment->create([
            'supplier_id' => $attributes->supplier_id,
            'amount' => $attributes->amount,
            'transfer_code' => $attributes->transfer_code,
            'description' => $attributes->description,
        ]);
    }

    /**
     * Get All Payments Information stored in the Database
     * @return mixed
     */
    public function getAllPayments()
    {
        return $this->payment->all();
    }


    /**
     * Get Payments By Supplier ID
     * @param $supplier_id
     * @return mixed
     */
    public function getPaymentsBySupplierId($supplier_id){
        return $this->payment->where('supplier_id',$supplier_id)->get();
    }


    /**
     * Get the details of a payment
     * @param $payment_id
     * @return mixed
     */
    public function getAPayment($payment_id){
        return $this->payment->where('id',$payment_id)->first();
    }

    public function storeBulkPaymentDetails()
    {

        return $this->payment->create([
            'supplier_id' => $attributes->supplier_id,
            'amount' => $attributes->amount,
            'transfer_code' => $attributes->transfer_code,
            'description' => $attributes->description,
        ]);

    }
}
