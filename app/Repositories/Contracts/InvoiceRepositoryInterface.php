<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface InvoiceRepositoryInterface extends MainRepositoryInterface
{
    public function paginateByCardId(int $cardId): LengthAwarePaginator;
}
