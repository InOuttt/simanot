<?php

namespace App\Domains\Master\Services;

use App\Domains\Master\Models\Notaris;
use App\Services\AppBaseService;

/**
 * Class NotarisService.
 */
class NotarisService extends AppBaseService
{
    /**
     * NotarisService constructor.
     *
     * @param  Notaris  $permission
     */
    public function __construct(Notaris $constructor)
    {
        $this->model = $constructor;
    }
}