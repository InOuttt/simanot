<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Letter\Http\Controllers\ReportNotarisController;
use App\Domains\Master\Models\Notaris;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ReportNotarisTable.
 */
class ReportNotarisTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';
    protected $index = 0;
    public $status = 0;
    public $tahun;
    public $bulan;
    public $searchNotaris = false;
    public $searchTagihan = true; //show bulan & tahun
    public $searchEnabled = false;
    public $showNotarisSearch = false;
    public $allMonth = true;
    public $exports = [
      'pdf'
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
      $this->bulan = empty($this->bulan)? 0 : $this->bulan;
      $this->tahun = empty($this->tahun)? date('Y') : $this->tahun;
      $query = Notaris::countNotarisCovernote($this->bulan, $this->tahun);

      return $query;
    }

    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;
        $this->bulan = 0;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('No.'))->format(fn () => ++$this->index),
            Column::make(__('Nama Notaris'), 'nama'),
            Column::make(__('Total Covernote'), 'covernotes_count'),
            Column::make(__('Total Dokumen'), 'covernotes_documents_count'),
            Column::make(__('Dokumen Belum Selesai'), 'documents_unfinish_count'),
            Column::make(__('Dokumen Selesai'), 'documents_finish_count'),
            Column::make(__('Dokumen Koreksi'), 'documents_correction_count'),

        ];
    }

    public function export($type)
    {
      $reportController = new ReportNotarisController();
      return $reportController->download($this->bulan, $this->tahun);
    }
}
