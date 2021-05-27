<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Master\Models\Notaris;
use App\Domains\Covernote\Models\CovernoteNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Covernote extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'notaris_id',
        'cluster_id',
        'no_covernote',
        'tanggal_covernote',
        'durasi',
        'jatuh_tempo',
        'os',
        'is_perpanjangan_sertifikat',
        'nama_debitur',
        'status',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote";
    }

    /** Relationship */
    public function notaris() {
        return $this->hasOne(Notaris::class, 'id', 'notaris_id');
    }

    public function covernoteDocuments() {
        return $this->hasMany(CovernoteDocument::class, 'covernote_id', 'id');
    }

    public function getNotarisNameAttribute(): String
    {
       return collect($this->notaris()->pluck('nama'))->implode('<br/>');
    }

    public function getStatusLabelAttribute(): String
    {
       return $this->status == 0 ? 'Belum Selesai' : 'Selesai';
    //    return $this->notaris_id;
    }

}
