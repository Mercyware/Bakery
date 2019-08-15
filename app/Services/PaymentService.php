<?php

namespace App\Services;


use App\Helpers\PaymentHelper;
use App\Interfaces\IPaymentRepository;
use App\Interfaces\IPaymentService;
use GuzzleHttp\Exception\RequestException;

class PaymentService implements IPaymentService
{

    /**
     * @var PaymentHelper
     */
    private $paymentHelper;
    /**
     * @var IPaymentRepository
     */
    private $paymentRepository;

    public function __construct(PaymentHelper $paymentHelper, IPaymentRepository $paymentRepository)
    {
        $this->paymentHelper = $paymentHelper;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Send Supplier Information to Paystack.
     * It makes HTTP request to Paystack and Create user Account for Transfer
     * @param $recipient_details
     * @return \Exception|mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registerTransferRecipient($recipient_details)
    {
        //Make Http request to Paystack to Create User Transfer Account
        $params = [
            "type" => "nuban",
            "name" => $recipient_details->name,
            "description" => $recipient_details->description,
            "account_number" => $recipient_details->account_number,
            "bank_code" => $recipient_details->bank_code,
            "currency" => "NGN",
        ];

        $response = null;

        try {
            $response = $this->paymentHelper->makeRequest('POST', $params, 'transferrecipient');

            return $response;
        } catch (\Exception $exception) {
            return $exception;

        }

    }

    /**
     * Initiatiate Client/Supplier Transfer
     *
     * @param $transfer_details
     * @return \Exception|mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function initiateTransfer($transfer_details)
    {


        //Make Http request to Paystack to Create User Transfer Account /
        $params = [
            "source" => "balance",
            "reason" => $transfer_details->description,
            "amount" => $transfer_details->amount,
            "recipient" => $transfer_details->recipient_code,

        ];

        $response = null;

        try {
            $response = $this->paymentHelper->makeRequest('POST', $params, 'transfer');


            return $response;
        } catch (\Exception $exception) {

            return $exception;


        }

    }


    /**
     * Store Payment into the database
     * @param $attributes
     * @return mixed
     */
    public function storePayment($attributes)
    {

        return $this->paymentRepository->storePaymentDetails($attributes);
    }


    /**
     * Get Account Balance
     * @return \Exception|mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountBalance()
    {


        try {

            $response = $this->paymentHelper->makeRequest('GET', [], 'balance');

            if ($response->getStatusCode() == 200) { // 200  OKAY

                $account_balance = json_decode($response->getBody()->getContents());

                return $account_balance->data[0]->balance;
            }

            return json_decode($response->getBody()->getContents())->message;

        } catch (RequestException $exception) {

            return $exception->getMessage();


        }

    }


    /**
     * Initiate Bulk Transfer to Customer
     * @param $transfer_details
     * @return \Exception|mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function initiateBulkTransfer($transfer_details)
    {



        //Make Http request to Paystack to Create User Transfer Account /
        $params = [
            "source" => "balance",
            "currency" =>"NGN",
            "transfers" => $transfer_details->suppliers_transfer_details,


        ];

        $response = null;

        try {
            $response = $this->paymentHelper->makeRequest('POST', $params, 'transfer/bulk');


            return $response;
        } catch (\Exception $exception) {

            return $exception;


        }

    }
}
