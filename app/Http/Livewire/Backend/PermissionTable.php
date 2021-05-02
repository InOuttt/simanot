<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class PermissionTable.
 */
class PermissionTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Permission::query();
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'), 'type')
                ->sortable()
                ->format(function (Permission $model) {
                    if ($model->type === User::TYPE_ADMIN) {
                        return __('Administrator');
                    }

                    if ($model->type === User::TYPE_USER) {
                        return __('User');
                    }

                    return 'N/A';
                }),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Description'), 'description')
                ->searchable()
                ->sortable(),
            Column::make(__('Parent'), 'parent_label')
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('parent_id', $direction);
                })
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('parent', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                })
                ->format(function (Permission $model) {
                    return $this->html($model->parent_label);
                }),
            Column::make(__('Actions'))
                ->format(function (Permission $model) {
                    return view('backend.auth.permission.includes.actions', ['model' => $model]);
                }),
        ];
    }
}
