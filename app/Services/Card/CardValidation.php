<?php

namespace App\Services\Card;

use Illuminate\Validation\Rule;

trait CardValidation
{
    public function rules(): array
    {
        for ($day = 1; $day <= 31; $day++) {
            $days[] = $day;
        }
        return [
            'identifier' => ['required', 'unique:cards'],
            'company_id' => ['required', 'exists:companies,id'],
            'due_date' => ['required', Rule::in($days)],
            'closing_date' => ['required', Rule::in($days)],
            'processing_days' => ['required', 'integer'],
        ];
    }
}
