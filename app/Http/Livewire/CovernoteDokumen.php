<?php

namespace App\Http\Livewire;

use App\Domains\Covernote\Models\CovernoteDocument;

use Livewire\WithFileUploads;
use Livewire\Component;

class CovernoteDokumen extends Component
{
  use WithFileUploads;
  
    public Array $dokumens; 
    public $dokumen;
    public  $id_covernote;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function render()
    {
        if(!empty($this->id_covernote)) {
            $this->dokumens = CovernoteDocument::where('id_covernote', '=', $this->id_covernote);
        }

        return view('livewire.covernote-dokumen');
    }

    private function resetInputFields(){
        $this->dokumen = '';
    }

    public function mount()
    {
        if(old('dokumen')) {
            $this->dokumen = old('dokumen');
        }
    }
}
