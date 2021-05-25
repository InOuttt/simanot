<?php

namespace App\Domains\AktaNotaris\Models;

use App\Models\BaseModel;
use App\Domains\AktaNotaris\Models\AktaNotaris;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaNotarisDocument extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'covernote_id',
        'document_name',
        'document_time_number',
        'document_status',
        'document_receipt_date',
        'number_copies',
        'finish_date',
        'copies_sent_date',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote_document";
    }

    /** Relationship */
    public function covernote() {
        return $this->belongsTo(AktaNotaris::class, 'id', 'covernote_id');
    }

    public function notes() {
        return $this->hasMany(AktaNotarisNote::class, 'covernote_document_id', 'id');
    }
}
