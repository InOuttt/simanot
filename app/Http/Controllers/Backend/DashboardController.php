<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteDocument;
use App\Domains\Covernote\Models\CovernoteFollowup;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 * show index notaris
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $followup = CovernoteFollowup::with(['covernote.notaris', 'covernoteDocument'])->orderByDesc('tanggal_followup')->limit('20')->get();
        return view('backend.dashboard')
            ->withFollowup($followup);
    }

    private function getColor($num, $text = 'color') {
        $hash = md5($text . $num); // modify 'color' to get a different palette
        return array(
            hexdec(substr($hash, 0, 2)), // r
            hexdec(substr($hash, 1, 2)), // g
            hexdec(substr($hash, 2, 2))); //b
    }
    /**
     * outstanding covernote per notarsi & per cluster
     */
    public function getOutstandingCovernote(Request $request)
    {
        $covernote = [];

        $covernoteNotaris = Covernote::where('jatuh_tempo', '<', date('Y-m-d'))
                                ->where('status', '!=', '1')
                                ->with('notaris')
                                ->selectRaw("count(*) as total, notaris_id")
                                ->orderByDesc('total')
                                ->groupBy('notaris_id')
                                ->limit('5')
                                ->get();
        if(!empty($covernoteNotaris)) {
            $temp = ['data'=> [], 'label' => [], 'color' => []];
            foreach($covernoteNotaris as $key => $val) {
                if(!empty($val['notaris']['nama'])) {
                    array_push($temp['data'], $val['total']);
                    array_push($temp['label'], $val['notaris']['nama']);
                    array_push($temp['color'], "rgb(".implode(',', $this->getColor($key)).')');
                }
            }
            $covernote['notaris'] = $temp;
        }
        
        $covernoteCluster = Covernote::where('jatuh_tempo', '<', date('Y-m-d'))
                                ->where('status', '!=', '1')
                                ->with('cluster')
                                ->selectRaw("count(*) as total, cluster_id")
                                ->orderByDesc('total')
                                ->groupBy('cluster_id')
                                ->limit('5')
                                ->get();
        if(!empty($covernoteCluster)) {
            $temp = ['data'=> [], 'label' => [], 'color' => []];
            foreach($covernoteCluster as $key => $val) {
                if(!empty($val['cluster']['nama'])) {
                    array_push($temp['data'], $val['total']);
                    array_push($temp['label'], $val['cluster']['nama']);
                    array_push($temp['color'], "rgb(".implode(',', $this->getColor($key. '4')).')');
                }
            }
            $covernote['cluster'] = $temp;
        }

        return response()->json($covernote);
    }

    /** 
     * penerimaan covernote per notaris & per cluster
     */
    public function getPenerimaanCovernote(Request $request)
    {
        $covernote = [];

        $covernoteNotaris = Covernote::where('jatuh_tempo', '<', date('Y-m-d'))
                                ->with('notaris')
                                ->selectRaw("count(*) as total, notaris_id")
                                ->orderByDesc('total')
                                ->groupBy('notaris_id')
                                ->limit('5')
                                ->get();
        if(!empty($covernoteNotaris)) {
            $temp = ['data'=> [], 'label' => [], 'color' => []];
            foreach($covernoteNotaris as $key => $val) {
                if(!empty($val['notaris']['nama'])) {
                    array_push($temp['data'], $val['total']);
                    array_push($temp['label'], $val['notaris']['nama']);
                    array_push($temp['color'], "rgb(".implode(',', $this->getColor($key)).')');
                }
            }
            $covernote['notaris'] = $temp;
        }
        
        $covernoteCluster = Covernote::where('jatuh_tempo', '<', date('Y-m-d'))
                                ->with('cluster')
                                ->selectRaw("count(*) as total, cluster_id")
                                ->orderByDesc('total')
                                ->groupBy('cluster_id')
                                ->limit('5')
                                ->get();
        if(!empty($covernoteCluster)) {
            $temp = ['data'=> [], 'label' => [], 'color' => []];
            foreach($covernoteCluster as $key => $val) {
                if(!empty($val['cluster']['nama'])) {
                    array_push($temp['data'], $val['total']);
                    array_push($temp['label'], $val['cluster']['nama']);
                    array_push($temp['color'], "rgb(".implode(',', $this->getColor($key. '4')).')');
                }
            }
            $covernote['cluster'] = $temp;
        }

        return response()->json($covernote);
    }

    /**
     * total dokumen covernote belum selesai, koreksi, selesai
     */
    public function getStatusDokumenCovernote(){
        $data = ['data'=> [], 'label' => [], 'color' => []];

        $covernoteDocument = CovernoteDocument::selectRaw("count(*) as total, status")
                                ->groupBy('status')
                                ->get();
        $tempTotal = 0;
        foreach($covernoteDocument as $key => $val) {
            $tempTotal += $val['total'];
            array_push($data['data'], $val['total']);
            array_push($data['color'], "rgb(".implode(',', $this->getColor($key)).')');
        }
        foreach($covernoteDocument as $key => $val) {
            array_push($data['label'], $val->statusLabel . ' ' . number_format((float)($val['total']* 100 / $tempTotal), 2, ',', '') .'%' );
        }
        $data['total'] = $tempTotal;
        return response()->json($data);
    }
}
