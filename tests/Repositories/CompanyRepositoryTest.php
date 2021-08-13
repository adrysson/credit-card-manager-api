<?php

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected string $table = 'companies';

    protected array $createData = [
        'name' => 'Nubank'
    ];

    protected array $updateData = [
        'name' => 'Banco Inter'
    ];

    protected CompanyRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app(CompanyRepositoryInterface::class);
    }

    public function testPaginate()
    {
        Company::factory()->count(30)->create();

        $paginator = Company::paginate();

        $repositoryPaginator = $this->repository->paginate();

        $this->assertEquals($paginator->toArray(), $repositoryPaginator->toArray());
    }

    public function testGetById()
    {
        $register = $this->repository->getById();
        $this->assertEquals($register, []);

        $registerCreated = Company::factory()->create();

        $register = $this->repository->getById($registerCreated->id);

        $this->assertEquals($registerCreated->toArray(), $register);

        $registerCreated->delete();

        $this->expectException(ModelNotFoundException::class);
        $this->repository->getById($register['id']);
    }

    public function testDeleteById()
    {
        $registerCreated = Company::factory()->create();
        $this->seeInDatabase($this->table, ['id' => $registerCreated->id]);

        $this->repository->deleteById($registerCreated->id);
        $this->notSeeInDatabase($this->table, ['id' => $registerCreated->id]);

        $this->expectException(ModelNotFoundException::class);
        $this->repository->deleteById($registerCreated->id);
    }

    public function testCreate()
    {
        $this->repository->create($this->createData);

        $this->seeInDatabase($this->table, $this->createData);

        $this->expectException(QueryException::class);
        $this->repository->create([]);
    }

    public function testUpdate()
    {
        $registerCreated = Company::factory()->create($this->createData);
        $this->seeInDatabase($this->table, array_merge(['id' => $registerCreated->id], $this->createData));

        $this->repository->update($registerCreated->id, $this->updateData);

        $this->seeInDatabase($this->table, array_merge(['id' => $registerCreated->id], $this->updateData));
    }
}
