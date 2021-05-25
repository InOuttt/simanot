<?php

namespace App\Domains\Master\Http\Backend\Controllers;

use App\Controllers\Requests\BaseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Master\Services\ClusterService;
use App\Domains\Master\Http\Requests\ClusterRequest;
use App\Domains\Master\Models\Cluster;

class ClusterController extends BaseBackendController
{
    public function __construct(ClusterService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.cluster.index';
        $this->route_view_index = 'cluster.index';
        $this->view_edit = 'backend.cluster.edit';
        $this->view_create = 'backend.cluster.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(ClusterRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('Data berhasil dibuat.'));
    }

    public function edit(BaseRequest $request, Cluster $notaris)
    {
        return view($this->view_edit)->withData($notaris);
    }

    public function update(ClusterRequest $request, Cluster $notaris)
    {
        $this->service->update($notaris, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('Data berhasil diedit.'));
    }

    public function destroy(BaseRequest $request,Cluster $notaris)
    {
        $this->service->destroy($notaris);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('Data berhasil dihapus.'));
    }


}
