@inject('model', '\App\Domains\Master\Models\Notaris')

@extends('backend.layouts.app')

@section('title', __('Edit Data Notaris'))

@section('content')
    <x-forms.patch :action="route('notaris.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Data Notaris '){{$data->nama}}
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('notaris.index')" :text="__('Batal')" />
            </x-slot>

            <x-slot name="body">
                <div >
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label">Nama</label>

                        <div class="col-md-10">
                            <input type="text" name="nama" class="form-control" placeholder="{{ __('contoh: Notaris abcde') }}" value="{{ $data->nama }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="partner_id" class="col-md-2 col-form-label">Nama Partner</label>

                        <div class="col-md-10">
                            <livewire:partner-select2 :idNotaris="$data->partner_id" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="alamat" class="col-md-2 col-form-label">Alamat</label>

                        <div class="col-md-10">
                            <textarea name="alamat" class="form-control" placeholder="contoh: Jl.jalan street" value="" rows='3' />{{ $data->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="domisili" class="col-md-2 col-form-label">Domisili</label>

                        <div class="col-md-10">
                            <textarea name="domisili" class="form-control" placeholder="contoh: DKI Jakarta" rows="3" />{{ $data->domisili }}</textarea>
                        </div>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Save')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
