<?php

namespace App\Domains\Letter\Models;

use App\Models\BaseModel;
use App\Domains\Master\Models\Notaris;
use App\Domains\Covernote\Models\CovernoteDocument;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratTagihan extends BaseModel
{

    use HasFactory;

    public static $listBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'Novermber',
        12 => 'Desember',
      ];
      
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
        // return $this->belongsTo(Notaris::class, 'notaris_id', 'id');
    }

    public function file() {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    /** attributes */
    public function getfileDownloadPathButtonAttribute() : String
    {
        $ret = "-";
        if(!empty($this->file->path)) {
            $ret = "<a href='/".$this->file->path."' class='btn btn-success' target='__blank()'> Unduh </a>";
        }
        return $ret;
    }

    /** Gathering Data */

}
