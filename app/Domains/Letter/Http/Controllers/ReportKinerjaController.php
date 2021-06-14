<?php
namespace App\Domains\Letter\Http\Controllers;

use App\Domains\Master\Models\Notaris;
use App\Http\Controllers\Requests\BaseRequest;
use PDF;

class ReportKinerjaController {

  public $viewIndex = 'backend.report.kinerja.index';
  public $viewPdf = 'backend.report.kinerja.pdf_view';


  public function index(BaseRequest $request) {
    return view($this->viewIndex);
  }

  public function download($tanggal) {
    $notaris = new Notaris();
    $data = $notaris->countUnfinishCovernote($tanggal)->get();
    $tanggalLabel = carbon($tanggal)->format('d-M-Y');
    
    view()->share('datas',$data);
    view()->share('tanggal', carbon($tanggal)->format('d'));
    view()->share('bulan', carbon($tanggal)->format('n'));
    view()->share('tahun', carbon($tanggal)->format('Y'));
    $pdf = PDF::loadView($this->viewPdf, $data);
    $pdf->setPaper('legal', 'landscape');

    return response()->streamDownload(function () use ($pdf){
      echo $pdf->stream();
     }, 'Laporan Kinerja Notaris-'.$tanggalLabel.'.pdf');
}


}