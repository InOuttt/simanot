@extends('backend.layouts.app')

@section('title', __('Follow up Data Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Follow up Data Covernote')
        </x-slot>

        <x-slot name="body">
          <x-forms.get :action="route('covernote.document.index')">
            <div class="form-group row">
                <label for="nama_notaris" class="col-md-2 col-form-label">Nama Notaris</label>
                <div class="col-md-4">
                  <input type="text" name="nama_notaris" class="form_control" id="nama_notaris">
                </div>
                <label for="nama_debitur" class="col-md-2 col-form-label">Nama Debitur</label>

                <div class="col-md-4">
                    <input type="text" name="nama_debitur" class="form_control" id="nama_debitur">
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
                <th>Tanggal Terbit</th>
                <th>Actions</th>
              </tr>
              @foreach($documents as $key => $document)
                <tr>
                  <th>{{$key+1}}</th>
                  <th>{{$document->covernote->notaris->nama}}</th>
                  <th>{{$document->covernote->nama_debitur}}</th>
                  <th>{{$document->status}}</th>
                  <th>{{$document->nama}}</th>
                  <th>{{$document->nomor}}</th>
                  <th>{{$document->tanggal_terbit}}</th>
                  <th>
                    <x-utils.edit-button :href="route('covernote.document.edit', $document)" />
                  </th>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </x-slot>
    </x-backend.card>
    <livewire:datatable model="App\Domains\Covernote\Models\CovernoteDocument" />
@endsection
<!-- php artisan vendor:publish --provider="Mediconesystems\LivewireDatatables\LivewireDatatablesServiceProvider" -->

@push('scripts')

<script>
$(document).ready(function () {

</script>

@endpush
