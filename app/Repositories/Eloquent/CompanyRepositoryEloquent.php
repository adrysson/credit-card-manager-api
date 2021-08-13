<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepositoryEloquent implements CompanyRepositoryInterface
{
    public function paginate(?int $perPage = 15): LengthAwarePaginator
    {
        return Company::paginate($perPage);
    }

    public function getById(?int $id = null): array
    {
        if (empty($id)) {
            return [];
        }

        return Company::findOrFail($id)->toArray();
    }

    public function deleteById(int $id): bool
    {
        return Company::findOrFail($id)->delete();
    }

    public function create(array $data): array
    {
        return Company::create($data)->toArray();
    }

    public function update(int $id, array $data): bool
    {
        return Company::findOrFail($id)->update($data);
    }
}
