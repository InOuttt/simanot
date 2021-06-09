<?php

namespace App\Http\Livewire\Backend\Inquiry;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Letter\Models\GrupHukum;
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
    public $cluster;
    public $status = 0;
    public $tahun;
    public $bulan = 6;
    public $nama_cluster;
    public $searchNotaris = true;
    public $searchTagihan = true;
    public $searchEnabled = false;
    public $showNotarisSearch = false;
    public $showStatusAktaSearch = false;
    public $showClusterSearch = true;
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
      $query = GrupHukum::query()->with('cluster');
      $this->bulan = empty($this->bulan)? date('n') : $this->bulan;
      $this->tahun = empty($this->tahun)? date('Y') : $this->tahun;

      $query = $query->where('bulan', '=', $this->bulan);
      $query = $query->where('tahun', '=', $this->tahun);

      if(!empty($this->cluster)) {
        $nama = $this->cluster;
        $query = $query->whereHas('cluster', function ($q) use ($nama) {
          $q->where('nama', 'LIKE', '%'.$nama.'%');
          // $q->where('nama', '=', $nama);
        });
      }
      return $query;
    }

    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;
        $this->bulan = date('n');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('No.'))->format(fn () => ++$this->index),
            Column::make(__('Cluster'), 'cluster.nama'),
            Column::make(__('Bulan'), 'bulan')
              ->sortable()
              ->searchable()
              ->format(function (GrupHukum $model) {
                  return __('bulan-'.$model->bulan);
              }),
            Column::make(__('Tahun'), 'tahun')
            ->sortable()
            ->searchable(),
            Column::make(__('Tanggal Email'), 'tanggal_email')
              ->format(function (GrupHukum $model) {
                return carbon($model->tanggal_email)->format('d-m-Y');
              }),
            Column::make(__('View'))
                ->format(function (GrupHukum $model) {
                    return $this->html($model->fileDownloadPathButton);
                }),
        ];
    }
}
