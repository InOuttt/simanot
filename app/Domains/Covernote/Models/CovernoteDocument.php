<?php

namespace App\Domains\Covernote\Models;

use App\Models\BaseModel;
use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteFollowup;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CovernoteDocument extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'covernote_id',
        'nama',
        'nomor',
        'status',
        'tanggal_terbit',
        'tanggal_terima',
        'jumlah_salinan',
        'tanggal_selesai',
        'tanda_terima_notaris',
        'tanda_terima_debitur',
        'created_by',
        'updated_by',
    ];
    
    public function getTable()
    {
        return "covernote_dokumen";
    }

    /** Relationship */
    public function covernote() {
        return $this->belongsTo(Covernote::class, 'covernote_id', 'id');
    }

    public function file_notaris() {
        return $this->hasOne(File::class, 'id', 'tanda_terima_notaris');
    }

    public function file_debitur() {
        return $this->hasOne(File::class, 'id', 'tanda_terima_debitur');
    }

    public function followup() {
        return $this->hasMany(CovernoteFollowup::class, 'covernote_dokumen_id', 'id');
    }
    
    /** label */
    public function getNotarisNameAttribute(): String
    {
       return collect($this->covernote()->pluck('notaris'))->implode('<br/>');
    }

    public function getFollowupLastHasilAttribute(): String
    {
    //    return $this->followup()->orderBy('id', 'DESC')->first()->hasil;
       $ret = $this->followup->last();
        return empty($ret) ? '-' : $ret->hasil;
    }

    public function getStatusLabelAttribute(): String
    {
        $label = 'Belum diterima';
        if($this->status == 1) $label = 'Diterima';
        if($this->status == 2) $label = 'Revisi';
       return $label;
    //    return $this->notaris_id;
    }

    public function getTenggatBulanAttribute(): String
    {
        $ret = "-";
        if(!empty($this->covernote->jatuh_tempo)) {
            
            $dateObj   = DateTime::createFromFormat('!m', date('F', strtotime($this->covernote->jatuh_tempo)));
            $ret = $dateObj->format('F'); // March
            $ret = date('F', strtotime($this->covernote->jatuh_tempo));
        }
        return $ret;
    }
    public function getTenggatTahunAttribute(): String
    {
        $ret = "-";
        if(!empty($this->covernote->jatuh_tempo)) {
            $ret = date('Y', strtotime($this->covernote->jatuh_tempo));
        }
        return $ret;
    }

    /** gathering custom data */
    public function getDueDocument($status ,$month, $year) {
        $query = CovernoteDocument::query()->with(['covernote', 'covernote.notaris']);

        $dt = date('Y-m-t', strtotime($year . "-" . $month . "-25"));
        $query = $query->whereHas('covernote', function($q) use ($dt){
            $q->where('jatuh_tempo', '<=', $dt);
        });

        if($status != null) {
            $query = $query->where('status', '=' ,$status);
        } else {
            $query = $query->whereIn('status', ['0', '2']);
        }

        return $query;
    }
}
