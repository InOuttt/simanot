<?php

namespace App\Domains\Inquiry\Http\Controllers;

use App\Domains\Covernote\Models\CovernoteDocument;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Letter\Services\TagihanNotarisService;
use App\Domains\Letter\Http\Requests\TagihanNotarisRequest;
use App\Domains\Letter\Models\SuratTagihan;
use App\Models\File;
use PDF;

class TagihanNotarisController extends BaseBackendController
{
    public function __construct(TagihanNotarisService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.inquiry.tagihan_notaris';
        $this->route_view_index = 'inquiry.tagihan_notaris.index';
    }

    public function index()
    {
        return view($this->view_index);
    }

    public function download($notarisId, $bulan, $tahun) {
        $checkUploaded = SuratTagihan::where([
            'notaris_id' => $notarisId,
            'bulan' => $bulan,
            'tahun' => $tahun
            ])
            ->first();
        if(empty($checkUploaded)) {
            return $this->generateTagihan($notarisId, $bulan, $tahun);
        } 

        return redirect('/'.$checkUploaded->file->path);
    }

    public function generateTagihan($notarisId, $bulan, $tahun) {
        $covernoteDocument = new CovernoteDocument();
        $data = $covernoteDocument->getDueDocument(null, $bulan, $tahun)
            ->with(['covernote.cluster', 'followup'])
            ->whereHas('covernote', function($q) use ($notarisId) {
                $q->where('notaris_id', '=', $notarisId);
            })
            ->get();
        $namaNotaris = $data->first()->covernote->notaris->nama;
        $bulanLabel = __(date('F', strtotime($tahun.'-'.$bulan.'-'.'1')));

        view()->share('datas',$data);
        view()->share('bulan',$bulanLabel);
        view()->share('tahun',$tahun);
        view()->share('notaris',$namaNotaris);
        $pdf = PDF::loadView('backend.letter.tagihan.pdf_view', $data);
        $pdf->setPaper('legal', 'landscape');
        // $pdf->setOptions(['debugCss'=> true]);

        return $pdf->download($namaNotaris.'-'.$bulanLabel.'-'.$tahun.'.pdf');
        // return $pdf->stream();
        // return view('backend.letter.tagihan.pdf_view')->withData($data);
    }

}
