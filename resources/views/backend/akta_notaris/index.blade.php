@extends('backend.layouts.app')

@section('title', __('Data Akta Notaris'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Data Akta Notaris')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('akta.notaris.create')"
                :text="__('Buat Data Akta Notaris')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.akta-notaris-table />
        </x-slot>
    </x-backend.card>
@endsection
