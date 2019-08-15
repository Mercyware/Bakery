<?php

namespace App\Interfaces;


interface IPaymentService
{

    /**
     * Send Supplier Information to Paystack
     * @param $recipient_details
     * @return mixed
     */
    public function registerTransferRecipient($recipient_details);

    /**
     * Initiate Payment / Transfer to a client / supplier bank account through paystack
     * @param $transfer_details
     * @return mixed
     */
    public function initiateTransfer($transfer_details);

    /**
     * Store Payment into the database
     * @param $attributes
     * @return mixed
     */
    public function storePayment($attributes);


    /**
     * Get Account Balance
     * @return \Exception|mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountBalance();
}
