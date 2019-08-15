<?php

namespace Tests\Unit;

use App\API\PayStackAPI;
use App\Interfaces\IBankRepository;
use App\Interfaces\IPaymentRepository;
use App\Interfaces\ISupplierRepository;
use App\Models\Bank;
use App\Models\Supplier;
use App\Repository\PaymentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierServiceTest extends TestCase
{
    private $supplier_repository;
    private $bank_repository;
    private $paystack_api;
    private $payment_repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->supplier_repository = $this->createMock(ISupplierRepository::class);
        $this->bank_repository = $this->createMock(IBankRepository::class);
        $this->paystack_api = $this->createMock(PayStackAPI::class);
        $this->payment_repository = $this->createMock(IPaymentRepository::class);
    }


    public function test_that_getAllSuppliersToDataTables_calls_all_Suppliers_of_SupplierRepository_Sucessfully()
    {
        $this->supplier_repository->method('allSuppliers')->willReturn(new Collection());

        //Asset
        $this->assertEquals(new Collection(), $this->supplier_repository->allSuppliers());
        $this->assertInstanceOf(Collection::class, $this->supplier_repository->allSuppliers());
    }

    public function test_that_getASupplier_calls_getASupplierById_of_SuppliersRepository_Successfully()
    {
        //Setup
        $supplier_id = 1;

        //Act
        $this->supplier_repository->method('getASupplierById')->willReturn(new Supplier());

        //Assert
        $this->assertEquals(new Supplier(), $this->supplier_repository->getASupplierById($supplier_id));
        $this->assertInstanceOf(Supplier::class, $this->supplier_repository->getASupplierById($supplier_id));
    }

    //Add Suppliers
    public function test_that_createSupplier_calls_getABankByBankID_of_BankRepository_Succesffully()
    {
//Setup
        $bank_id = 1;

        //Act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());

        //Assert
        $this->assertInstanceOf(Bank::class, $this->bank_repository->getABankByBankID($bank_id));
        $this->assertEquals(new Bank(), $this->bank_repository->getABankByBankID($bank_id));
    }

    public function test_that_createSupplier_calls_registerTransferRecipient_of_PaystackAPI_suucessfully()
    {
//setup
        $recipient = new Request([
            'name' => 'test name',
            "description" => 'test description',
            "account_number" => 'test account numberr',
            "bank_code" => 'test bank code',

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('registerTransferRecipient')->willReturn(array());

        //Asset
        $this->assertEquals(array(), $this->paystack_api->registerTransferRecipient($recipient));
    }

    public function test_that_registerTransferRecipient_of_PayStackAPI_Return_200OK_Code_When_Called_From_CreateSupplier()
    {
//setup
        $recipient = new Request([
            'name' => 'test name',
            "description" => 'test description',
            "account_number" => 'test account numberr',
            "bank_code" => 'test bank code',

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('registerTransferRecipient')->willReturn(new JsonResponse("", 200));

        //Asset
        $this->assertEquals(new JsonResponse("", 200), $this->paystack_api->registerTransferRecipient($recipient));
    }

    public function test_that_createSupplier_calls_addASupplier_of_supplier_Repository_Succesfully()
    {
        //setup
        $recipient = new Request([
            'name' => 'test name',
            "description" => 'test description',
            "account_number" => 'test account numberr',
            "bank_code" => 'test bank code',

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('registerTransferRecipient')->willReturn(new JsonResponse("", 200));
        $this->supplier_repository->method('addASupplier')->willReturn(new Supplier());

        //Asset
        $this->assertEquals(new Supplier(), $this->supplier_repository->addASupplier($recipient));
        $this->assertInstanceOf(Supplier::class, $this->supplier_repository->addASupplier($recipient));
    }

    //Update Suppliers
    public function test_that_updateSupplierDetails_calls_getABankByBankID_of_BankRepository_Succesffully()
    {
//Setup
        $bank_id = 1;

        //Act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());

        //Assert
        $this->assertInstanceOf(Bank::class, $this->bank_repository->getABankByBankID($bank_id));
        $this->assertEquals(new Bank(), $this->bank_repository->getABankByBankID($bank_id));
    }

    public function test_that_updateSupplierDetails_calls_registerTransferRecipient_of_PaystackAPI_suucessfully()
    {
//setup
        $recipient = new Request([
            'name' => 'test name',
            "description" => 'test description',
            "account_number" => 'test account numberr',
            "bank_code" => 'test bank code',

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('registerTransferRecipient')->willReturn(array());

        //Asset
        $this->assertEquals(array(), $this->paystack_api->registerTransferRecipient($recipient));
    }

    public function test_that_registerTransferRecipient_of_PayStackAPI_Return_200OK_Code_When_Called_in_updateSupplierDetails()
    {
//setup
        $recipient = new Request([
            'name' => 'test name',
            "description" => 'test description',
            "account_number" => 'test account numberr',
            "bank_code" => 'test bank code',

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('registerTransferRecipient')->willReturn(new JsonResponse("", 200));

        //Asset
        $this->assertEquals(new JsonResponse("", 200), $this->paystack_api->registerTransferRecipient($recipient));
    }

    public function test_that_updateSupplierDetails_calls_updateASupplier_of_supplier_Repository_Succesfully()
    {
        //setup
        $supplier_id = 1;
        $recipient = new Request([
            'name' => 'test name',
            "description" => 'test description',
            "account_number" => 'test account numberr',
            "bank_code" => 'test bank code',

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('registerTransferRecipient')->willReturn(new JsonResponse("", 200));
        $this->supplier_repository->method('updateASupplier')->willReturn(new Supplier());

        //Asset
        $this->assertEquals(new Supplier(), $this->supplier_repository->updateASupplier($recipient, $supplier_id));
        $this->assertInstanceOf(Supplier::class, $this->supplier_repository->updateASupplier($recipient, $supplier_id));
    }

    //MakePayment
    public function test_that_makePaymentToSupplier_calls_getASupplierById_of_SuppliersRepository_Successfully()
    {
        //Setup
        $supplier_id = 1;

        //Act
        $this->supplier_repository->method('getASupplierById')->willReturn(new Supplier());

        //Assert
        $this->assertEquals(new Supplier(), $this->supplier_repository->getASupplierById($supplier_id));
        $this->assertInstanceOf(Supplier::class, $this->supplier_repository->getASupplierById($supplier_id));
    }

    public function test_that_makePaymentToSupplier_call_initiateTransfer_of_PayStackAPI_successfully()
    {
//setup
        $payment_details = new Request([
            "source" => "balance",
            "reason" => "ttest reason",
            "amount" => 1000000,
            "recipient" => "test code",

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('initiateTransfer')->willReturn(array());

        //Asset
        $this->assertEquals(array(), $this->paystack_api->initiateTransfer($payment_details));
    }

    public function test_that_initiateTransfer_of_PayStackAPI_Return_200OK_Code_When_Called_in_makePaymentToSupplier()
    {
//setup
        $payment_details = new Request([
            "source" => "balance",
            "reason" => "ttest reason",
            "amount" => 1000000,
            "recipient" => "test code",

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('initiateTransfer')->willReturn(new JsonResponse("", 200));

        //Asset
        $this->assertEquals(new JsonResponse("", 200), $this->paystack_api->initiateTransfer($payment_details));
    }

    public function test_that_getSuppliers_calls_getASupplierById_of_SuppliersRepository_Successfully()
    {
        //Setup
        $supplier_id = 1;

        //Act
        $this->supplier_repository->method('getSuppliersByID')->willReturn(new Collection());

        //Assert
        $this->assertEquals(new Collection(), $this->supplier_repository->getSuppliersByID($supplier_id));
        $this->assertInstanceOf(Collection::class, $this->supplier_repository->getSuppliersByID($supplier_id));
    }


    public function test_that_payMultipleSuppliers_call_initiateBulkTransfer_of_PayStackAPI_successfully()
    {
//setup
        $payment_details = new Request([
            "source" => "balance",
            "reason" => "ttest reason",
            "amount" => 1000000,
            "recipient" => "test code",

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('initiateBulkTransfer')->willReturn(array());

        //Asset
        $this->assertEquals(array(), $this->paystack_api->initiateBulkTransfer($payment_details));
    }

    public function test_that_initiateBulkTransfer_of_PayStackAPI_Return_200OK_Code_When_Called_in_makePaymentToSupplier()
    {
//setup
        $payment_details = new Request([
            "source" => "balance",
            "reason" => "ttest reason",
            "amount" => 1000000,
            "recipient" => "test code",

        ]);


        //act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());
        $this->paystack_api->method('initiateBulkTransfer')->willReturn(new JsonResponse("", 200));

        //Asset
        $this->assertEquals(new JsonResponse("", 200), $this->paystack_api->initiateBulkTransfer($payment_details));
    }

    public function test_that_getAllSuppliersPaymentHistoryToDataTable_calls_getPaymentsBySupplierId_of_Supplier_Repository_Successfully()
    {
        //Setup
        $supplier_id =1;
        $this->payment_repository->method('getPaymentsBySupplierId')->willReturn(new Collection());

        //Asset
        $this->assertEquals(new Collection(), $this->payment_repository->getPaymentsBySupplierId($supplier_id));
        $this->assertInstanceOf(Collection::class, $this->payment_repository->getPaymentsBySupplierId($supplier_id));
    }


}
