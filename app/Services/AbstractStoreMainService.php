<?php

namespace App\Services;

use App\Services\AbstractMainService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

abstract class AbstractStoreMainService extends AbstractMainService
{
    use ProvidesConvenienceMethods;

    abstract protected function rules(): array;

    public function execute(Request $request): array
    {
        $this->validate($request, $this->rules());

        return $this->mainRepository->create($request->all());
    }
}
