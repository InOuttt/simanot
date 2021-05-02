<?php

namespace App\Domains\Notaris\Services;

use App\Domains\Notaris\Models\Notaris;
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