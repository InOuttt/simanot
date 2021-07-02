@extends('backend.layouts.app')

@section('title', __('Data Cluster'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Data Cluster')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('cluster.create')"
                :text="__('Buat Data Cluster')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.cluster-table />
        </x-slot>
    </x-backend.card>
@endsection
