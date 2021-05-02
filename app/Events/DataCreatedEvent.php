<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleCreated.
 */
class DataCreatedEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $model;

    /**
     * @param $role
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
