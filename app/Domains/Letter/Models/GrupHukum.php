<?php

namespace App\Domains\Letter\Models;

use App\Domains\Master\Models\Cluster;
use App\Models\BaseModel;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupHukum extends BaseModel
{

    use HasFactory;

    protected $fillable = [
       'cluster_id',
       'bulan',
       'tahun',
       'tanggal_email',
       'file_id'
    ];
    
    public function getTable()
    {
        return "grup_hukum";
    }

    /** Relationship */
    public function cluster() {
        return $this->hasOne(Cluster::class, 'id', 'cluster_id');
    }

    public function file() {
        return $this->hasOne(File::class, 'id', 'file_id');
    }


    /** Gathering Data */

}
