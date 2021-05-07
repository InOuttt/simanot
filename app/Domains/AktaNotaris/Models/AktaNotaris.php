<?php

namespace App\Domains\AktaNotaris\Models;

use App\Models\BaseModel;
use App\Domains\Notaris\Models\Notaris;
use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaNotaris extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'id_notaris',
        'no_covernote',
        'tanggal_covernote',
        'durasi',
        'jatuh_tempo',
        'os',
        'is_perpanjangan_sertifikat',
        'cluster',
        'nama_debitur',
        'nama_dokumen',
        'nomor_tanggal_dokumen',
        'status_dokumen',
        'tanggal_terima_dokumen',
        'jumlah_salinan',
        'tanggal_selesai',
        'tanggal_kirim_salinan',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    
    public function getTable()
    {
        return "akta_hutang";
    }

    /** Relationship */
    public function notaris() {
        return $this->hasOne(Notaris::class, 'id', 'id_notaris');
    }
    public function notes() {
        return $this->hasMany(AktaNotarisNote::class, 'id_akta_hutang', 'id');
    }

    public function getNotarisNameAttribute(): String
    {
       return collect($this->notaris()->pluck('name'))->implode('<br/>');
    }

}
