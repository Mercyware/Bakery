<?php

namespace App\Http\Controllers;

use App\API\PayStackAPI;
use App\Interfaces\IPaymentService;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    /**
     * @var PayStackAPI
     */
    private $payStackAPI;

    /**
     * SettingController constructor.
     * @param PayStackAPI $payStackAPI
     */
    public function __construct(PayStackAPI $payStackAPI)
    {
        $this->middleware('auth');

        $this->payStackAPI = $payStackAPI;
    }

    /**
     * Get Account Balance
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function accountBalance()
    {
        $response = $this->payStackAPI->getAccountBalance();

        if (gettype($response) == "integer")
            return view('account.view',compact('response'));


        return redirect()->back()->withErrors($response . ', Please try again');

    }
}
