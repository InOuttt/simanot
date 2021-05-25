<?php

namespace App\Domains\Master\Models;

use App\Domains\AktaNotaris\Models\AktaNotaris;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notaris extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'nama',
        'partner_id',
        'alamat',
        'domisili'
    ];
    
    public function getTable()
    {
        return "notaris";
    }

    public static function getById($id)
    {
        return Notaris::where('id', '=', $id)->first();
    }
 
    public function partner()
    {
        return $this->hasOne(Notaris::class, 'id', 'partner_id');
    }

    public function covernotes()
    {
        return $this->hasMany(AktaNotaris::class, 'notaris_id', 'id');
    }

    public function getPartnerNameAttribute(): String
    {
       return collect($this->partner()->pluck('nama'))->implode('<br/>');
    }
}
