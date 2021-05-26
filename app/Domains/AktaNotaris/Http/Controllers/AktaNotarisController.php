<?php

namespace App\Domains\AktaNotaris\Http\Controllers;

use App\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\AktaNotaris\Services\AktaNotarisService;
use App\Domains\AktaNotaris\Http\Requests\AktaNotarisRequest;
use App\Domains\AktaNotaris\Models\AktaNotaris;
use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use App\Domains\AktaNotaris\Services\AktaNotarisNoteService;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;

class AktaNotarisController extends BaseBackendController
{
    public function __construct(AktaNotarisService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.akta_notaris.index';
        $this->route_view_index = 'akta.notaris.index';
        $this->view_edit = 'backend.akta_notaris.edit';
        $this->view_create = 'backend.akta_notaris.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(AktaNotarisRequest $request)
    {
        $akta = $this->service->store($request->validated());
        // $dt = new Date();
        // foreach ($request->akta_note as $key => $value) {
        //     AktaNotarisNote::create([
        //         'note' => $request->akta_note[$key],
        //         'id_akta_hutang' => $akta->id,
        //         'tanggal_note' => $dt,
        //     ]);
        // }

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function view(AktaNotaris $data)
    {
        return view('backend.auth_user.view')
            ->withData($data);
    }

    public function upgradeIndex(HttpRequest $request = null)
    {
        $aktas = [];
        if(!empty($request)) {
            dd($request);
        }
        
        return view('backend.akta_notaris.update')
            ->withAktas($aktas);
    }

    public function find(Request $request)
    {
        $aktas = [];
        if(!empty($request)) {
            $aktas = AktaNotaris::where('id_notaris', '=', $request->id_notaris);
            if(!empty($request->nama_debitur)) {
                $aktas = $aktas->where('nama_debitur', '=', $request->nama_debitur);
            }

            $aktas = $aktas->get();
        }
        
        return view('backend.akta_notaris.update')
            ->withAktas($aktas);
    }

    public function edit(BaseRequest $request, AktaNotaris $data)
    {
        $akta = AktaNotaris::where('id', '=', $data)->get();
        // dd($data);
        return view($this->view_edit)
            ->withData($data)
            ->withAkta($akta);
    }

    public function update(AktaNotarisRequest $request, AktaNotaris $data)
    {
        $this->service->update($data, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,AktaNotaris $data)
    {
        $this->service->destroy($data);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
