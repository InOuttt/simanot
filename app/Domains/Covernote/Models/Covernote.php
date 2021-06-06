<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Master\Models\Notaris;
use App\Domains\Covernote\Models\CovernoteNote;
use App\Domains\Master\Models\Cluster;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Covernote extends BaseModel
{

    use HasFactory;

    protected $casts = [
        'status' => 'string',
    ];

    protected $fillable = [
        'notaris_id',
        'cluster_id',
        'no_covernote',
        'tanggal_covernote',
        'durasi',
        'jatuh_tempo',
        'os',
        'is_perpanjangan_sertifikat',
        'nama_debitur',
        'status',
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

    public function cluster() {
        return $this->hasOne(Cluster::class, 'id', 'cluster_id');
    }

    public function covernoteDocuments() {
        return $this->hasMany(CovernoteDocument::class, 'covernote_id', 'id');
    }

    public function getNotarisNameAttribute(): String
    {
       return collect($this->notaris()->pluck('nama'))->implode('<br/>');
    }

    public function getStatusLabelAttribute(): String
    {
       return $this->status == 0 ? 'Belum Selesai' : 'Selesai';
    //    return $this->notaris_id;
    }

    public function getTenggatBulanAttribute(): String
    {
        $ret = "-";
        if(!empty($this->jatuh_tempo)) {
            $ret = date('F', strtotime($this->jatuh_tempo));
        }
        return __($ret);
    }

    public function getTenggatBulanNumberAttribute(): String
    {
        $ret = "-";
        if(!empty($this->jatuh_tempo)) {
            // $dateObj   = DateTime::createFromFormat('!m', date('F', strtotime($this->jatuh_tempo)));
            // $ret = $dateObj->format('F'); // March
            $ret = date('m', strtotime($this->jatuh_tempo));
            // $ret = date('m', strtotime($this->jatuh_tempo));
        }
        return $ret;
    }
    public function getTenggatTahunAttribute(): String
    {
        $ret = "-";
        if(!empty($this->jatuh_tempo)) {
            $ret = date('Y', strtotime($this->jatuh_tempo));
        }
        return $ret;
    }


    
    /** gathering custom data */
    public function getDueDocument($status ,$month, $year) {
        $query = Covernote::query()->with(['notaris']);

        $dt = date('Y-m-t', strtotime($year . "-" . $month . "-25"));
        // $dtFrom = date('Y-m-t', strtotime($year . "-" . $month - 1 . "-25"));

        $query = $query->where('status', '=' , (string)$status)
                    // ->where('jatuh_tempo', '>', $dtFrom)
                    ->where('jatuh_tempo', '<=', $dt);

        return $query;
    }

}
