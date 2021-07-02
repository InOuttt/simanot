<?php

namespace App\Domains\Master\Services;

use App\Domains\Master\Models\Cluster;
use App\Services\AppBaseService;

/**
 * Class ClusterService.
 */
class ClusterService extends AppBaseService
{
    /**
     * ClusterService constructor.
     *
     * @param  Cluster  $permission
     */
    public function __construct(Cluster $constructor)
    {
        $this->model = $constructor;
    }
}