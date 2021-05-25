<?php

namespace App\Domains\AktaNotaris\Services;

use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use App\Services\AppBaseService;

/**
 * Class AktaNoteService.
 */
class AktaNoteService extends AppBaseService
{
    
    public function __construct(AktaNotarisNote $constructor)
    {
        $this->model = $constructor;
    }
}