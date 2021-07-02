<?php

namespace App\Domains\Letter\Http\Controllers;

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
        $this->view_index = 'backend.letter.tagihan.index';
        $this->route_view_index = 'letter.tagihan.index';
        $this->view_edit = 'backend.letter.tagihan.edit';
        $this->view_create = 'backend.letter.tagihan.create';
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
    public function store(TagihanNotarisRequest $request)
    {
        $update = $request->all();
        if($request->hasFile('file')) {
            try {

                $file = $request->file('file');
                $fileName = $update['notaris_id']. '-' . $file->getClientOriginalName();
                $uploaded = File::create([
                    'path' => File::$filePath['surat_tagihan_notaris'] . '/' . $fileName,
                    'type' => $file->getClientOriginalExtension()
                ]);

                if(!empty($uploaded) && !empty($uploaded->id)) {
                    $file->move(File::$filePath['surat_tagihan_notaris'], $fileName);
                    $update['file_id'] = $uploaded->id;
                }

            } catch (\Throwable $th) {
                dd($th);
                return back()->withErrors('Gagal upload file Surat Tagihan Notaris');
            }
        }
        $suratTagihan= $this->service->store($update);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
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
