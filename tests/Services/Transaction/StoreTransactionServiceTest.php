<?php

use App\Models\Card;
use App\Models\Company;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Services\Transaction\StoreTransactionService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Testing\DatabaseTransactions;

class StoreTransactionServiceTest extends TestCase
{
    use DatabaseTransactions;

    private StoreTransactionService $service;

    private array $data;

    private string $table = 'transactions';

    public function setUp(): void
    {
        parent::setUp();

        $repository = app(TransactionRepositoryInterface::class);

        $this->service = new StoreTransactionService($repository);
    }

    public function requiredFieldsProvider(): array
    {
        return [
            'identifier-required' => ['identifier'],
            'value-required' => ['value'],
            'card_id-required' => ['card_id'],
            'date-required' => ['date'],
        ];
    }

    public function stringFieldsProvider(): array
    {
        return [
            'identifier-string' => ['identifier'],
        ];
    }

    public function numericFieldsProvider(): array
    {
        return [
            'value-numeric' => ['value'],
        ];
    }

    public function integerFieldsProvider(): array
    {
        return [
            'card-id-integer' => ['card_id'],
            'installments-integer' => ['installments'],
        ];
    }

    public function existsFieldsProvider(): array
    {
        return [
            'card-id-exists' => ['card_id'],
        ];
    }

    public function dateFieldsProvider(): array
    {
        return [
            'date-date' => ['date'],
        ];
    }

    private function getData(bool $createCard = true): array
    {
        $companyFactory = Company::factory();
        $cardFactory = Card::factory()->for($companyFactory);
        if ($createCard) {
            $cardFactory = $cardFactory->create();
        }
        $companyCreated = Transaction::factory()->for($cardFactory)->make();
        return $companyCreated->toArray();
    }

    /**
     * @dataProvider requiredFieldsProvider
     */
    public function testRequiredFields(string $field): void
    {
        $request = new Request();
        $data = $this->getData();
        $data[$field] = '';
        $request->merge($data);
        $this->expectException(ValidationException::class);
        $this->service->execute($request);
    }

    /**
     * @dataProvider stringFieldsProvider
     */
    public function testStringFields(string $field): void
    {
        $request = new Request();
        $data = $this->getData();
        $data[$field] = random_int(1, 100);
        $request->merge($data);
        $this->expectException(ValidationException::class);
        $this->service->execute($request);
    }

    /**
     * @dataProvider numericFieldsProvider
     */
    public function testNumericFields(string $field): void
    {
        $request = new Request();
        $data = $this->getData();
        $data[$field] = 'Teste';
        $request->merge($data);
        $this->expectException(ValidationException::class);
        $this->service->execute($request);
    }

    /**
     * @dataProvider integerFieldsProvider
     */
    public function testIntegerFields(string $field): void
    {
        $request = new Request();
        $data = $this->getData();
        $data[$field] = 'Teste';
        $request->merge($data);
        $this->expectException(ValidationException::class);
        $this->service->execute($request);
    }

    /**
     * @dataProvider existsFieldsProvider
     */
    public function testExistsFields(string $field): void
    {
        $request = new Request();
        $data = $this->getData(false);
        $data[$field] = random_int(1, 100);
        $request->merge($data);
        $this->expectException(ValidationException::class);
        $this->service->execute($request);
    }

    /**
     * @dataProvider dateFieldsProvider
     */
    public function testDateFields(string $field): void
    {
        $request = new Request();
        $data = $this->getData();
        $data[$field] = 'Teste';
        $request->merge($data);
        $this->expectException(ValidationException::class);
        $this->service->execute($request);
    }

    public function testExecute(): void
    {
        $request = new Request();
        $data = $this->getData();
        $request->merge($data);

        $this->service->execute($request);

        $this->seeInDatabase($this->table, $data);

        // TODO: check if the invoice items were registered correctly
    }
}
