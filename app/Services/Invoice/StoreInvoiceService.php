<?php

namespace App\Services\Invoice;

use App\Repositories\Contracts\CardRepositoryInterface;
use App\Repositories\Contracts\MainRepositoryInterface;
use App\Services\AbstractStoreMainService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class StoreInvoiceService extends AbstractStoreMainService
{
    use ProvidesConvenienceMethods, InvoiceValidation;

    protected CardRepositoryInterface $cardRepository;

    public function __construct(MainRepositoryInterface $mainRepository, CardRepositoryInterface $cardRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->cardRepository = $cardRepository;
    }

    public function requiredFieldRules(): array
    {
        $rules = $this->rules();

        foreach ($rules as $field => $fieldRules) {
            if (in_array($field, ['card_id', 'month', 'year'])) {
                $requiredRules[$field] = $fieldRules;
            }
        }

        return $requiredRules;
    }

    private function getDay(Request $request, string $field): string
    {
        $card = $this->cardRepository->getById($request->get('card_id'));

        return str_pad($card[$field], 2, 0, STR_PAD_LEFT);
    }

    private function getMonth(Request $request, bool $previousMonth = false): string
    {
        $month = $request->get('month');

        if ($previousMonth) {
            $month--;
        }

        return str_pad($month, 2, 0, STR_PAD_LEFT);
    }

    private function setDate(Request $request, string $field, bool $previousMonth = false): void
    {
        if (empty($request->get($field))) {

            $day = $this->getDay($request, $field);

            $month = $this->getMonth($request, $previousMonth);

            $year = $request->get('year');

            $request->request->add([$field => "$day-$month-$year"]);
        }
    }

    private function prepare(Request $request): void
    {
        $this->setDate($request, 'due_date');
        $this->setDate($request, 'closing_date', true);
    }

    public function execute(Request $request): array
    {
        $this->validate($request, $this->requiredFieldRules());

        $this->prepare($request);

        $this->validate($request, $this->rules());

        return $this->mainRepository->create($request->all());
    }
}
