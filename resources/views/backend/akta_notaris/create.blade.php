@inject('model', '\App\Domains\Notaris\Models\Notaris')

@extends('backend.layouts.app')

@section('title', __('Buat Data Akta Notaris'))

@section('content')
    <x-forms.post :action="route('akta.notaris.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Buat Data Akta Notaris')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('notaris.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div >
                    <div class="form-group row">
                        <label for="id_notaris" class="col-md-2 col-form-label">Nama</label>

                        <div class="col-md-10">
                            <livewire:notaris-select2 />
                            <!-- <input type="text" name="name" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('name') }}" maxlength="100" required /> -->
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="no_covernote" class="col-md-2 col-form-label">No. Covernote</label>

                        <div class="col-md-10">
                            <input type="text" name="no_covernote" class="form-control" placeholder="{{ __('123/abc/Jun/2021') }}" value="{{ old('no_covernote') }}" maxlength="100" />
                        </div>
                    </div><!--form-group-->
<!-- 
                    <div class="form-group row">
                        <label for="durasi" class="col-md-2 col-form-label">Nama Pasangan</label>

                        <div class="col-md-10">
                            <input type="number" name="durasi" class="form-control" placeholder="{{ __('Nama Pasangan') }}" value="{{ old('couple_name') }}" maxlength="100" />
                        </div>
                    </div>form-group -->
                    <div class="form-group row">
                        <label for="jatuh_tempo" class="col-md-2 col-form-label">Jatuh Tempo</label>

                        <div class="col-md-10">
                            <input type="date" name="jatuh_tempo" class="form-control" placeholder="{{ __('Jatuh Tempo') }}" value="{{ old('jatuh_tempo') }}" />
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="os" class="col-md-2 col-form-label">Jatuh Tempo</label>

                        <div class="col-md-10">
                            <input type="number" name="os" class="form-control" placeholder="{{ __('Nama Pasangan') }}" value="{{ old('couple_name') }}" maxlength="100" />
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="is_perpanjangan_sertifikat" class="col-md-2 col-form-label">Status Perpanjangan</label>

                        <div class="col-md-10">
                            <input name="is_perpanjangan_sertifikat" id="is_perpanjangan_sertifikat" class="form-check-input" type="checkbox" value="Y" {{ old('is_perpanjangan_sertifikat', true) ? 'checked' : '' }} />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cluster" class="col-md-2 col-form-label">Cluster</label>

                        <div class="col-md-10">
                            <input type="string" name="cluster" class="form-control" placeholder="{{ __('Cluster') }}" value="{{ old('cluster') }}" maxlength="100" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_debitur" class="col-md-2 col-form-label">Nama Debitur</label>

                        <div class="col-md-10">
                            <input type="string" name="nama_debitur" class="form-control" placeholder="{{ __('Budi si Debitur') }}" value="{{ old('nama_debitur') }}" maxlength="100" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_dokumen" class="col-md-2 col-form-label">Nama Dokumen</label>

                        <div class="col-md-10">
                            <input type="string" name="nama_dokumen" class="form-control" placeholder="{{ __('dokumen piutang budi') }}" value="{{ old('nama_dokumen') }}" maxlength="255" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_tanggal_dokumen" class="col-md-2 col-form-label">Nomor Tanggal Dokumen</label>

                        <div class="col-md-10">
                            <input type="string" name="nomor_tanggal_dokumen" class="form-control" placeholder="{{ __('piutang/budi/xx/xx/xx') }}" value="{{ old('nomor_tanggal_dokumen') }}" maxlength="2255" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status_dokumen" class="col-md-2 col-form-label">Status Dokumen</label>

                        <div class="col-md-10">
                            <input name="status_dokumen" id="status_dokumen" class="form-check-input" type="checkbox" value="terima" {{ old('status_dokumen', true) ? 'checked' : '' }} />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_terima_dokumen" class="col-md-2 col-form-label">Tanggal Terima Dokumen</label>

                        <div class="col-md-10">
                            <input type="date" name="tanggal_terima_dokumen" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('tanggal_terima_dokumen') }}"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah_salinan" class="col-md-2 col-form-label">Jumlah Salinan</label>

                        <div class="col-md-10">
                            <input type="number" name="jumlah_salinan" class="form-control" placeholder="{{ __('3') }}" value="{{ old('jumlah_salinan') }}" maxlength="100" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_selesai" class="col-md-2 col-form-label">Tanggal Selesai</label>

                        <div class="col-md-10">
                            <input type="date" name="tanggal_selesai" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('tanggal_selesai') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_kirim_salinan" class="col-md-2 col-form-label">Tanggal Kirim salinan</label>

                        <div class="col-md-10">
                            <input type="date" name="tanggal_kirim_salinan" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('tanggal_kirim_salinan') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="akta_note" class="col-md-2 col-form-label">Keterangan</label>

                        <div class="col-md-10">
                            <livewire:akta-note />
                        </div>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Buat Data Akta Notaris')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
