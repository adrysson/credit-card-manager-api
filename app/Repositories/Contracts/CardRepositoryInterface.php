<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface CardRepositoryInterface extends MainRepositoryInterface
{
    public function paginateByCompanyId(int $companyId): LengthAwarePaginator;
}
