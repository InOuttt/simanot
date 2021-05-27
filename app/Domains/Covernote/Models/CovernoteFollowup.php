<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Covernote\Models\Covernote;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CovernoteFollowup extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'covernote_dokumen_id',
        'type',
        'note_date',
        'note',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote_followup";
    }

    /** Relationship */
    public function covernoteDocument() {
        return $this->belongsTo(CovernoteDocument::class, 'id', 'covernote_dokumen_id');
    }
}
