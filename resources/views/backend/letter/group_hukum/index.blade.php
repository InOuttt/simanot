@extends('backend.layouts.app')

@section('title', __('Laporan Grup Hukum'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Laporan Grup Hukum')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.grup-hukum-table />

          
            <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"  aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <x-forms.post :action="route('letter.tagihan.store')">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Unggah file yang sudah ditanda tangani</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" name="notaris_id" class="form-control" id="id_notaris" value="" hidden>
                        <input type="text" name="bulan" class="form-control" id="bulan" value="" hidden>
                        <input type="text" name="tahun" class="form-control" id="tahun" value="" hidden>
                    <div class="mb-3">
                        <label for="tanggal_email" class="col-form-label">Tanggal Email ke Notaris</label>
                        <input type="date" name="tanggal_email" class="form-control" id="tanggal_email">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="col-form-label">File : </label>
                        <button type="button" class="btn btn-success" onClick="document.getElementById('file').click();">Unggah</button> 
                        <label id="fileLabel"></label>
                        <input type="file" name="file" id="file" style="display:none" class="form-control" />

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </div>
                </x-forms.post>
            </div>
            </div>

        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')

<script>

document.getElementById('file').addEventListener('change', function(){
    var file = this.files[0];
    document.getElementById('fileLabel').innerHTML = file.name;
}, false);

var uploadModal = document.getElementById('uploadModal')
uploadModal.addEventListener('show.coreui.modal', function (event) {
  var button = event.relatedTarget;
  var id = button.getAttribute('data-modal-id');
  var tahun = button.getAttribute('data-modal-tahun');
  var bulan = button.getAttribute('data-modal-bulan');

  document.getElementById('id_notaris').value = id;
  document.getElementById('tahun').value = tahun;
  document.getElementById('bulan').value = bulan;
})
</script>

@endpush
