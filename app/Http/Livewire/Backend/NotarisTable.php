<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Notaris\Models\Notaris;
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
            Column::make(__('Nama'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Nama Pasangan'), 'couple_name')
                ->searchable()
                ->sortable(),
            Column::make(__('Alamat'), 'domicile')
              ->searchable()
              ->sortable(),
            Column::make(__('Domisili'), 'domicile')
              ->searchable()
              ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Notaris $model) {
                    return view('backend.notaris.includes.actions', ['model' => $model]);
                }),
        ];
    }
}
