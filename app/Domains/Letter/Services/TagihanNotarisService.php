<?php

namespace App\Domains\Letter\Services;

use App\Domains\Letter\Models\SuratTagihan;
use App\Services\AppBaseService;

/**
 * Class TagihanNotarisService.
 */
class TagihanNotarisService extends AppBaseService
{
    
    public function __construct(SuratTagihan $constructor)
    {
        $this->model = $constructor;
    }
}