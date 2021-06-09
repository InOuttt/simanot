<?php

namespace App\Domains\Inquiry\Http\Controllers;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteFollowup;
use App\Domains\Master\Models\Notaris;
use App\Http\Controllers\Requests\BaseRequest;

class IndexNotarisController
{
    public $viewIndex = 'backend.inquiry.index_notaris';

    public function index(BaseRequest $request) 
    {
      $data = [];
      $namaNotaris = '';
      $oldData = [];
      $bulan = date('n');
      $tahun = date('Y');

      if(!empty($request->all())) {
        $dt = date('Y-m-t', strtotime($request->tahun . '-' . $request->bulan . '-25' ));
        $data = Covernote::with('notaris')
          ->where('notaris_id', '=', $request->notaris_id)
          ->where('status', '=', $request->status)
          ->where('jatuh_tempo', '<=', $dt)
          ->where('is_perpanjangan_sertifikat', '=', '0')
          ->distinct('nama_debitur')
          ->get();

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $oldData = Notaris::select('nama', 'id')->where('id', '=', $request->notaris_id)->first();
        $namaNotaris = $oldData->nama;
      }
      $dateData = ['bulan'=>$bulan, 'tahun'=>$tahun];

      return view($this->viewIndex)
        ->withDatas($data)
        ->withOldData($oldData)
        ->withTotalDatas(count($data))
        ->withDateData($dateData)
        ->withNamaNotaris($namaNotaris);
    }

}
