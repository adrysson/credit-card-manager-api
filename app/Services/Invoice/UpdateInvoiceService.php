<?php

namespace App\Services\Invoice;

use App\Services\AbstractUpdateMainService;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateInvoiceService extends AbstractUpdateMainService
{
    use ProvidesConvenienceMethods, InvoiceValidation;
}
