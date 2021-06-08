@if (!$model->isAdmin())
    <button data-coreui-toggle="modal" data-coreui-target="#followupModal" 
      data-toggle="modal" data-target="#followupModal"
      data-modal-id="{{$model->id}}" data-modal-tahun="{{$model->tenggat_tahun}}" data-modal-bulan="{{$model->tenggat_bulan_number}}"
      id="followup" class="btn btn-primary btn-sm" :text="__('Folow Up')" />
      Follow UP
    </button>
@endif


@push('scripts')

<script>

</script>

@endpush
