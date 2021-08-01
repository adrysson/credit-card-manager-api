<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Services\Company\StoreCompanyService;
use App\Services\Company\UpdateCompanyService;

class CompanyController extends Controller
{
    public function __construct(CompanyRepositoryInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->storeService = new StoreCompanyService($this->mainRepository);
        $this->updateService = new UpdateCompanyService($this->mainRepository);
    }
}
