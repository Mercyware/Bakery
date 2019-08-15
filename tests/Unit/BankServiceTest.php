<?php

namespace Tests\Unit;

use App\Interfaces\IBankRepository;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;


class BankServiceTest extends TestCase
{
    protected $bank_repository;

  protected function setUp(): void
  {
      parent::setUp(); // TODO: Change the autogenerated stub
      $this->bank_repository = $this->createMock(IBankRepository::class);
  }

    /**
     *
     */
    public function test_that_allBanks_calls_getBanks_of_BankRepository_Successfully()
    {

        //Act

        $this->bank_repository->method('getBanks')->willReturn(new Collection());

        //Asset
        $this->assertEquals(new Collection(),  $this->bank_repository->getBanks());
        $this->assertInstanceOf(Collection::class,  $this->bank_repository->getBanks());
    }

    /**
     *
     */
    public function test_that_getABankByBankID_calls_getABankByBankID_of_BankRepository_Successfully()
    {
        //setup
        $bank_id = 1;

        //Act
        $this->bank_repository->method('getABankByBankID')->willReturn(new Bank());

        //Asset
        $this->assertEquals(new Bank(),  $this->bank_repository->getABankByBankID($bank_id));
        $this->assertInstanceOf(Bank::class,  $this->bank_repository->getABankByBankID($bank_id));

    }


}