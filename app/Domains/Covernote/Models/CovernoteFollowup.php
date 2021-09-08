<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Covernote\Models\Covernote;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CovernoteFollowup extends BaseModel
{

    use HasFactory;

    public static $TIPE_FOLLOWUP = [
        'SURAT' => 'surat',
        'TELP' => 'telp',
        'EMAIL' => 'email'
    ];

    protected $fillable = [
        'covernote_dokumen_id',
        'type',
        'tanggal_followup',
        'hasil',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote_followup";
    }

    /** Relationship */
    public function covernoteDocument() {
        return $this->belongsTo(CovernoteDocument::class, 'covernote_dokumen_id', 'id');
    }
    public function covernote() {
        return $this->hasOneThrough(Covernote::class, CovernoteDocument::class, 'id', 'id', 'covernote_dokumen_id', 'covernote_id');
    }

    public function getTanggalLabelAttribute(): String
    {
        if(!empty($this->tanggal_followup)) {
            return date('d/m/Y', strtotime($this->tanggal_followup));
        }

        return '';
    }

}
