<?php

namespace App\Domains\AktaNotaris\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaNotaris extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'id_notaris',
        'name',
        'no_covernote',
        'tanggal_covernote',
        'durasi',
        'jatuh_tempo',
        'os',
        'is_perpanjangan',
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
}
