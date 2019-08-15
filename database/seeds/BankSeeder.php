<?php

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        //
        $this->command->info("Clearing theBanks table for a new insert");
        \App\Models\Bank::truncate();
        //
        $this->command->info("Creating Banks into the Database");


        $banks = array(
            array(
                "name" => "Access Bank",
                "bank_code" => "044"
            ),
            array(
                "name" => "Citibank Nigeria",
                "bank_code" => "023"
            ),
            array(
                "name" => "Diamond Bank",
                "bank_code" => "063"
            ),
            array(
                "name" => "Ecobank Nigeria",
                "bank_code" => "050"
            ),
            array(
                "name" => "Enterprise Bank",
                "bank_code" => "063"
            ), array(
                "name" => "Fidelity Bank",
                "bank_code" => "070"
            ),
            array(
                "name" => "First Bank of Nigeria",
                "bank_code" => "011"
            ),
            array(
                "name" => "First City Monument Bank",
                "bank_code" => "214"
            ),
            array(
                "name" => "Guaranty Trust Bank",
                "bank_code" => "054"
            ),
            array(
                "name" => "Heritage Bank",
                "bank_code" => "030"
            ),
            array(
                "name" => "Keystone Bank",
                "bank_code" => "082"
            ),
            array(
                "name" => "MainStreet Bank",
                "bank_code" => "014"
            ),
            array(
                "name" => "Skye Bank",
                "bank_code" => "076"
            ),
            array(
                "name" => "Stanbic IBTC Bank",
                "bank_code" => "221"
            ),
            array(
                "name" => "Standard Chartered  Bank",
                "bank_code" => "068"
            ),
            array(
                "name" => "Sterling   Bank",
                "bank_code" => "232"
            ),
            array(
                "name" => "Union Bank of Nigeria",
                "bank_code" => "032"
            ),
            array(
                "name" => "United Bank For Africa",
                "bank_code" => "033"
            ),
            array(
                "name" => "Unity Bank",
                "bank_code" => "215"
            ),
            array(
                "name" => "Wema  Bank",
                "bank_code" => "035"
            ), array(
                "name" => "Zenith   Bank",
                "bank_code" => "057"
            ),

        );

        foreach ($banks as $bank) {
            \App\Models\Bank::create(array(
                'name' => $bank['name'],
                'bank_code' => $bank['bank_code'],

            ));

        }
    }
}
