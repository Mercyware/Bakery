<?php


namespace App\API;


use App\Helpers\PaymentHelper;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class PayStackAPI
{
    /**
     * @var PaymentHelper
     */
    private $paymentHelper;

    public function __construct(PaymentHelper $paymentHelper)
    {
        $this->paymentHelper = $paymentHelper;
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

        } catch (GuzzleException $exception) {
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
            "amount" => $transfer_details->amount * 100,
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
            "currency" => "NGN",
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
