<?php

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private CompanyRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app(CompanyRepositoryInterface::class);
    }

    public function paginateProvider()
    {
        return [
            '20-per-page' => [20],
            '30-per-page' => [30],
            '40-per-page' => [40],
        ];
    }

    /**
     * @dataProvider paginateProvider
     */
    public function testPaginate(int $perPage)
    {
        Company::factory()->count(30)->create();

        $paginator = Company::paginate($perPage);

        $repositoryPaginator = $this->repository->paginate($perPage);

        $this->assertEquals($paginator->toArray(), $repositoryPaginator->toArray());
    }

    public function testGetById()
    {
        $company = $this->repository->getById();
        $this->assertEquals($company, []);

        $companyCreated = Company::factory()->create();

        $company = $this->repository->getById($companyCreated->id);

        $this->assertEquals($companyCreated->toArray(), $company);

        $companyCreated->delete();

        $this->expectException(ModelNotFoundException::class);
        $this->repository->getById($company['id']);
    }

    public function testDeleteById()
    {
        $companyCreated = Company::factory()->create();
        $this->seeInDatabase('companies', ['id' => $companyCreated->id]);

        $this->repository->deleteById($companyCreated->id);
        $this->notSeeInDatabase('companies', ['id' => $companyCreated->id]);

        $this->expectException(ModelNotFoundException::class);
        $this->repository->deleteById($companyCreated->id);
    }

    public function testCreate()
    {
        $this->repository->create([
            'name' => 'Nubank',
        ]);

        $this->seeInDatabase('companies', [
            'name' => 'Nubank',
        ]);

        $this->expectException(QueryException::class);
        $this->repository->create([]);
    }

    public function testUpdate()
    {
        $companyCreated = Company::factory()->create([
            'name' => 'Nubank'
        ]);

        $this->seeInDatabase('companies', [
            'id' => $companyCreated->id,
            'name' => 'Nubank',
        ]);

        $this->repository->update($companyCreated->id, [
            'name' => 'Banco Inter',
        ]);

        $this->seeInDatabase('companies', [
            'id' => $companyCreated->id,
            'name' => 'Banco Inter',
        ]);
    }
}
