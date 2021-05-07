<?php

namespace App\Domains\AktaNotaris\Models;

use App\Models\BaseModel;
use App\Domains\AktaNotaris\Models\AktaNotaris;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaNotarisNote extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'id_akta_hutang',
        'tanggal_note',
        'note',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    
    public function getTable()
    {
        return "akta_hutang_note";
    }

    /** Relationship */
    public function aktaHutang() {
        return $this->belongsTo(AktaNotaris::class, 'id', 'id_akta_hutang');
    }
}
