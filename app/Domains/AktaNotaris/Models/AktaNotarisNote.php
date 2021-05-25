<?php

namespace App\Domains\AktaNotaris\Models;

use App\Models\BaseModel;
use App\Domains\AktaNotaris\Models\AktaNotaris;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaNotarisNote extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'covernote_document_id',
        'type',
        'note_date',
        'note',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote_note";
    }

    /** Relationship */
    public function covernoteDocument() {
        return $this->belongsTo(AktaNotarisDocument::class, 'id', 'covernote_document_id');
    }
}
