<?php

namespace App\Domains\AktaNotaris\Models;

use App\Models\BaseModel;
use App\Domains\Master\Models\Notaris;
use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktaNotaris extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'notaris_id',
        'no_covernote',
        'date_covernote',
        'duration',
        'due_date',
        'os',
        'is_certificate_renewal',
        'cluster',
        'debtor_name',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote";
    }

    /** Relationship */
    public function notaris() {
        return $this->hasOne(Notaris::class, 'id', 'notaris_id');
    }

    public function covernoteDocuments() {
        return $this->hasMany(AktaNotarisDocument::class, 'covernote_id', 'id');
    }

    public function getNotarisNameAttribute(): String
    {
       return collect($this->notaris()->pluck('name'))->implode('<br/>');
    }

}
