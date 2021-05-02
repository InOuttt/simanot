@inject('model', '\App\Domains\Notaris\Models\Notaris')

@extends('backend.layouts.app')

@section('title', __('Edit Data Notaris'))

@section('content')
    <x-forms.patch :action="route('notaris.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Data Notaris')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('notaris.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">Nama</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $data->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="couple_name" class="col-md-2 col-form-label">Nama Pasangan</label>

                        <div class="col-md-10">
                            <input type="text" name="couple_name" class="form-control" placeholder="{{ __('Couple_name') }}" value="{{ old('couple_name')?? $data->couple_name }}" maxlength="100" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">Alamat</label>

                        <div class="col-md-10">
                            <textarea name="address" class="form-control" placeholder="Alamat" value="" rows='3' />{{ old('address')?? $data->address }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="domicile" class="col-md-2 col-form-label">Domisili</label>

                        <div class="col-md-10">
                            <textarea name="domicile" class="form-control" placeholder="Domisili" rows="3" />{{ old('domicile')?? $data->domicile }}</textarea>
                        </div>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Edit Data Notaris')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
