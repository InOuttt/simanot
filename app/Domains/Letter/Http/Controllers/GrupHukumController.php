<?php

namespace App\Domains\Letter\Http\Controllers;

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
        $this->view_index = 'backend.letter.group_hukum.index';
        $this->route_view_index = 'letter.grup_hukum.index';
        $this->view_edit = 'backend.letter.group_hukum.edit';
        $this->view_create = 'backend.letter.group_hukum.create';
    }

    public function index()
    {
        return view($this->view_index);
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(GrupHukumRequest $request)
    {
        $update = $request->all();
        if($request->hasFile('file')) {
            try {

                $file = $request->file('file');
                $fileName = $update['cluster_id']. '-' . $file->getClientOriginalName();
                $uploaded = File::create([
                    'path' => File::$filePath['laporan_grup_hukum'] . '/' . $fileName,
                    'type' => $file->getClientOriginalExtension()
                ]);

                if(!empty($uploaded) && !empty($uploaded->id)) {
                    $file->move(File::$filePath['laporan_grup_hukum'], $fileName);
                    $update['file_id'] = $uploaded->id;
                }

            } catch (\Throwable $th) {
                dd($th);
                return back()->withErrors('Gagal upload file Laporan Grup Hukum');
            }
        }
        $suratTagihan= $this->service->store($update);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
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
        $data = $covernoteDocument->getDueDocument(null, $bulan, $tahun)
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
