<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Letter\Http\Controllers\ReportKinerjaController;
use App\Domains\Master\Models\Notaris;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ReportKinerjaTable.
 */
class ReportKinerjaTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'created_at';
    protected $index = 0;
    public $status = 0;
    public $tanggal;
    public $showDateSearch = true;
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
      $this->tanggal = empty($this->tanggal)? date('Y-m-d') : $this->tanggal;
      $notaris = new Notaris();
      $query = $notaris->countUnfinishCovernote($this->tanggal);

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
            Column::make(__('Nama Notaris'), 'nama')
            ->searchable()
            ->sortable(),
            Column::make(__('0 - 3 Bulan'), 'covernote_under90'),
            Column::make(__('3 - 6 Bulan'), 'covernote_between180'),
            Column::make(__('  > 6 Bulan'), 'covernote_more180'),

        ];
    }

    public function export($type)
    {
      $reportController = new ReportKinerjaController();
      return $reportController->download($this->tanggal);
    }
}
