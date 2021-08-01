<?php

namespace App\Services;

use App\Services\AbstractMainService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class AbstractUpdateMainService extends AbstractMainService
{
    use ProvidesConvenienceMethods;

    abstract protected function rules(): array;

    public function execute(int $id, Request $request): array
    {
        $this->validate($request, $this->rules());

        if (!$this->mainRepository->update($id, $request->all())) {
            throw new BadRequestHttpException(trans('Error updating, try again'));
        }

        return $this->mainRepository->getById($id);
    }
}
