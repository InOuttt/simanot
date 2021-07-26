@inject('model', '\App\Domains\Covernote\Models\CovernoteFollowup')

@extends('backend.layouts.app')

@section('title', __('Edit Data Dokumen Follow Up Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Edit Data Dokumen Follow Up Covernote')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('covernote.document.index')" :text="__('Batal')" />
        </x-slot>

        <x-slot name="body">
            <div >
                <div class="form-group row">
                    <label for="nama_notaris" class="col-md-2 col-form-label">Nama Notaris</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="name_notaris" class="form-control" value="{{ $data->covernote->notaris->nama }}" maxlength="100" />
                    </div>

                    <label for="nama_dokumen" class="col-md-2 col-form-label">Nama Dokumen</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="name_dokumen" class="form-control" value="{{ $data->nama }}" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="no_covernote" class="col-md-2 col-form-label">Nomor Covernote</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="no_covernote" class="form-control" value="{{ $data->covernote->no_covernote }}" maxlength="100" />
                    </div>
                    
                    <label for="nomor_dokumen_non" class="col-md-2 col-form-label">Nomor Dokumen</label>
                    <div class="col-md-4">
                        <input disabled type="text" name="nomor_dokumen_non" class="form-control" value="{{ $data->nomor }}" maxlength="100" />
                    </div>
                </div><!--form-group-->

                <!-- <div class="form-group row">

                </div> -->
                <div class="form-group row">
                    <label for="nama_debitur" class="col-md-2 col-form-label">Nama Debitur</label>
                    <div class="col-md-4">
                        <input disabled type="string" name="nama_debitur" class="form-control" value="{{ $data->covernote->nama_debitur }}" maxlength="100" />
                    </div>
                    
                </div>
            </div>
        </x-slot>
    </x-backend.card>
    <x-forms.patch :action="route('covernote.document.followup.store', $data)">
      <input type="text" value="{{$data->id}}" name="covernote_dokumen_id" class="form-control"  hidden/>
        <x-backend.card>
            <x-slot name="body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="type" class="col-md-3 col-form-label">Tipe Follow Up</label>
                      <div class="col-md-8">
                          <select name="type" class="form-control">
                            @foreach($model::$TIPE_FOLLOWUP as $key => $val)
                              <option value={{$val}} >{{$key}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div> 

                    <div class="form-group row">
                      <label for="tanggal_followup" class="col-md-3 col-form-label">Tanggal Followup</label>
                      <div class="col-md-8">
                        <!-- <input type="date" name="tanggal_followup" class="form-control" placeholder="dd-mm-yyyy" maxlength="100" min='{{date('Y-m-d')}}'/> -->
                        <input type="date" name="tanggal_followup" class="form-control" placeholder="dd-mm-yyyy" maxlength="100"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="hasil" class="col-md-3 col-form-label">Follow Up</label>
                      <div class="col-md-8">
                        <textarea name="hasil" class="form-control"  ></textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-11">
                        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Simpan')</button>
                      </div>
                    </div>


                  </div>
                  <div class="col-md-6 overflow-auto" style="height: 300px;">
                      <caption>Hasil Follow Up:</caption>
                    <table class="table table-hover caption-top" >
                      <thead>
                        <tr>
                          <th>Tipe</th>
                          <th width="100%">Tanggal</th>
                          <th>Follw Up</th>
                        </tr>
                      </thead>
                      <tbody class="overflow-auto"  >
                      @foreach($data->followup as $key => $val)
                      <tr>
                        <td>{{$val->type}}</td>
                        <td>{{$val->tanggalLabel}}</td>
                        <td>{{$val->hasil}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div><!--form-group-->
            </x-slot>

        </x-backend.card>
    </x-forms.post>
@endsection


@push('scripts')

<script>


</script>

@endpush