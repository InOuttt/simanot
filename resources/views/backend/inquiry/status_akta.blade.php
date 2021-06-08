@extends('backend.layouts.app')

@section('title', __('Inquiry - Status Akta Notaris'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Inquiry - Status Akta Notaris')
        </x-slot>

        <x-slot name="body">
          <livewire:backend.inquiry.status-akta-table />

          
            <div class="modal fade" id="followupModal" tabindex="-1" role="dialog"  aria-labelledby="followupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <x-forms.post :action="route('letter.grup_hukum.store')">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="followupModalLabel">Follow UP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <table class="table table-hover" id="table-followup">
                    <thead>
                      <th>Tipe Follow up</th>
                      <th>Tanggal Follow up</th>
                      <th>Hasil Follow up</th>
                    </thead>
                    <tbody id='tbody-table-followup'>

                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

var followupModal = document.getElementById('followupModal')
followupModal.addEventListener('show.coreui.modal', function (event) {
  var button = event.relatedTarget;
  var id = button.getAttribute('data-modal-id');
  var tahun = button.getAttribute('data-modal-tahun');
  var bulan = button.getAttribute('data-modal-bulan');
  var body = $('#table-followup tbody');
  body.empty();

  $.ajax({
      url: '/inquiry/status-akta/'+id+'/followup',
      type: 'get',
      dataType: 'json',
      success: function(response) {
        response.forEach(e => {
            body.append(
                "<tr>" +
                    "<td>" + e.type + "</td>" +
                    "<td>" + e.tanggal_followup.split('-').reverse().join('-') + "</td>" +
                    "<td>" + e.hasil + "</td>" +
                "</tr>"
            );
        });
      },
      // delay: 250,
      processResults: function (data) {
          return {
              results: $.map(data, function (item) {
                  return {
                      text: item.nama_debitur,
                      id: item.nama_debitur
                  }
              })
          };
      },
      open: function () {
          $('input.select2-search__field')[0].focus()
      }
  });
})
</script>

@endpush
