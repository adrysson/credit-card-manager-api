<?php

namespace App\Services\Company;

use App\Services\AbstractStoreMainService;
use App\Services\Company\CompanyValidation;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class StoreCompanyService extends AbstractStoreMainService
{
    use ProvidesConvenienceMethods, CompanyValidation;
}
