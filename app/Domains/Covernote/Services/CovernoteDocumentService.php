<?php

namespace App\Domains\Covernote\Services;

use App\Domains\Covernote\Models\CovernoteDocument;
use App\Services\AppBaseService;

/**
 * Class CovernoteDocumentService.
 */
class CovernoteDocumentService extends AppBaseService
{
    
    public function __construct(CovernoteDocument $constructor)
    {
        $this->model = $constructor;
    }
}