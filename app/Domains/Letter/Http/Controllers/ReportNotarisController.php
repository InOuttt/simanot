<?php
namespace App\Domains\Letter\Http\Controllers;

use App\Domains\Master\Models\Notaris;
use App\Http\Controllers\Requests\BaseRequest;
use PDF;

class ReportNotarisController {

  public $viewIndex = 'backend.report.notaris.index';
  public $viewPdf = 'backend.report.notaris.pdf_view';


  public function index(BaseRequest $request) {
    return view($this->viewIndex);
  }

  public function download($bulan, $tahun) {
    // dd($bulan, $tahun);
    $data = Notaris::countNotarisCovernote($bulan, $tahun)->get();
    $bulanLabel = 'Semua Bulan';
    if($bulan != 0) {
      $bulanLabel = __(date('F', strtotime($tahun.'-'.$bulan.'-'.'1')));
    }

    view()->share('datas',$data);
    view()->share('bulan',$bulanLabel);
    view()->share('tahun',$tahun);
    $pdf = PDF::loadView('backend.report.notaris.pdf_view', $data);
    $pdf->setPaper('legal', 'landscape');

    // return response()->file($pdf->download('Laporan Notaris-'.$bulanLabel.'-'.$tahun.'.pdf'));
    // return $pdf->download('Laporan Notaris-'.$bulanLabel.'-'.$tahun.'.pdf');
    // return $pdf->stream();
    return response()->streamDownload(function () use ($pdf){
      echo $pdf->stream();
     }, 'Laporan Notaris-'.$bulanLabel.'-'.$tahun.'.pdf');
}


}