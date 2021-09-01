<?php

namespace App\Http\Livewire\Backend\Inquiry;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteDocument;
use App\Http\Livewire\Backend\CovernoteDocumentTable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class StatusAktaTable.
 */
class StatusAktaTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';
    protected $index = 0;
    public $nama_notaris;
    public $nama_debitur;
    public $status;
    public $searchNotaris = true;
    public $searchDebitur = true;
    
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
      $query = CovernoteDocument::query();
      if(!empty($this->nama_debitur)) {
        $nama = $this->nama_debitur;
        $query->whereHas('covernote', function($q) use ($nama) {
          $q->where('nama_debitur', 'LIKE', '%' . $nama . '%');
        });
      }
      if(!empty($this->nama_notaris)) {
        $nama = $this->nama_notaris;
        $query->whereHas('covernote.notaris', function($q) use ($nama) {
          $q->where('nama', 'LIKE', '%' . $nama . '%');
        });
      }
      if(!empty($this->status) || $this->status == '0') {
        $query->where('status', '=', $this->status);
      }
        return $query;
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
            Column::make(__('Notaris'), 'covernote.notaris.nama')
              ->sortable(function ($builder, $direction) {
                return $builder->orderBy('covernote.notaris.nama', $direction);
              })
              ->searchable(function ($builder, $term) {
                return $builder->orWhereHas('covernote.notaris', function ($query) use ($term) {
                    return $query->where('nama', 'like', '%'.$term.'%');
                });
              }),
            Column::make(__('Nomor Covernote'), 'covernote.no_covernote')
              ->searchable()
              ->sortable(),
            Column::make(__('Nama Debitur'), 'covernote.nama_debitur')
              ->searchable()
              ->sortable(),
            Column::make(__('Nama Dokumen'), 'nama')
            ->searchable()
            ->sortable(),
            Column::make(__('Nomor Dokumen'), 'nomor')
              ->searchable()
              ->sortable(),
            Column::make(__('Tanggal Terbit Dokumen'), 'tanggal_terbit')
              ->searchable()
              ->sortable()
              ->format(function (CovernoteDocument $model) {
                return carbon($model->tanggal_terbit)->format('d-m-Y');
              }),
            Column::make(__('Tanda terima Notaris'), 'file_notaris_download')
              ->format(function (CovernoteDocument $model) {
                  return $this->html($model->file_notaris_download);
            }),
            Column::make(__('Tanda terima Debitur'), 'file_debitur_download')
              ->format(function (CovernoteDocument $model) {
                  return $this->html($model->file_debitur_download);
            }),
            Column::make(__('View'))
                ->format(function (CovernoteDocument $model) {
                    return view('backend.inquiry.includes.status_akta', ['model' => $model]);
                }),
        ];
    }
}
