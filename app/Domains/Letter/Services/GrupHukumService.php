<?php

namespace App\Domains\Letter\Services;

use App\Domains\Letter\Models\GrupHukum;
use App\Services\AppBaseService;

/**
 * Class GrupHukumService.
 */
class GrupHukumService extends AppBaseService
{
    
    public function __construct(GrupHukum $constructor)
    {
        $this->model = $constructor;
    }
}