@extends('backend.layouts.app')

@section('title', __('Data Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Data Covernote')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('covernote.create')"
                :text="__('Buat Data Covernote')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.covernote-table />
        </x-slot>
    </x-backend.card>
@endsection
