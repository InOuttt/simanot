<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Notaris\Models\Notaris;
use Illuminate\Http\Request;

class NotarisSelect2 extends Component
{

    public $notaris = [
        "id" => "name"
    ];
    public $realData = '';

    public function __construct()
    {
        $this->selectSearch(new Request());
    }

    public function render()
    {
        return view('livewire.select2-dropdown')->extends('layouts.app');
    }

    public function selectSearch(Request $request)
    {
    	$notaris = [];

        if($request->has('q')){
            $search = $request->q;
            $notaris =Notaris::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->where('pending_akta', '<=', 15)
            		->get();
        } else {
            $notaris = Notaris::select('id', 'name')
                        ->where('pending_akta', '<=', 15)
                        ->orderBy('name')
                        ->get();
        }
        $this->notaris = $notaris;
        return response()->json($notaris);
    }
}