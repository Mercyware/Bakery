<?php

namespace App\Http\Controllers;

use App\Interfaces\IPaymentService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    /**
     * @var IPaymentService
     */
    private $paymentService;

    /**
     * SettingController constructor.
     * @param IPaymentService $paymentService
     */
    public function __construct(IPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Get Account Balance
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function accountBalance()
    {
        $response = $this->paymentService->getAccountBalance();

        if (gettype($response) == "integer")
            return view('account.view',compact('response'));


        return redirect()->back()->withErrors($response . ', Please try again');

    }
}
