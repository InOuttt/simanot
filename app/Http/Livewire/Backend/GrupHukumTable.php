<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteDocument;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class GrupHukumTable.
 */
class GrupHukumTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';
    protected $index = 0;
    public $nama_notaris;
    public $status = 0;
    public $tahun;
    public $bulan = 6;
    public $searchNotaris = true;
    public $searchTagihan = true;
    public $searchEnabled = false;
    public $showNotarisSearch = false;
    public $listBulan = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'Novermber',
      12 => 'Desember',
    ];
    
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
      $query = new Covernote();
      $this->bulan = empty($this->bulan)? date('m') : $this->bulan;
      $this->tahun = empty($this->tahun)? date('Y') : $this->tahun;
      $query = $query->getDueDocument($this->status, $this->bulan, $this->tahun)
        ->groupBy(['cluster_id']);

        return $query;
    }

    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;
        $this->bulan = date('m');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('No.'))->format(fn () => ++$this->index),
            Column::make(__('Cluster'), 'cluster.nama')
              ->sortable(function ($builder, $direction) {
                return $builder->orderBy('cluster.nama', $direction);
              })
              ->searchable(function ($builder, $term) {
                return $builder->orWhereHas('cluster', function ($query) use ($term) {
                    return $query->where('nama', 'like', '%'.$term.'%');
                });
              }),
            Column::make(__('Bulan'), 'tenggat_bulan'),
            Column::make(__('Tahun'), 'tenggat_tahun'),
            Column::make(__('Status Dokumen'), 'status_label')
              ->searchable(function ($builder, $term) {
                return $builder->where('status', 'like', '%'.$term.'%');
              })
              ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Covernote $model) {
                    return view('backend.letter.group_hukum.actions', ['model' => $model]);
                }),
        ];
    }
}
