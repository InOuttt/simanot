<?php

namespace App\Domains\Covernote\Services;

use App\Domains\Covernote\Models\Covernote;
use App\Services\AppBaseService;

/**
 * Class CovernoteService.
 */
class CovernoteService extends AppBaseService
{
    
    public function __construct(Covernote $constructor)
    {
        $this->model = $constructor;
    }
}