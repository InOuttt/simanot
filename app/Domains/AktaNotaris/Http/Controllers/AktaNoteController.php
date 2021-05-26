<?php

namespace App\Domains\AktaNotaris\Http\Controllers;

use App\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\AktaNotaris\Http\Requests\AktaNoteRequest;
use App\Domains\AktaNotaris\Models\AktaNotaris;
use App\Domains\AktaNotaris\Models\AktaNotarisNote;
use App\Domains\AktaNotaris\Services\AktaNoteService;

class AktaNoteController extends BaseBackendController
{
    public function __construct(AktaNoteService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.akta_notaris_note.index';
        $this->route_view_index = 'akta.note.index';
        $this->view_edit = 'backend.akta_notaris_note.edit';
        $this->view_create = 'backend.akta_notaris_note.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(AktaNoteRequest $request)
    {
        $akta = $this->service->store($request->validated());
        // $dt = new Date();
        // foreach ($request->akta_note as $key => $value) {
        //     AktaNoteNote::create([
        //         'note' => $request->akta_note[$key],
        //         'id_akta_hutang' => $akta->id,
        //         'tanggal_note' => $dt,
        //     ]);
        // }

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function view(AktaNote $data)
    {
        return view('backend.auth_user.view')
            ->withData($data);
    }

    public function edit(BaseRequest $request, AktaNote $data)
    {
        $akta = AktaNote::where('id', '=', $data)->get();
        // dd($data);
        return view($this->view_edit)
            ->withData($data)
            ->withAkta($akta);
    }

    public function update(AktaNoteRequest $request, AktaNote $data)
    {
        $this->service->update($data, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,AktaNote $data)
    {
        $this->service->destroy($data);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
