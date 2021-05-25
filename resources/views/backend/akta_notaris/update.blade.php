@extends('backend.layouts.app')

@section('title', __('Edit Data Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Edit Data Covernote')
        </x-slot>

        <x-slot name="body">
          <x-forms.get :action="route('akta.notaris.find')">
            <div class="form-group row">
                <label for="id_notaris" class="col-md-2 col-form-label">Nama Notaris</label>
                <div class="col-md-4">
                    <livewire:notaris-select2 />
                </div>
                <label for="id_notaris" class="col-md-2 col-form-label">Nama Debitur</label>

                <div class="col-md-4">
                    <livewire:debitur-select2 />
                </div>
            </div><!--form-group-->

            <button class="btn btn-sm btn-primary float-right" type="submit" id="find">@lang('Cari')</button>
          </x-forms.post>
        </x-slot>
    </x-backend.card>

    <x-backend.card>
      <x-slot name="body">
      <div class="form-group row">
        <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>No.</th>
                <th>Nama Notaris</th>
                <th>Nama Debitur</th>
                <th>Status Terima Dokumen</th>
                <th>Nama Dokumen</th>
                <th>No. Dokumen</th>
                <th>Tanggal Terima Dokumen</th>
                <th>Actions</th>
              </tr>
              @foreach($aktas as $key => $akta)
                <tr>
                  <th>{{$key+1}}</th>
                  <th>{{$akta->notaris->name}}</th>
                  <th>{{$akta->nama_debitur}}</th>
                  <th>{{$akta->status_dokumen}}</th>
                  <th>{{$akta->nama_dokumen}}</th>
                  <th>{{$akta->nomor_tanggal_dokumen}}</th>
                  <th>{{$akta->tanggal_terima_dokumen}}</th>
                  <th>
                    <x-utils.edit-button :href="route('akta.notaris.edit', $akta)" />
                  </th>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </x-slot>
    </x-backend.card>

@endsection