<?php

namespace App\Domains\Inquiry\Http\Controllers;

use App\Domains\Covernote\Models\CovernoteFollowup;

class StatusAktaController
{
    public $viewIndex = 'backend.inquiry.status_akta';

    public function index() 
    {
      return view($this->viewIndex);
    }

    public function followup($id)
    {
        $followUps = CovernoteFollowup::where('covernote_dokumen_id', '=', $id)->orderBy('tanggal_followup', 'DESC');
        $followUps = $followUps->get();
        
        return JSON_ENCODE($followUps);
    }


}
