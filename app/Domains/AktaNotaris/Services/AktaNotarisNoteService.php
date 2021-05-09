<?php

namespace App\Domains\AktaNotaris\Services;

use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use App\Services\AppBaseService;

/**
 * Class AktaNotarisService.
 */
class AktaNotarisNoteService extends AppBaseService
{
    
    public function __construct(AktaNotarisNote $constructor)
    {
        $this->model = $constructor;
    }
}