<?php

namespace App\Interfaces;


use App\Models\Banks;

interface IBankRepository
{

    /**
     * All Banks
     * @return Banks[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBanks();


    /**
     * Get A Bank Details by ID
     * @param $bank_id
     * @return mixed
     */
    public function getABankByBankID($bank_id);

}
