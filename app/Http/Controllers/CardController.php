<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CardRepositoryInterface;
use App\Services\Card\StoreCardService;
use App\Services\Card\UpdateCardService;

class CardController extends Controller
{
    public function __construct(CardRepositoryInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->storeService = new StoreCardService($this->mainRepository);
        $this->updateService = new UpdateCardService($this->mainRepository);
    }
}
