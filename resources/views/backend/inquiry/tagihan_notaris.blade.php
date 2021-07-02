@extends('backend.layouts.app')

@section('title', __('Inquiry - Laporan Outstanding Notaris'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Inquiry - Laporan Outstanding Notaris')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.inquiry.surat-tagihan-table />
        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')

<script>

</script>

@endpush
