@extends('backend.layouts.app')

@section('title', __('Laporan Dokumen Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Laporan Dokumen Covernote')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.report-notaris-table />
        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')

<script>

</script>

@endpush
