<?php

namespace App\Services\Transaction;

use App\Services\AbstractStoreMainService;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class StoreTransactionService extends AbstractStoreMainService
{
    use ProvidesConvenienceMethods, TransactionValidation;
}
