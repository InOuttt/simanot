<?php

namespace App\Domains\Covernote\Http\Controllers;

use App\Http\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Covernote\Services\CovernoteService;
use App\Domains\Covernote\Http\Requests\CovernoteRequest;
use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteDocument;
use App\Domains\Covernote\Models\CovernoteNote;
use App\Domains\Covernote\Services\CovernoteNoteService;
use App\Domains\Master\Models\Cluster;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;

class CovernoteController extends BaseBackendController
{
    public function __construct(CovernoteService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.covernote.index';
        $this->route_view_index = 'covernote.index';
        $this->view_edit = 'backend.covernote.edit';
        $this->view_create = 'backend.covernote.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(CovernoteRequest $request)
    {
        $covernote= $this->service->store($request->validated());

        if(!empty($covernote->id)) {
            foreach ($request->dokumen as $key => $value) {
                CovernoteDocument::create([
                    'covernote_id' => $covernote->id,
                    'nama' => $value['nama'],
                    'nomor' => $value['nomor'],
                    'tanggal_terbit' => $value['tanggal'],
                    'created_by' => $covernote->created_by
                ]);
            }
        }

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function create()
    {
        $clusters = Cluster::all();

        return view($this->view_create)
            ->withClusters($clusters);
    }

    public function view(Covernote $data)
    {

        return view('covernote.detail')
            ->withData($data)
            ->withClusters($cluster);
    }

    public function upgradeIndex(HttpRequest $request = null)
    {
        $aktas = [];
        if(!empty($request)) {
            dd($request);
        }
        
        return view('backend.covernote.update')
            ->withAktas($aktas);
    }

    public function find(Request $request)
    {
        $aktas = [];
        if(!empty($request)) {
            $aktas = Covernote::where('id_notaris', '=', $request->id_notaris);
            if(!empty($request->nama_debitur)) {
                $aktas = $aktas->where('nama_debitur', '=', $request->nama_debitur);
            }

            $aktas = $aktas->get();
        }
        
        return view('backend.covernote.update')
            ->withAktas($aktas);
    }

    public function edit(BaseRequest $request, Covernote $data)
    {
        // $covernote = Covernote::where('id', '=', $data)->get();
        $clusters = Cluster::all();

        // dd($data);
        return view($this->view_edit)
            ->withOldData($data)
            ->withClusters($clusters);
    }

    public function update(CovernoteRequest $request, Covernote $data)
    {
        $this->service->update($data, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,Covernote $data)
    {
        $this->service->destroy($data);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
