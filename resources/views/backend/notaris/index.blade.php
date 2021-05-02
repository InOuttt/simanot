@extends('backend.layouts.app')

@section('title', __('Data Notaris'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Data Notaris')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('notaris.create')"
                :text="__('Buat Data Notaris')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.notaris-table />
        </x-slot>
    </x-backend.card>
@endsection
