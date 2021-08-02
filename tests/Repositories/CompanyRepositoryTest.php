<?php

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\MainRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

require_once 'RepositoryTest.php';

class CompanyRepositoryTest extends RepositoryTest
{
    protected string $table = 'companies';

    protected function getRepository(): MainRepositoryInterface
    {
        return app(CompanyRepositoryInterface::class);
    }

    protected function getModel(): Model
    {
        return new Company;
    }

    protected array $createData = [
        'name' => 'Nubank'
    ];

    protected array $updateData = [
        'name' => 'Banco Inter'
    ];
}
