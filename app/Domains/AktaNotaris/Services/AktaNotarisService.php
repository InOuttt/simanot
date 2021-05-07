<?php

namespace App\Domains\AktaNotaris\Services;

use App\Domains\AktaNotaris\Models\AktaNotaris;
use App\Services\AppBaseService;

/**
 * Class AktaNotarisService.
 */
class AktaNotarisService extends AppBaseService
{
    
    public function __construct(AktaNotaris $constructor)
    {
        $this->model = $constructor;
    }
}