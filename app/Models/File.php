<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends BaseModel
{

    use HasFactory;

    public static $filePath = [
      'tanda_terima_notaris' => 'uploads/tanda-terima-notaris',
      'tanda_terima_debitur' => 'uploads/tanda-terima-debitur'
    ];

    protected $fillable = [
        'path',
        'type',
    ];
    
    public function getTable()
    {
        return "file";
    }

}
