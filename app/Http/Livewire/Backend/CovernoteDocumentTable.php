<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Covernote\Models\CovernoteDocument;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CovernoteDocumentTable.
 */
class CovernoteDocumentTable extends TableComponent
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
        return CovernoteDocument::query();
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
            Column::make(__('Notaris'), 'notaris_name')
              ->sortable(function ($builder, $direction) {
                return $builder->orderBy('notaris.name', $direction);
              })
              ->searchable(function ($builder, $term) {
                return $builder->orWhereHas('notaris', function ($query) use ($term) {
                    return $query->where('name', 'like', '%'.$term.'%');
                });
              })
              ->format(function (CovernoteDocument $model) {
                  return $this->html($model->notaris_name);
              }),
            Column::make(__('No.Covernote '), 'no_covernote')
                ->searchable()
                ->sortable(),
            Column::make(__('Jatuh Tempo'), 'jatuh_tempo')
              ->searchable()
              ->sortable(),
            Column::make(__('Status Perpanjangan'), 'is_perpanjangan_sertifikat')
              ->searchable()
              ->sortable(),
            Column::make(__('Cluster'), 'cluster')
              ->searchable()
              ->sortable(),
            Column::make(__('Nama Debitur'), 'nama_debitur')
              ->searchable()
              ->sortable(),
            Column::make(__('Nama Dokumen'), 'nama_dokumen')
              ->searchable()
              ->sortable(),
            Column::make(__('Status Dokumen'), 'status_dokumen')
              ->searchable()
              ->sortable(),
            Column::make(__('Keterangan'), 'notes_label')
              ->searchable(function ($builder, $term) {
                return $builder->orWhereHas('akta_notaris_note', function ($query) use ($term) {
                    return $query->where('note', 'like', '%'.$term.'%');
                });
              })
              ->format(function (CovernoteDocument $model) {
                  return $this->html($model->note_label);
              }),
            Column::make(__('Actions'))
                ->format(function (CovernoteDocument $model) {
                    return view('backend.akta_notaris.includes.followup_action', ['model' => $model]);
                }),
        ];
    }
}
