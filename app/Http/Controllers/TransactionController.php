<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Services\Transaction\StoreTransactionService;
use App\Services\Transaction\UpdateTransactionService;

class TransactionController extends Controller
{
    public function __construct(TransactionRepositoryInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->storeService = new StoreTransactionService($this->mainRepository);
        $this->updateService = new UpdateTransactionService($this->mainRepository);
    }
}
