<?php

namespace App\Http\Livewire;

use App\Domains\Covernote\Models\Covernote;
use Livewire\Component;
use App\Domains\Master\Models\Notaris;
use Illuminate\Http\Request;

class DebiturSelect2 extends Component
{

    public $notaris = [
        "id" => "name"
    ];
    public $realData = '';
    public $oldData;

    public function __construct()
    {
        $this->selectSearch(new Request());
    }

    public function mount($idNotaris = null)
    {
        if(!empty($idNotaris)) {
            $this->oldData = Notaris::getById($idNotaris);
        }
    }

    public function render()
    {
        return view('livewire.select2-debitur')
          ->extends('layouts.app');
    }

    public function selectSearch(Request $request)
    {
    	$notaris = [];

        if($request->has('q')){
            $search = $request->q;
            $notaris =Covernote::select("id", "nama_debitur")
            		->where('nama_debitur', 'LIKE', "%$search%")
                ->limit(10)
            		->get();
        } else {
            $notaris = Covernote::select('id', 'nama_debitur')
                        ->orderBy('nama_debitur')
                        ->limit(10)
                        ->get();
        }
        $this->notaris = $notaris;
        return response()->json($notaris);
    }
}