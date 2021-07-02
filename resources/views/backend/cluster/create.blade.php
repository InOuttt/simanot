@inject('model', '\App\Domains\Master\Models\Cluster')

@extends('backend.layouts.app')

@section('title', __('Buat Data Cluster'))

@section('content')
    <x-forms.post :action="route('cluster.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Buat Data Cluster')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('cluster.index')" :text="__('Batal')" />
            </x-slot>

            <x-slot name="body">
                <div >
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label">Nama</label>

                        <div class="col-md-10">
                            <input type="text" name="nama" class="form-control" placeholder="{{ __('contoh: Cluster abcde') }}" value="{{ old('nama') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Save')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
