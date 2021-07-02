<?php

namespace App\Domains\Inquiry\Http\Controllers;

use App\Domains\Covernote\Models\CovernoteDocument;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Letter\Services\GrupHukumService;
use App\Domains\Letter\Http\Requests\GrupHukumRequest;
use App\Domains\Letter\Models\GrupHukum;
use App\Domains\Letter\Models\SuratTagihan;
use App\Models\File;
use PDF;

class GrupHukumController extends BaseBackendController
{
    public function __construct(GrupHukumService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.inquiry.grup_hukum';
        $this->route_view_index = 'inquiry.grup_hukum.index';
    }

    public function index()
    {
        return view($this->view_index);
    }

    public function download($clusterId, $bulan, $tahun) {
        $checkUploaded = GrupHukum::where([
            'cluster_id' => $clusterId,
            'bulan' => $bulan,
            'tahun' => $tahun
            ])
            ->first();
        if(empty($checkUploaded)) {
            return $this->generateTagihan($clusterId, $bulan, $tahun);
        } 

        return redirect('/'.$checkUploaded->file->path);
    }

    public function generateTagihan($clusterId, $bulan, $tahun) {
        $covernoteDocument = new CovernoteDocument();
        $data = $covernoteDocument->getDueDocument('0', $bulan, $tahun)
            ->with(['covernote.cluster', 'followup'])
            ->whereHas('covernote', function($q) use ($clusterId) {
                $q->where('cluster_id', '=', $clusterId);
            })
            ->get();
        $namaCluster = $data->first()->covernote->cluster->nama;
        $bulanLabel = __(date('F', strtotime($tahun.'-'.$bulan.'-'.'1')));

        view()->share('datas',$data);
        view()->share('bulan',$bulanLabel);
        view()->share('tahun',$tahun);
        view()->share('cluster',$namaCluster);
        $pdf = PDF::loadView('backend.letter.group_hukum.pdf_view', $data);
        $pdf->setPaper('legal', 'landscape');

        return $pdf->download($namaCluster.'-'.$bulanLabel.'-'.$tahun.'.pdf');
        // return $pdf->stream();
    }

}
