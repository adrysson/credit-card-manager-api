<?php

namespace App\Services\Invoice;

use Illuminate\Validation\Rule;

trait InvoiceValidation
{
    public function rules(): array
    {
        for ($month = 1; $month <= 12; $month++) {
            $months[] = $month;
        }
        return [
            'card_id' => ['required', 'exists:cards,id'],
            'due_date' => ['required', 'date'],
            'closing_date' => ['required', 'date'],
            'month' => ['required', 'integer', Rule::in($months)],
            'year' => ['required', 'integer'],
        ];
    }
}
