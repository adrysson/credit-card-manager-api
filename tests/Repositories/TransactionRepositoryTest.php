<?php

use App\Models\Card;
use App\Models\Company;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransactionRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected string $table = 'transactions';

    protected TransactionRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app(TransactionRepositoryInterface::class);
    }

    public function testPaginate()
    {
        $transactionFactory = Transaction::factory()->count(10);

        $cardFactory = Card::factory()->count(2)->has($transactionFactory);

        Company::factory()
            ->count(5)
            ->has($cardFactory)
            ->create();

        $paginator = Transaction::paginate();

        $repositoryPaginator = $this->repository->paginate();

        $this->assertEquals($paginator->toArray(), $repositoryPaginator->toArray());
    }

    public function testGetById()
    {
        $emptyRegister = $this->repository->getById();
        $this->assertEquals($emptyRegister, []);

        $companyFactory = Company::factory();
        $cardFactory = Card::factory()->for($companyFactory);

        $companyCreated = Transaction::factory()->for($cardFactory)->create();

        $company = $this->repository->getById($companyCreated->id);

        $this->assertEquals($companyCreated->toArray(), $company);

        $companyCreated->delete();

        $this->expectException(ModelNotFoundException::class);
        $this->repository->getById($company['id']);
    }

    public function testDeleteById()
    {
        $companyFactory = Company::factory();
        $cardFactory = Card::factory()->for($companyFactory);

        $companyCreated = Transaction::factory()->for($cardFactory)->create();
        $this->seeInDatabase($this->table, ['id' => $companyCreated->id]);

        $this->repository->deleteById($companyCreated->id);
        $this->notSeeInDatabase($this->table, ['id' => $companyCreated->id]);

        $this->expectException(ModelNotFoundException::class);
        $this->repository->deleteById($companyCreated->id);
    }

    public function testCreate()
    {
        $companyFactory = Company::factory();
        $card = Card::factory()->for($companyFactory)->create();

        $data = [
            'identifier' => 'Sanduíches',
            'value' => 36.50,
            'card_id' => $card->id,
            'installments' => 2,
            'date' => date('Y-m-d'),
        ];

        $this->repository->create($data);

        $this->seeInDatabase($this->table, $data);

        $this->expectException(QueryException::class);
        $this->repository->create([]);
    }

    public function testUpdate()
    {
        $companyFactory = Company::factory();
        $cardFactory = Card::factory()->for($companyFactory);
        $companyCreated = Transaction::factory()->for($cardFactory)->create();

        $data = $companyCreated->toArray();
        $this->seeInDatabase($this->table, $data);

        $data['identifier'] = 'Pizza';
        $data['value'] = 49.90;
        $data['installments'] = 1;
        $data['date'] = '2021-08-12';

        $this->repository->update($companyCreated->id, $data);

        $this->seeInDatabase($this->table, $data);
    }
}
