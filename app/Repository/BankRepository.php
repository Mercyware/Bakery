<?php

namespace App\Repository;


use App\Interfaces\IBankRepository;
use App\Models\Bank;

class BankRepository implements IBankRepository
{

    /**
     * @var Banks
     */
    private $bank;

    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    /**
     * All Banks
     * @return Banks[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBanks()
    {
        return $this->bank->all();
    }

    /**
     * Get A Bank Details by ID
     * @param $bank_id
     * @return mixed
     */
    public function getABankByBankID($bank_id)
    {
        return $this->bank->where('id', $bank_id)->first();
    }
}
