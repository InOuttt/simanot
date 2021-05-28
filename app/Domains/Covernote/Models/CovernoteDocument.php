<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteFollowup;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CovernoteDocument extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'covernote_id',
        'nama',
        'nomor',
        'status',
        'tanggal_terbit',
        'tanggal_terima',
        'jumlah_salinan',
        'tanggal_selesai',
        'tanda_terima_notaris',
        'tanda_terima_debitur',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote_dokumen";
    }

    /** Relationship */
    public function covernote() {
        return $this->belongsTo(Covernote::class, 'covernote_id', 'id');
    }

    public function followup() {
        return $this->hasMany(CovernoteFollowup::class, 'covernote_dokumen_id', 'id');
    }
}
