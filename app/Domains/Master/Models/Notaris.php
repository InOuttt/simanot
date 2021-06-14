<?php

namespace App\Domains\Master\Models;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteDocument;
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
        return $this->hasMany(Covernote::class, 'notaris_id', 'id');
    }

    public function covernotesDocuments()
    {
        return $this->hasManyThrough(CovernoteDocument::class, Covernote::class);
    }

    
    public function documentsFinish() {
        return $this->covernotesDocuments()->where('covernote_dokumen.status', '=', '1');
    }

    public function documentsUnfinish() {
        return $this->covernotesDocuments()->where('covernote_dokumen.status', '=', '0');
    }

    public function documentsCorrection() {
        return $this->covernotesDocuments()->where('covernote_dokumen.status', '=', '2');
    }

    public function getPartnerNameAttribute(): String
    {
       return collect($this->partner()->pluck('nama'))->implode('<br/>');
    }

    /**  */
    public static function countNotarisCovernote($month = null, $year = null) {

        $dtStart = date('Y-1-1', strtotime($year . "-1-1"));
        $dtEnd = date('Y-12-t', strtotime($year . "-12-25"));

        if($month != null ) {
            $dtStart = date('Y-m-d', strtotime($year . "-" . $month . "-1"));
            $dtEnd = date('Y-m-t', strtotime($year . "-" . $month . "-25"));
        }



        $qry = Notaris::query()->with('covernotes');
        $qry = $qry
            // ->select()
            // ->sum('covernote_documents_count')
            ->withCount('documentsFinish')
            ->withCount('documentsUnfinish')
            ->withCount('documentsCorrection')
            ->withCount('covernotesDocuments')
            ->withCount('covernotes')
            // ->sum('documents_finish_count')
            ->whereHas('covernotes', function($q) use($dtStart, $dtEnd) {
                $q->whereBetween('jatuh_tempo', [$dtStart, $dtEnd]);
            })
            // ->distinct('notaris_id')
            ;

        return $qry;

    }

    public function countUnfinishCovernote($date) {
        $date = empty($date) ? date('Y-m-d') : $date;
        $date90 = carbon($date)->addDays(-90)->format('Y-m-d');
        $date180 = carbon($date)->addDays(-180)->format('Y-m-d');

        $qry = $this->query()->with('covernotes');
        $qry = $qry
            ->withCount([
            'covernotes', 
            'covernotes as covernote_under90' => function ($query) use ($date, $date90) {
                $query->where('status', '=', '0');
                $query->whereBetween('jatuh_tempo', [$date90, $date]);
            },
            'covernotes as covernote_between180' => function ($query) use ($date90, $date180) {
                $query->where('status', '=', '0');
                $query->whereBetween('jatuh_tempo', [$date180, $date90]);
            },
            'covernotes as covernote_more180' => function ($query) use ($date180) {
                $query->where('status', '=', '0');
                $query->where('jatuh_tempo', '<' , $date180);
            },
            ])
            ;

        return $qry;

    }
}
