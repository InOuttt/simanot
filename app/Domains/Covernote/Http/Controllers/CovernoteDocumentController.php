<?php

namespace App\Domains\Covernote\Http\Controllers;

use App\Http\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Backend\BaseBackendController;
use App\Domains\Covernote\Http\Requests\CovernoteDocumentRequest;
use App\Domains\Covernote\Models\CovernoteDocument;
use App\Domains\Covernote\Services\CovernoteDocumentService;
use App\Models\File;

class CovernoteDocumentController extends BaseBackendController
{
    public function __construct(CovernoteDocumentService $service)
    {
        $this->service = $service;
        $this->view_index = 'backend.covernote_document.index';
        $this->route_view_index = 'covernote.document.index';
        $this->view_edit = 'backend.covernote_document.edit';
        $this->view_create = 'backend.covernote_document.create';
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(CovernoteDocumentRequest $request)
    {
        $akta = $this->service->store($request->validated());
        // $dt = new Date();
        // foreach ($request->akta_note as $key => $value) {
        //     CovernoteDocumentNote::create([
        //         'note' => $request->akta_note[$key],
        //         'id_akta_hutang' => $akta->id,
        //         'tanggal_note' => $dt,
        //     ]);
        // }

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully created.'));
    }

    public function view(CovernoteDocument $data)
    {
        return view('backend.auth_user.view')
            ->withData($data);
    }

    public function find(BaseRequest $request)
    {
        $aktas = CovernoteDocument::with('covernote');
        if(!empty($request)) {
            if(!empty($request->input('nama_notaris'))) {
                $aktas = $aktas->whereHas('covernote.notaris', function($q) use ($request){
                    $q->where('nama', '=', $request->input('nama_notaris'));
                });
            }
            if(!empty($request->input('nama_debitur'))) {
                $aktas = $aktas->whereHas('covernote', function($q) use ($request){
                    $q->where('nama_debitur', '=', $request->input('nama_debitur'));
                });
            }

        }
        $aktas = $aktas->get();
        
        return view($this->view_index)
            ->withDocuments($aktas);
    }

    public function edit(BaseRequest $request, CovernoteDocument $data)
    {
        $akta = CovernoteDocument::where('id', '=', $data)->get();
        // dd($data);
        return view($this->view_edit)
            ->witholdData($data)
            ->withAkta($akta);
    }

    public function update(CovernoteDocumentRequest $request, CovernoteDocument $data)
    {
        $update = $request->all();
        if($request->hasFile('tanda_terima_notaris')) {
            try {

                $file = $request->file('tanda_terima_notaris');
                $uploaded = File::create([
                    'path' => File::$filePath['tanda_terima_notaris'] . '/' .$data->id.'-'.$file->getClientOriginalName(),
                    'type' => $file->getClientOriginalExtension()
                ]);

                if(!empty($uploaded) && !empty($uploaded->id)) {
                    $file->move(File::$filePath['tanda_terima_notaris'], $data->id.'-'.$file->getClientOriginalName());
                    $update['tanda_terima_notaris'] = $uploaded->id;
                }

            } catch (\Throwable $th) {
                return back()->withErrors('Gagal upload file Tanda Terima Notaris');
            }
        }

        if($request->hasFile('tanda_terima_debitur')) {
            try {

                $file = $request->file('tanda_terima_debitur');
                $uploaded = File::create([
                    'path' => File::$filePath['tanda_terima_debitur'],
                    'type' => $file->getClientOriginalExtension()
                ]);

                if(!empty($uploaded) && !empty($uploaded->id)) {
                    $file->move(File::$filePath['tanda_terima_debitur'], $data->id.'-'.$file->getClientOriginalName());
                    $update['tanda_terima_debitur'] = $uploaded->id;
                }

            } catch (\Throwable $th) {
                return back()->withErrors('Gagal upload file Tanda Terima Debitur');
            }
        }

        $this->service->update($data, $update);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully updated.'));
    }

    public function destroy(BaseRequest $request,CovernoteDocument $data)
    {
        $this->service->destroy($data);

        return redirect()->route($this->route_view_index)->withFlashSuccess(__('The Data was successfully deleted.'));
    }


}
