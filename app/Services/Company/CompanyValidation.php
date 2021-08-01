<?php

namespace App\Services\Company;

trait CompanyValidation
{
    protected function rules(): array
    {
        return [
            'name' => ['required', 'unique:companies'],
        ];
    }
}
