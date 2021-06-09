<?php

namespace App\Domains\Master\Http\Controllers;

use App\Http\Controllers\Requests\BaseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Master\Services\NotarisService;
use App\Domains\Master\Http\Requests\NotarisRequest;
use App\Domains\Master\Models\Notaris;

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
        if($request->partner_id == $notaris->id) {
            return back()->withErrors('Notaris dan partner tidak boleh sama');
        }
        $this->service->update($notaris, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,Notaris $notaris)
    {
        $partnerId = Notaris::where('partner_id', '=', $notaris->id)->first();
        if(!empty($partnerId)) {
            return back()->withErrors('Notaris digunakan sebagai partner');
        }
        $this->service->destroy($notaris);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
