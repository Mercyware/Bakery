<?php

namespace App\Services;


use App\Interfaces\IBankRepository;
use App\Interfaces\IBankService;

class BankService implements IBankService
{

    /**
     * @var IBankRepository
     */
    private $bankRepository;

    public function __construct(IBankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    /**
     * Get All Banks Details
     */
    public function allBanks()
    {
        return $this->bankRepository->getBanks();
    }

    /**
     * Get A Bank Details By Bank ID
     * @param $bank_id
     * @return mixed
     */
    public function getABankByBankID($bank_id)
    {
        return $this->bankRepository->getABankByBankID($bank_id);
    }
}
