<?php

namespace App\Services\Card;

use App\Services\AbstractUpdateMainService;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateCardService extends AbstractUpdateMainService
{
    use ProvidesConvenienceMethods, CardValidation;
}
