<?php

use App\Repositories\Contracts\MainRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Laravel\Lumen\Testing\DatabaseTransactions;

abstract class RepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected MainRepositoryInterface $repository;
    protected Model $model;
    protected string $table;
    protected array $createData;
    protected array $updateData;

    abstract protected function getRepository(): MainRepositoryInterface;
    abstract protected function getModel(): Model;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository();
        $this->model = $this->getModel();
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
        $this->model::factory()->count(30)->create();

        $paginator = $this->model::paginate($perPage);

        $repositoryPaginator = $this->repository->paginate($perPage);

        $this->assertEquals($paginator->toArray(), $repositoryPaginator->toArray());
    }

    public function testGetById()
    {
        $register = $this->repository->getById();
        $this->assertEquals($register, []);

        $registerCreated = $this->model::factory()->create();

        $register = $this->repository->getById($registerCreated->id);

        $this->assertEquals($registerCreated->toArray(), $register);

        $registerCreated->delete();

        $this->expectException(ModelNotFoundException::class);
        $this->repository->getById($register['id']);
    }

    public function testDeleteById()
    {
        $registerCreated = $this->model::factory()->create();
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
        $registerCreated = $this->model::factory()->create($this->createData);
        $this->seeInDatabase($this->table, array_merge(['id' => $registerCreated->id], $this->createData));

        $this->repository->update($registerCreated->id, $this->updateData);

        $this->seeInDatabase($this->table, array_merge(['id' => $registerCreated->id], $this->updateData));
    }
}
