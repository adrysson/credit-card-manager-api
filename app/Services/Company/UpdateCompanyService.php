<?php

namespace App\Services\Company;

use App\Services\AbstractUpdateMainService;
use App\Services\Company\CompanyValidation;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateCompanyService extends AbstractUpdateMainService
{
    use ProvidesConvenienceMethods, CompanyValidation;
}
