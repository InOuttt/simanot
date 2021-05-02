<?php

namespace App\Domains\Notaris\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notaris extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'name',
        'couple_name',
        'address',
        'domicile'
    ];
    
    public function getTable()
    {
        return "notaris";
    }
}
