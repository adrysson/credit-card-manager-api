<?php

namespace App\Repositories\Eloquent;

use App\Models\Card;
use App\Repositories\Contracts\CardRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CardRepositoryEloquent implements CardRepositoryInterface
{
    public function paginate(?int $perPage = 15): LengthAwarePaginator
    {
        return Card::paginate($perPage);
    }

    public function getById(?int $id = null): array
    {
        if (empty($id)) {
            return [];
        }

        return Card::findOrFail($id)->toArray();
    }

    public function deleteById(int $id): bool
    {
        return Card::findOrFail($id)->delete();
    }

    public function create(array $data): array
    {
        return Card::create($data)->toArray();
    }

    public function update(int $id, array $data): bool
    {
        return Card::findOrFail($id)->update($data);
    }

    public function paginateByCompanyId(int $companyId): LengthAwarePaginator
    {
        return Card::where('company_id', $companyId)->paginate();
    }
}
