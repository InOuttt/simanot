<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Master\Models\Notaris;
use Illuminate\Http\Request;

class PartnerSelect2 extends Component
{

    public $notaris = [
        "id" => "nama"
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
        return view('livewire.partner-dropdown')
            ->withOldData($this->oldData)
            ->extends('layouts.app');
    }

    public function selectSearch(Request $request)
    {
    	$notaris = [];

        if($request->has('q')){
            $search = $request->q;
            $notaris =Notaris::select("id", "nama")
            		->where('nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $notaris = Notaris::select('id', 'nama')
                    ->orderBy('nama')
                    ->get();
        }
        $this->notaris = $notaris;
        return response()->json($notaris);
    }
}