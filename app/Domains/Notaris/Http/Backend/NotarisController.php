<?php

namespace App\Domains\Notaris\Http\Backend\Controllers;

use App\Controllers\Requests\BaseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Notaris\Services\NotarisService;
use App\Domains\Notaris\Http\Requests\NotarisRequest;
use App\Domains\Notaris\Models\Notaris;

class NotarisController extends BaseBackendController
{
    public function __construct(NotarisService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.notaris.index';
        $this->route_view_index = 'notaris.index';
        $this->view_edit = 'backend.notaris.edit';
        $this->view_create = 'backend.notaris.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(NotarisRequest $request)
    {

        $this->service->store($request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function edit(BaseRequest $request, Notaris $notaris)
    {
        return view($this->view_edit)->withData($notaris);
    }

    public function update(NotarisRequest $request, Notaris $notaris)
    {
        $this->service->update($notaris, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,Notaris $notaris)
    {
        $this->service->destroy($notaris);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
