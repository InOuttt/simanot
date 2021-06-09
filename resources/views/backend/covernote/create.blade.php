@inject('model', '\App\Domains\Master\Models\Notaris')

@extends('backend.layouts.app')

@section('title', __('Buat Data Covernote'))

@section('content')
    <x-forms.post :action="route('covernote.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Buat Data Covernote')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('covernote.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div >
                    <div class="form-group row">
                        <label for="id_notaris" class="col-md-2 col-form-label">Nama Notaris</label>

                        <div class="col-md-4">
                            <livewire:notaris-select2 />
                            <!-- <input type="text" name="name" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('name') }}" maxlength="100" required /> -->
                        </div>

                        <label for="tanggal_covernote" class="col-md-2 col-form-label">Tanggal Covernote</label>

                        <div class="col-md-4">
                            <input type="date" id="tanggal_covernote" name="tanggal_covernote" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('tanggal_covernote') }}" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="no_covernote" class="col-md-2 col-form-label">Nomor Covernote</label>

                        <div class="col-md-4">
                            <input type="text" name="no_covernote" class="form-control" placeholder="{{ __('ex : 123/abc/Jun/2021') }}" value="{{ old('no_covernote') }}" maxlength="100" />
                        </div>
                        <label for="jatuh_tempo" class="col-md-2 col-form-label">Jatuh Tempo</label>

                        <div class="col-md-4">
                            <input type="date" id="jatuh_tempo" name="jatuh_tempo" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('jatuh_tempo') }}" />
                        </div>
                    </div><!--form-group-->

                    <!-- <div class="form-group row">

                    </div> -->
                    <div class="form-group row">
                        <label for="durasi" class="col-md-2 col-form-label">Jangka Waktu</label>

                        <div class="col-md-4">
                            <input type="number" id="durasi" name="durasi" class="form-control" placeholder="{{ __('... Hari') }}" value="{{ old('durasi') }}" maxlength="100" />
                        </div>
                        <label for="cluster" class="col-md-2 col-form-label">Cluster</label>

                        <div class="col-md-4">
                            <select name="cluster_id">
                                @foreach($clusters as $cluster)
                                <option value="{{$cluster->id}}">{{$cluster->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="nama_debitur" class="col-md-2 col-form-label">Nama Debitur</label>

                        <div class="col-md-4">
                            <input type="string" name="nama_debitur" class="form-control" placeholder="{{ __('ex : Budi si Debitur') }}" value="{{ old('nama_debitur') }}" maxlength="100" />
                        </div>
                        
                        <label for="is_perpanjangan_sertifikat" class="col-md-2 col-form-label">Perpanjangan Sertifikat</label>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_perpanjangan_sertifikat" id="flexRadioDefault1" value="0" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Tidak
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_perpanjangan_sertifikat" id="flexRadioDefault2" value="1">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Iya
                                </label>
                            </div>
                        </div>
                    </div>

                    <livewire:covernote-dokumen />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Save')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection


@push('scripts')

<script>
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
$(document).ready(function () {
        $('#durasi').on('change',function(e) {
            console.log(this.value);
            var local = $('#tanggal_covernote').val() ? new Date($('#tanggal_covernote').val()) : new Date();
            console.log(local);
            local = new Date(local.getTime() + (this.value * 60 * 60 * 24 * 1000 ));
            console.log(local);

            $('#jatuh_tempo').val(formatDate(local));
        })

    });

</script>

@endpush