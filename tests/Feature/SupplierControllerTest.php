<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierControllerTest extends TestCase
{

    public function test_that_user_can_browse_all_suppliers_page()
    {
        $user = new User();
        $this
            ->actingAs($user, 'web')
            ->get(route('suppliers'))
            ->assertStatus(200)
            ->assertSeeText("All Suppliers");


    }

    public function test_that_user_can_browse_all_view_page()
    {
        $user = new User();
        $this
            ->actingAs($user, 'web')
            ->get(route('supplies.view',1))
            ->assertStatus(200);



    }


}
