<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionRepositoryEloquent implements TransactionRepositoryInterface
{
    public function paginate(?int $perPage = 15): LengthAwarePaginator
    {
        return Transaction::paginate($perPage);
    }

    public function getById(?int $id = null): array
    {
        if (empty($id)) {
            return [];
        }

        return Transaction::findOrFail($id)->toArray();
    }

    public function deleteById(int $id): bool
    {
        return Transaction::findOrFail($id)->delete();
    }

    public function create(array $data): array
    {
        return Transaction::create($data)->toArray();
    }

    public function update(int $id, array $data): bool
    {
        return Transaction::findOrFail($id)->update($data);
    }
}
