<?php

namespace App\Http\Controllers;

use App\Interfaces\ISupplierService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var ISupplierService
     */
    private $supplierService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ISupplierService $supplierService)
    {
        $this->middleware('auth');
        $this->supplierService = $supplierService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('dashboard');
    }
}
