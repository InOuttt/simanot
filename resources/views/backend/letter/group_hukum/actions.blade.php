@if (!$model->isAdmin())
    <x-utils.link target="__blank" :href="route('letter.grup_hukum.download', ['clusterId' => $model->cluster_id, 'bulan' => $model->tenggat_bulan_number, 'tahun' => $model->tenggat_tahun])" class="btn btn-secondary btn-sm" :text="__('Download File')" />
    <button data-coreui-toggle="modal" data-coreui-target="#uploadModal" 
      data-toggle="modal" data-target="#uploadModal"
      data-modal-id="{{$model->cluster_id}}" data-modal-tahun="{{$model->tenggat_tahun}}" data-modal-bulan="{{$model->tenggat_bulan_number}}"
      id="upload" class="btn btn-success btn-sm" :text="__('Unggah File')" />
      Unggah
    </button>
@endif


@push('scripts')

<script>

</script>

@endpush
