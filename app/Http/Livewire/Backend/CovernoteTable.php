<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Master\Models\Notaris;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CovernoteTable.
 */
class CovernoteTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';
    protected $index = 0;
    
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
        return Covernote::query();
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
            Column::make(__('Nama Notaris'), 'notaris_name')
              ->sortable(function ($builder, $direction) {
                return $builder->orderBy('notaris.nama', $direction);
              })
              ->searchable(function ($builder, $term) {
                return $builder->orWhereHas('notaris', function ($query) use ($term) {
                    return $query->where('nama', 'like', '%'.$term.'%');
                });
              })
              ->format(function (Covernote $model) {
                  return $this->html($model->notaris_name);
              }),
            Column::make(__('Nomor Covernote '), 'no_covernote')
                ->searchable()
                ->sortable(),
            Column::make(__('Nama Debitur'), 'nama_debitur')
                ->searchable()
                ->sortable(),
            Column::make(__('Tanggal Covernote'), 'tanggal_covernote')
              ->searchable()
              ->sortable(),
            Column::make(__('Status Covernote'), 'status_label')
              ->searchable()
              ->sortable(),
            // Column::make(__('Keterangan'), 'notes_label')
            //   ->searchable(function ($builder, $term) {
            //     return $builder->orWhereHas('notes', function ($query) use ($term) {
            //         return $query->where('note', 'like', '%'.$term.'%');
            //     });
            //   })
            //   ->format(function (Covernote $model) {
            //       return $this->html($model->note_label);
            //   }),
            Column::make(__('Actions'))
                ->format(function (Covernote $model) {
                    return view('backend.covernote.includes.actions', ['model' => $model]);
                }),
        ];
    }
}
