@extends('backend.layouts.app')

@section('title', __('Follow up Data Covernote'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Follow up Data Covernote')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.covernote-document-table />
        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')

<script>
$(document).ready(function () {

</script>

@endpush
