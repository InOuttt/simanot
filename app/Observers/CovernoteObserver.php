<?php

namespace App\Observers;

use App\Domains\Covernote\Models\Covernote;
use Illuminate\Support\Facades\Auth;

class CovernoteObserver
{
    public function creating(Covernote $post)
    {
        $post->created_by = Auth::user()->id;
        $post->updated_by = Auth::user()->id;
    }

    public function updating(Covernote $post)
    {
        $post->updated_by = Auth::user()->id;
    }
}
