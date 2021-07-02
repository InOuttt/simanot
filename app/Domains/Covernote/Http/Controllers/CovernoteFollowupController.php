<?php

namespace App\Domains\Covernote\Http\Controllers;

use App\Http\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Covernote\Http\Requests\CovernoteDocumentRequest;
use App\Domains\Covernote\Http\Requests\CovernoteFollowupRequest;
use App\Domains\Covernote\Models\CovernoteDocument;
use App\Domains\Covernote\Models\CovernoteFollowup;
use App\Domains\Covernote\Services\CovernoteFollowupService;

class CovernoteFollowupController extends BaseBackendController
{
    public function __construct(CovernoteFollowupService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.covernote_document.index';
        $this->route_view_index = 'covernote.document.index';
        $this->view_edit = 'backend.covernote_followup.edit';
        $this->view_create = 'backend.covernote_document.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(CovernoteFollowupRequest $request, CovernoteDocument $data)
    {
        $req = $request->all();
        $req['created_by'] = auth()->user()->id;
        // dd($req);
        $akta = $this->service->store($req);

        return redirect()->route('covernote.document.followup.edit', $data)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function edit(BaseRequest $request, CovernoteDocument $data)
    {
        $data = CovernoteDocument::with(['followUp'])->where('id', '=', $data->id)->first();
        // dd($data);
        return view($this->view_edit)
            ->withData($data);
    }

    public function update(CovernoteDocumentRequest $request, CovernoteDocument $data)
    {
        $this->service->update($data, $request->validated());

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,CovernoteDocument $data)
    {
        $this->service->destroy($data);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
