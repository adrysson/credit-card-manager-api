<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\MainRepositoryInterface;
use App\Services\AbstractStoreMainService;
use App\Services\AbstractUpdateMainService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected MainRepositoryInterface $mainRepository;
    protected AbstractStoreMainService $storeService;
    protected AbstractUpdateMainService $updateService;

    public function index()
    {
        return $this->mainRepository->paginate();
    }

    public function store(Request $request)
    {
        return $this->storeService->execute($request);
    }

    public function view(int $id)
    {
        return $this->mainRepository->getById($id);
    }

    public function update(int $id, Request $request)
    {
        return $this->updateService->execute($id, $request);
    }

    public function destroy(int $id)
    {
        return $this->mainRepository->deleteById($id);
    }
}
