<?php

namespace App\Domains\Letter\Http\Controllers;

use App\Http\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Letter\Services\TagihanNotarisService;
use App\Domains\Letter\Http\Requests\TagihanNotarisRequest;
use App\Domains\Letter\Models\SuratTagihan;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;

class TagihanNotarisController extends BaseBackendController
{
    public function __construct(TagihanNotarisService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.letter.tagihan.index';
        $this->route_view_index = 'letter.tagihan.index';
        $this->view_edit = 'backend.letter.tagihan.edit';
        $this->view_create = 'backend.letter.tagihan.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(TagihanNotarisRequest $request)
    {
        $suratTagihan= $this->service->store($request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function create()
    {

        return view($this->view_create);
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

    public function update(TagihanNotarisRequest $request, Covernote $data)
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
