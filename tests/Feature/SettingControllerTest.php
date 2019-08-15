<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_user_can_browse_account_balance_page()
    {
        $user = new User();
        $this
            ->actingAs($user, 'web')
            ->get(route('account.balance'))
            ->assertStatus(200)
        ->assertSeeText("Balance");


    }


}
