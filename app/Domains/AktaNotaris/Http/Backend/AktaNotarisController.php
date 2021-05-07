<?php

namespace App\Domains\AktaNotaris\Http\Backend\Controllers;

use App\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\AktaNotaris\Services\AktaNotarisService;
use App\Domains\AktaNotaris\Http\Requests\AktaNotarisRequest;
use App\Domains\AktaNotaris\Models\AktaNotaris;

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
        // dd($request->all());
        $this->service->store($request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function view(AktaNotaris $data)
    {
        return view('backend.auth_user.view')
            ->withData($data);
    }

    public function edit(BaseRequest $request, AktaNotaris $notaris)
    {
        return view($this->view_edit)->withData($notaris);
    }

    public function update(AktaNotarisRequest $request, AktaNotaris $notaris)
    {
        $this->service->update($notaris, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,AktaNotaris $notaris)
    {
        $this->service->destroy($notaris);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
