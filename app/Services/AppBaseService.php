<?php

namespace App\Services;

use App\Events\DataCreatedEvenet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use App\Events\DataCreatedEvent;

/**
 * Class RoleService.
 */
class AppBaseService extends BaseService
{
    /**
     * AppBaseService constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param  array  $data
     *
     * @return Model
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Model
    {
        DB::beginTransaction();
        try {
            $model = $this->model::create($data);
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating the data.'));
        }

        event(new DataCreatedEvent($model));

        DB::commit();

        return $model;
    }

    /**
     * @param  Model  $model
     * @param  array  $data
     *
     * @return Model Data
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Model $model, array $data = []): Model
    {
        DB::beginTransaction();

        try {
            $model->update($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating the data.'));
        }

        event(new DataCreatedEvent($model));

        DB::commit();

        return $model;
    }

    /**
     * @param  Model  $model
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Model $model): bool
    {
        if ($this->deleteById($model->id)) {
            return true;
        }

        throw new GeneralException(__('There was a problem deleting the role.'));
    }
}
