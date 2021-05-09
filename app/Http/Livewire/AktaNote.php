<?php

namespace App\Http\Livewire;

use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use Livewire\Component;

class AktaNote extends Component
{
    public Array $notes; 
    public $note;
    public  $id_akta_hutang;
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
        if(!empty($this->id_akta_hutang)) {
            $this->notes = AktaNotarisNote::where('id_akta_hutang', '=', $this->id_akta_hutang);
        }

        return view('livewire.akta-note');
    }

    private function resetInputFields(){
        $this->note = '';
    }

    public function mount()
    {
        if(old('note')) {
            $this->note = old('note');
        }
    }
}
