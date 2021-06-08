@extends('backend.layouts.app')

@section('title', __('Inquiry - Grup Hukum'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Inquiry - Grup Hukum')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.inquiry.grup-hukum-table />
        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')

<script>

</script>

@endpush
