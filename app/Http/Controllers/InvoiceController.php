<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CardRepositoryInterface;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Services\Invoice\StoreInvoiceService;
use App\Services\Invoice\UpdateInvoiceService;

class InvoiceController extends Controller
{
    public function __construct(InvoiceRepositoryInterface $mainRepository, CardRepositoryInterface $cardRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->storeService = new StoreInvoiceService($this->mainRepository, $cardRepository);
        $this->updateService = new UpdateInvoiceService($this->mainRepository);
    }
}
