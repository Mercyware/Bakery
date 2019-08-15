<?php

namespace App\Providers;

use App\Interfaces\IBankRepository;
use App\Interfaces\IBankService;
use App\Interfaces\IPaymentRepository;
use App\Interfaces\IPaymentService;
use App\Interfaces\ISupplierRepository;
use App\Interfaces\ISupplierService;
use App\Interfaces\ISupplyRepository;
use App\Interfaces\ISupplyService;
use App\Repository\BankRepository;
use App\Repository\PaymentRepository;
use App\Repository\SupplierRepository;
use App\Repository\SupplyRepository;
use App\Services\BankService;
use App\Services\PaymentService;
use App\Services\SupplierService;
use App\Services\SupplyService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositoryInterface();
        $this->registerServiceInterface();
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

    }


    /**
     * Interface mapping to Repositories
     *
     * @var array
     */
    private static $repositoryInterfaces = [
        ISupplierRepository::class => SupplierRepository::class,
        ISupplyRepository::class => SupplyRepository::class,
        IBankRepository::class => BankRepository::class,
        IPaymentRepository::class => PaymentRepository::class
    ];


    /**
     * Interface mapping to Services
     *
     * @var array
     */
    private static $servicesInterfaces = [

        ISupplierService::class => SupplierService::class,
        ISupplyService::class => SupplyService::class,
        IBankService::class => BankService::class,
        IPaymentService::class => PaymentService::class,
    ];


    /**
     *Biding Repository interfaces to the definitions
     */
    private function registerRepositoryInterface()
    {
        foreach (self::$repositoryInterfaces as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     *
     * Binding Services interfaces to the definitions
     */
    private function registerServiceInterface()
    {
        foreach (self::$servicesInterfaces as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

}
