<?php

namespace App\Domains\Letter\Models;

use App\Models\BaseModel;
use App\Domains\Master\Models\Notaris;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratTagihan extends BaseModel
{

    use HasFactory;

    protected $fillable = [
       'notaris_id',
       'bulan',
       'tahun',
       'tanggal_email',
       'file_id'
    ];
    
    public function getTable()
    {
        return "surat_tagihan";
    }

    /** Relationship */
    public function notaris() {
        return $this->hasOne(Notaris::class, 'id', 'notaris_id');
    }

    public function file() {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

}
