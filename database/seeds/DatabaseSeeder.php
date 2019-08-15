<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:fresh');

            $this->command->line("Database cleared.");
        }

        $this->call(UserTableSeeder::class);
     //   $this->call(SupplierSeeder::class);
        $this->call(BankSeeder::class);
    }
}
