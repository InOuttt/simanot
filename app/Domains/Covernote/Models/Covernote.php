<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Master\Models\Notaris;
use App\Domains\Covernote\Models\CovernoteNote;
use App\Domains\Letter\Models\GrupHukum;
use App\Domains\Letter\Models\SuratTagihan;
use App\Domains\Master\Models\Cluster;
use Carbon\Carbon;
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

    public function documentsFinish() {
        return $this->covernoteDocuments()->where('status', '=', '1');
    }

    public function documentsUnfinish() {
        return $this->covernoteDocuments()->where('status', '!=', '1');
    }

    public function tagihanNotaris() {
        $bulan = Carbon::parse($this->jatuh_tempo)->format('m');
        $tahun = Carbon::parse($this->jatuh_tempo)->format('Y');
        return $this->hasOne(SuratTagihan::class, 'notaris_id', 'notaris_id')->where('bulan', '=', $bulan)->where('tahun', '=', $tahun);
    }

    public function grupHukum() {
        $bulan = Carbon::parse($this->jatuh_tempo)->format('m');
        $tahun = Carbon::parse($this->jatuh_tempo)->format('Y');
        return $this->hasOne(GrupHukum::class, 'cluster_id', 'cluster_id')->where('bulan', '=', $bulan)->where('tahun', '=', $tahun);
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

    public function getStatusGrupHukumLabelAttribute(): String
    {
       return empty($this->grupHukum) ? 'Belum Selesai' : 'Selesai';
    }

    public function getStatusTagihanNotarisLabelAttribute(): String
    {
       return empty($this->tagihanNotaris) ? 'Belum Selesai' : 'Selesai';
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
        $dtFrom = date('Y-m-d', strtotime($year . "-" . $month . "-1"));

        $query = $query->where('status', '=' , (string)$status)
                    ->where('jatuh_tempo', '>=', $dtFrom)
                    ->where('jatuh_tempo', '<=', $dt);


        return $query;
    }

}
