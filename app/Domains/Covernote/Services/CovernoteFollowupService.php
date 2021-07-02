<?php

namespace App\Domains\Covernote\Services;

use App\Domains\Covernote\Models\CovernoteFollowup;
use App\Services\AppBaseService;

/**
 * Class CovernoteDocumentService.
 */
class CovernoteFollowupService extends AppBaseService
{
    
    public function __construct(CovernoteFollowup $constructor)
    {
        $this->model = $constructor;
    }
}