<?php

namespace App\Http\Livewire\Backend;

use App\Domains\AktaNotaris\Models\AktaNotaris;
use App\Domains\Notaris\Models\Notaris;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class AktaNotarisTable.
 */
class AktaNotarisTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';

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
        return AktaNotaris::query();
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
              ->format(function (AktaNotaris $model) {
                  return $this->html($model->notaris_name);
              }),
            Column::make(__('No.Covernote '), 'no_covernote')
                ->searchable()
                ->sortable(),
            Column::make(__('Tanggal Covernote'), 'tanggal_covernote')
              ->searchable()
              ->sortable(),
            Column::make(__('Durasi'), 'durasi')
              ->searchable()
              ->sortable(),
            Column::make(__('Jatuh Tempo'), 'jatuh_tempo')
              ->searchable()
              ->sortable(),
            Column::make(__('OS'), 'os')
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
            Column::make(__('Nomor Tanggal Dokumen'), 'nomor_tanggal_dokumen')
              ->searchable()
              ->sortable(),
            Column::make(__('Status Dokumen'), 'status_dokumen')
              ->searchable()
              ->sortable(),
            Column::make(__('Tanggal Terima Dokumen'), 'tanggal_terima_dokumen')
              ->searchable()
              ->sortable(),
            Column::make(__('Jumlah Salinan'), 'jumlah_salinan')
              ->searchable()
              ->sortable(),
            Column::make(__('Tanggal Selesai'), 'tanggal_selesai')
              ->searchable()
              ->sortable(),
            Column::make(__('Tanggal Kirim Salinan'), 'tanggal_kirim_salinan')
              ->searchable()
              ->sortable(),
            Column::make(__('Keterangan'), 'notes_label')
              ->searchable(function ($builder, $term) {
                return $builder->orWhereHas('akta_notaris_note', function ($query) use ($term) {
                    return $query->where('note', 'like', '%'.$term.'%');
                });
              })
              ->format(function (AktaNotaris $model) {
                  return $this->html($model->note_label);
              }),
            Column::make(__('Actions'))
                ->format(function (AktaNotaris $model) {
                    return view('backend.akta_notaris.includes.actions', ['model' => $model]);
                }),
        ];
    }
}
