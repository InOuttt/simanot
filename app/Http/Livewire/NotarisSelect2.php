<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Master\Models\Notaris;
use Illuminate\Http\Request;

class NotarisSelect2 extends Component
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
        return view('livewire.select2-dropdown')
            ->withOldData($this->oldData)
            ->extends('layouts.app');
    }

    public function selectSearch(Request $request)
    {
    	$notaris = [];

        if($request->has('q')){
            $search = $request->q;
            $notaris =Notaris::select("id", "nama")
                    // ->withCount(['covernotes' => function($query) {
                    //         $query->where('status', 1);
                    //     }])
            		->where('nama', 'LIKE', "%$search%")
            		// ->having('covernotes_count', '<=', 15)
            		->get();
        } else {
            $notaris = Notaris::select('id', 'nama')
                    // ->withCount(['covernotes' => function($query) {
                    //         $query->where('status', 1);
                    //     }])
            		// ->having('covernotes_count', '<=', 15)
                    ->orderBy('nama')
                    ->get();
        }
        $this->notaris = $notaris;
        return response()->json($notaris);
    }
}