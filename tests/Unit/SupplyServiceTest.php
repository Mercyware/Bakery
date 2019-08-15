<?php

namespace Tests\Unit;


use App\Interfaces\ISupplyRepository;
use App\Models\Supplier;
use App\Models\Supply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplyServiceTest extends TestCase
{
    private $supply_repository;


    public function setUp(): void
    {
        parent::setUp();
        $this->supply_repository = $this->createMock(ISupplyRepository::class);

    }

    /**
     *
     */
    public function test_that_createSupply_calls_createSupply_of_SupplyRepository_Successfully()
    {
//setup
        $supply = new Request([
            'supplier_id' => 1,
            'description' => "test description",
            'more_details' => "test details",
            'date_delivered' => "2019-02-2011",
            'amount' => 2000,

        ]);


        //act
        $this->supply_repository->method('createSupply')->willReturn(new Supply());

        //Asset
        $this->assertEquals(new Supply(), $this->supply_repository->createSupply($supply));
    }

    public function test_that_getAllSuppliesToDataTables_calls_getSuppliesBySupplierId_of_SuppliersRepository_Successfully()
    {
        //Setup
        $supplier_id = 1;

        //Act
        $this->supply_repository->method('getSuppliesBySupplierId')->willReturn(new Collection());

        //Assert
        $this->assertEquals(new Collection(), $this->supply_repository->getSuppliesBySupplierId($supplier_id));
        $this->assertInstanceOf(Collection::class, $this->supply_repository->getSuppliesBySupplierId($supplier_id));
    }

}
