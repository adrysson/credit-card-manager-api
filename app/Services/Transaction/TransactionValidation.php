<?php

namespace App\Services\Transaction;

use Illuminate\Validation\Rule;

trait TransactionValidation
{
    public function rules(): array
    {
        return [
            'identifier' => ['required', 'string'],
            'value' => ['required', 'numeric'],
            'card_id' => ['required', 'integer', 'exists:cards,id'],
            'installments' => ['integer'],
            'date' => ['required', 'date'],
        ];
    }
}
