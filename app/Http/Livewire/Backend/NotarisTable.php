<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Master\Models\Notaris;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class NotarisTable.
 */
class NotarisTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';
    protected $index = 0;
    public $searchNotaris = false;
    public $searchDebitur = false;
    
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
        return Notaris::query();
    }

    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('No.'))->format(fn () => ++$this->index),
            Column::make(__('Nama'), 'nama')
                ->searchable()
                ->sortable(),
            Column::make(__('Nama Pasangan'), 'partner_id')
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('nama', $direction);
                })
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('partner', function ($query) use ($term) {
                        return $query->where('nama', 'like', '%'.$term.'%');
                });
                })
                ->format(function (Notaris $model) {
                  return $this->html($model->partner_name);
                }),
            Column::make(__('Alamat'), 'alamat')
              ->searchable()
              ->sortable(),
            Column::make(__('Domisili'), 'domisili')
              ->searchable()
              ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Notaris $model) {
                    return view('backend.notaris.includes.actions', ['model' => $model]);
                }),
        ];
    }
}
