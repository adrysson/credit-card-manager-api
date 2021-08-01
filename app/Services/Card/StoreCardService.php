<?php

namespace App\Services\Card;

use App\Services\AbstractStoreMainService;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class StoreCardService extends AbstractStoreMainService
{
    use ProvidesConvenienceMethods, CardValidation;
}
