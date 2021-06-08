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
      if(!empty($request->all())) {
        $dt = date('Y-m-t', strtotime($request->tahun . '-' . $request->bulan . '-25' ));
        $data = Covernote::with('notaris')
          ->where('notaris_id', '=', $request->notaris_id)
          ->where('status', '=', $request->status)
          ->where('tanggal_covernote', '<=', $dt)
          ->where('is_perpanjangan_sertifikat', '=', 'N')
          ->distinct('nama_debitur')
          ->get();

        $oldData = Notaris::select('nama', 'id')->where('id', '=', $request->notaris_id)->first();
        $namaNotaris = $oldData->nama;
      }

      return view($this->viewIndex)
        ->withDatas($data)
        ->withOldData($oldData)
        ->withTotalDatas(count($data))
        ->withNamaNotaris($namaNotaris);
    }

}
