<?php

namespace App\Services\Transaction;

use App\Services\AbstractUpdateMainService;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateTransactionService extends AbstractUpdateMainService
{
    use ProvidesConvenienceMethods, TransactionValidation;
}
