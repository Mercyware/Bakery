<?php

namespace App\Interfaces;


interface IBankService
{
    /**
     * Get All Banks Details
     */
    public function allBanks();


    /**
     * Get A Bank Details By Bank ID
     * @param $bank_id
     * @return mixed
     */
    public function getABankByBankID($bank_id);
}
