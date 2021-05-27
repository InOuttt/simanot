<?php

namespace App\Domains\Covernote\Http\Controllers;

use App\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Covernote\Http\Requests\CovernoteFollowupRequest;
use App\Domains\Covernote\Models\CovernoteFollowup;
use App\Domains\Covernote\Services\CovernoteFollowupService;

class CovernoteFollowupController extends BaseBackendController
{
    public function __construct(CovernoteFollowupService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.covernote_followup.index';
        $this->route_view_index = 'covernote_document.index';
        $this->view_edit = 'backend.covernote_followup.edit';
        $this->view_create = 'backend.covernote_followup.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(CovernoteFollowupRequest $request)
    {
        $akta = $this->service->store($request->validated());
        // $dt = new Date();
        // foreach ($request->akta_note as $key => $value) {
        //     CovernoteFollowupNote::create([
        //         'note' => $request->akta_note[$key],
        //         'id_akta_hutang' => $akta->id,
        //         'tanggal_note' => $dt,
        //     ]);
        // }

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function view(CovernoteFollowup $data)
    {
        return view('backend.auth_user.view')
            ->withData($data);
    }

    public function edit(BaseRequest $request, CovernoteFollowup $data)
    {
        $akta = CovernoteFollowup::where('id', '=', $data)->get();
        // dd($data);
        return view($this->view_edit)
            ->withData($data)
            ->withAkta($akta);
    }

    public function update(CovernoteFollowupRequest $request, CovernoteFollowup $data)
    {
        $this->service->update($data, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,CovernoteFollowup $data)
    {
        $this->service->destroy($data);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
