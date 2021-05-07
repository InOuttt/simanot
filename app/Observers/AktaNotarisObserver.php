<?php

namespace App\Observers;

use App\Domains\AktaNotaris\Models\AktaNotaris;
use Illuminate\Support\Facades\Auth;

class AktaNotarisObserver
{
    public function creating(AktaNotaris $post)
    {
        $post->created_by = Auth::user()->id;
        $post->updated_by = Auth::user()->id;
    }

    public function updating(AktaNotaris $post)
    {
        $post->updated_by = Auth::user()->id;
    }
}
