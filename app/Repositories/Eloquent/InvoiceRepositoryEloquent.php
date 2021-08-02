<?php

namespace App\Repositories\Eloquent;

use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class InvoiceRepositoryEloquent implements InvoiceRepositoryInterface
{
    public function paginate(?int $perPage = 20): LengthAwarePaginator
    {
        return Invoice::paginate($perPage);
    }

    public function getById(?int $id = null): array
    {
        if (empty($id)) {
            return [];
        }

        return Invoice::findOrFail($id)->toArray();
    }

    public function deleteById(int $id): bool
    {
        return Invoice::findOrFail($id)->delete();
    }

    public function create(array $data): array
    {
        return Invoice::create($data)->toArray();
    }

    public function update(int $id, array $data): bool
    {
        return Invoice::findOrFail($id)->update($data);
    }

    public function paginateByCardId(int $cardId): LengthAwarePaginator
    {
        return Invoice::where('card_id', $cardId)->paginate();
    }
}
