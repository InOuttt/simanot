<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends BaseModel
{

    use HasFactory;

    public $name;

    public static $filePath = [
      'laporan_grup_hukum' => 'storage/laporan-grup-hukum',
      'surat_tagihan_notaris' => 'storage/surat-tagihan-notaris',
      'tanda_terima_notaris' => 'storage/tanda-terima-notaris',
      'tanda_terima_debitur' => 'storage/tanda-terima-debitur'
    ];

    protected $fillable = [
        'path',
        'type',
    ];
    
    public function getTable()
    {
        return "file";
    }

    public function getNameFileAttribute() : String 
    {
        if(!empty($this->path)) {

            $name = substr($this->path, strrpos($this->path, '/'), strlen($this->path));
            $name = substr($name, strpos($name, '-') + 1, strlen($name));
            
            return $name;
        }
    }

}
