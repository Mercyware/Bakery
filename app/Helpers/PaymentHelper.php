<?php
/**
 * Created by PhpStorm.
 * User: adebo
 * Date: 3/25/2019
 * Time: 1:23 AM
 */

namespace App\Helpers;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class PaymentHelper
{
    private $secretKey;
    private $client;
    private $headers;
    private $base_uri;

    public function __construct()
    {
        $this->setSecretKey();
        $this->setBaseUrl();

    }

    public function setSecretKey()
    {
        $this->secretKey = getenv('PAYSTACK_LIVE_KEY');
    }


    private function setBaseUrl()
    {
        $this->base_uri = 'https://api.paystack.co/';
    }


    /**
     * @param string $method
     * @param $params
     * @param $url
     * @return mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws GuzzleException
     */
    public function makeRequest($method = 'GET', $params, $url)
    {
        try {
            $authBearer = "Bearer " . $this->secretKey;
            $client = new Client();
            return $client->request($method, $this->base_uri . $url, [
                'form_params' =>
                    $params,


                'headers' => [
                    'Authorization' => $authBearer,
                    //'Content-Type' => 'application/json',
                   // 'Accept' => 'application/json'
                ]

            ]);
        } catch (RequestException $exception) {

            return (($exception->getResponse()));
        }


    }
}
