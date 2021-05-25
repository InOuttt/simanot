<?php

namespace App\Domains\Master\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cluster extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'nama',
        'formula',
    ];
    
    public function getTable()
    {
        return "cluster";
    }

    public static function getById($id)
    {
        return Cluster::where('id', '=', $id)->first();
    }

    public static function determineCluster($data) {
      $clusters = Cluster::all();
      $first = substr($data, 0, 1);
      foreach($clusters as $key => $val) {
          if(preg_match('/'.$val.'/i', $first)) {
              echo $val;
              }
      }
    }
}
