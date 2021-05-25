@inject('model', '\App\Domains\Master\Models\Notaris')

@extends('backend.layouts.app')

@section('title', __('Edit Covernote'))

@section('content')
    <x-forms.patch :action="route('akta.notaris.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Covernote')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('notaris.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div >
                    <div class="form-group row">
                        <label for="id_notaris" class="col-md-2 col-form-label">Nama</label>

                        <div class="col-md-10">
                            <livewire:notaris-select2 :idNotaris="$data->id_notaris" />
                            <!-- <input type="text" name="name" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('name') }}" maxlength="100" required /> -->
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="no_covernote" class="col-md-2 col-form-label">No. Covernote</label>

                        <div class="col-md-10">
                            <input type="text" name="no_covernote" class="form-control" placeholder="{{ __('123/abc/Jun/2021') }}" value="{{ $data->no_covernote}}" maxlength="100" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="jatuh_tempo" class="col-md-2 col-form-label">Jatuh Tempo</label>

                        <div class="col-md-10">
                            <input type="date" name="jatuh_tempo" class="form-control" placeholder="{{ __('Jatuh Tempo') }}" value="{{ $data->jatuh_tempo }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_perpanjangan_sertifikat" class="col-md-2 col-form-label">Status Perpanjangan</label>

                        <div class="col-md-10">
                            <input name="is_perpanjangan_sertifikat" id="is_perpanjangan_sertifikat" class="form-check-input" type="checkbox" value="Y" {{ $data->is_perpanjangan_sertifikat == 'Y' ? 'checked' : '' }} />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cluster" class="col-md-2 col-form-label">Cluster</label>

                        <div class="col-md-10">
                            <input type="string" name="cluster" class="form-control" placeholder="{{ __('Cluster') }}" value="{{ $data->cluster }}" maxlength="100" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_debitur" class="col-md-2 col-form-label">Nama Debitur</label>

                        <div class="col-md-10">
                            <input type="string" name="nama_debitur" class="form-control" placeholder="{{ __('Budi si Debitur') }}" value="{{ $data->nama_debitur }}" maxlength="100" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_dokumen" class="col-md-2 col-form-label">Nama Dokumen</label>

                        <div class="col-md-10">
                            <input type="string" name="nama_dokumen" class="form-control" placeholder="{{ __('dokumen piutang budi') }}" value="{{ $data->nama_dokumen }}" maxlength="255" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_tanggal_dokumen" class="col-md-2 col-form-label">Nomor Tanggal Dokumen</label>

                        <div class="col-md-10">
                            <input type="string" name="nomor_tanggal_dokumen" class="form-control" placeholder="{{ __('piutang/budi/xx/xx/xx') }}" value="{{ $data->nomor_tanggal_dokumen }}" maxlength="2255" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_dokumen" class="col-md-2 col-form-label">Status Dokumen</label>

                        <div class="col-md-10">
                            <input name="status_dokumen" id="status_dokumen" class="form-check-input" type="checkbox" value="terima" {{ $data->status_dokumen == 'terima' ? 'checked' : '' }} />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_terima_dokumen" class="col-md-2 col-form-label">Tanggal Terima Dokumen</label>

                        <div class="col-md-10">
                            <input type="date" name="tanggal_terima_dokumen" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ $data->tanggal_terima_dokumen }}"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah_salinan" class="col-md-2 col-form-label">Jumlah Salinan</label>

                        <div class="col-md-10">
                            <input type="number" name="jumlah_salinan" class="form-control" placeholder="{{ __('3') }}" value="{{ $data->jumlah_salinan }}" maxlength="100" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_selesai" class="col-md-2 col-form-label">Tanggal Selesai</label>

                        <div class="col-md-10">
                            <input type="date" name="tanggal_selesai" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ $data->tanggal_selesai }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_kirim_salinan" class="col-md-2 col-form-label">Tanggal Kirim salinan</label>

                        <div class="col-md-10">
                            <input type="date" name="tanggal_kirim_salinan" class="form-control" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ $data->tanggal_kirim_salinan }}" />
                        </div>
                    </div>
<!-- 

                    <div class="form-group row">
                        <label for="akta_note" class="col-md-2 col-form-label">Keterangan</label>

                        <div class="col-md-10">
                            <livewire:akta-note />
                        </div>
                    </div> -->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Edit Data')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
