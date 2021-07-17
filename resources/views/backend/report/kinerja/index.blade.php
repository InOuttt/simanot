@extends('backend.layouts.app')

@section('title', __('Laporan Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Laporan Covernote')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.report-kinerja-table />
        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')

<script>

</script>

@endpush
