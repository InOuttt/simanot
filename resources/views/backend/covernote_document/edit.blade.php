@inject('model', '\App\Domains\Master\Models\Notaris')

@extends('backend.layouts.app')

@section('title', __('Edit Data Dokumen Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Edit Data Dokumen Covernote')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('covernote.document.index')" :text="__('Batal')" />
        </x-slot>

        <x-slot name="body">
            <div >
                <div class="form-group row">
                    <label for="nama_notaris" class="col-md-2 col-form-label">Nama Notaris</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="name_notaris" class="form-control" value="{{ $oldData->covernote->notaris->nama }}" maxlength="100" />
                    </div>

                    <label for="nama_dokumen" class="col-md-2 col-form-label">Nama Dokumen</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="name_dokumen" class="form-control" value="{{ $oldData->nama }}" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="no_covernote" class="col-md-2 col-form-label">Nomor Covernote</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="no_covernote" class="form-control" value="{{ $oldData->covernote->no_covernote }}" maxlength="100" />
                    </div>
                    
                    <label for="nomor_dokumen_non" class="col-md-2 col-form-label">Nomor Dokumen</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="nomor_dokumen_non" class="form-control" value="{{ $oldData->nomor }}" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <!-- <div class="form-group row">

                </div> -->
                <div class="form-group row">
                    <label for="nama_debitur" class="col-md-2 col-form-label">Nama Debitur</label>
                    <div class="col-md-4">
                        <input disabled type="string" name="nama_debitur" class="form-control" value="{{ $oldData->covernote->nama_debitur }}" maxlength="100" />
                    </div>
                    
                </div>
            </div>
        </x-slot>
    </x-backend.card>
    <x-forms.patch :action="route('covernote.document.update', $oldData)">
        <x-backend.card>
            <x-slot name="body">
                <div class="form-group row">
                    <label for="status_dokumen" class="col-md-2 col-form-label">Status Dokumen</label>
                    <div class="col-md-4">
                        <select name="status_dokumen" class="form-control">
                            <option value="0" {{$oldData->status == 0 ? 'selected' : ''}}>Belum Diterima</option>
                            <option value="1" {{$oldData->status == 1 ? 'selected' : ''}}>Diterima</option>
                            <option value="2" {{$oldData->status == 2 ? 'selected' : ''}}>Koreksi</option>
                        </select>
                    </div>

                    <label for="jumlah_salinan" class="col-md-2 col-form-label">Jumlah Salinan</label>
                    <div class="col-md-4">
                        <input type="number" name="jumlah_salinan" class="form-control" placeholder="contoh: 5" value="{{ $oldData->jumlah_salinan }}" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="nomor_dokumen" class="col-md-2 col-form-label">Nomor Dokumen</label>
                    <div class="col-md-4">
                        <input type="text" name="nomor_dokumen" class="form-control" value="{{ $oldData->nomor }}" placeholder="6487/asdoi" maxlength="100" />
                    </div>
                    
                    <label for="tanggal_terbit" class="col-md-2 col-form-label">Tanggal Terbit</label>
                    <div class="col-md-4">
                        <input type="date" name="tanggal_terbit" class="form-control" value="{{ $oldData->tanggal_terbit }}" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="tanggal_terima" class="col-md-2 col-form-label">Tanggal Terima</label>
                    <div class="col-md-4">
                        <input type="date" name="tanggal_terima" class="form-control" value="{{ $oldData->tanggal_terima }}" placeholder="dd-mm-yyyy" maxlength="100" />
                    </div>
                    
                    <label for="tanggal_selesai" class="col-md-2 col-form-label">Tanggal Selesai Proofread</label>
                    <div class="col-md-4">
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ $oldData->tanggal_selesai }}" placeholder="dd-mm-yyyy" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="tanda_terima_notaris" class="col-md-2 col-form-label">Tanda Terima Notaris</label>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" onClick="document.getElementById('uploadTandaNotaris').click();">Unggah</button> 
                        <label id="tandaNotarisLabel"></label>
                        <input type="file" name="tanda_terima_notaris" id="uploadTandaNotaris" style="display:none" class="form-control"  />
                        <!-- <input type="file" name="tanda_terima_notaris" id="uploadTandaNotaris" class="form-control" value="{{ $oldData->tanda_terima_notaris }}" maxlength="100" /> -->
                        </br>
                        @if(!empty($oldData->file_notaris))
                        <label>File sekarang : <span id="old-tanda-notaris">{{$oldData->file_notaris->nameFile}}</span></label> <a href="{{'/'. $oldData->file_notaris->path}}" class="btn btn-secondary"> Unduh</a> 
                        @endif
                    </div>
                    
                    <label for="tanda_terima_debitur" class="col-md-2 col-form-label">Tanda Terima Debitur</label>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" onClick="document.getElementById('uploadTandaDebitur').click();">Unggah</button> 
                        <label id="tandaDebiturLabel"></label>
                        <input type="file" name="tanda_terima_debitur" id="uploadTandaDebitur" style="display:none" class="form-control" />

                        <!-- <input type="file" name="tanda_terima_debitur" class="form-control" value="{{ $oldData->tanda_terima_debitur }}" maxlength="100" /> -->
                        </br>
                        @if(!empty($oldData->file_debitur))
                        <label>File sekarang : <span id="old-tanda-debitur">{{$oldData->file_debitur->nameFile}}</span></label> <a href="{{'/'. $oldData->file_debitur->path}}" class="btn btn-secondary"> Unduh</a> 
                        @endif
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Save')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection


@push('scripts')

<script>
document.getElementById('uploadTandaNotaris').addEventListener('change', function(){
    var file = this.files[0];
    document.getElementById('tandaNotarisLabel').innerHTML = file.name;
}, false);
document.getElementById('uploadTandaDebitur').addEventListener('change', function(){
    var file = this.files[0];
    document.getElementById('tandaDebiturLabel').innerHTML = file.name;
}, false);

</script>

@endpush