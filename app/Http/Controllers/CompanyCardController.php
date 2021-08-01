<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CardRepositoryInterface;

class CompanyCardController
{
    public function __construct(CardRepositoryInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function index(int $companyId)
    {
        return $this->mainRepository->paginateByCompanyId($companyId);
    }
}
