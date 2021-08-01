<?php

namespace App\Services;

use App\Repositories\Contracts\MainRepositoryInterface;

abstract class AbstractMainService
{
    protected MainRepositoryInterface $mainRepository;

    public function __construct(MainRepositoryInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
}
