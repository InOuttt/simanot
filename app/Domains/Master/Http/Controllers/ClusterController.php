<?php

namespace App\Domains\Master\Http\Controllers;

use App\Domains\Covernote\Models\Covernote;
use App\Http\Controllers\Requests\BaseRequest;
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

    public function edit(BaseRequest $request, Cluster $cluster)
    {
        return view($this->view_edit)->withData($cluster);
    }

    public function update(ClusterRequest $request, Cluster $cluster)
    {
        $this->service->update($cluster, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('Data berhasil diedit.'));
    }

    public function destroy(BaseRequest $request,Cluster $cluster)
    {
        $covernote = Covernote::where('cluster_id', '=', $cluster->id)->first();
        if(!empty($covernote)) {
            return back()->withErrors('Cluster digunakan di salah satu covernote');
        }
        
        $this->service->destroy($cluster);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('Data berhasil dihapus.'));
    }


}
