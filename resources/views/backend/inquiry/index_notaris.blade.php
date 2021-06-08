@extends('backend.layouts.app')

@section('title', __('Inquiry - Index Notaris'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Inquiry - Index Notaris')
        </x-slot>

        <x-slot name="body">
            <x-forms.get :action="route('inquiry.index_notaris.index')" id="search-index">
              <div class="form-group row mb-4">
                  <label for="id_notaris" class="col-md-2 col-form-label">Nama Notaris</label>

                  <div class="col-md-4">
                      <livewire:notaris-select2 :idNotaris="!empty($oldData) ? $oldData->id : null"/>
                  </div>


                  <div class="col-md-4">
                      <label for="status_akta" class="col-md-4 col-form-label" style="padding-left: 0px;">Status Akta</label>
                      <input type="checkbox" class="" value=0 name="status" checked>
                      <label for="status">Belum Terima</label>
                  </div>
              </div>
          
              <div class="form-group row">
                <label for="bulan" class="col-md-2 col-form-label">Bulan</label>

                <div class="col-md-4">
                  <select name="bulan" class="form-control">
                    @foreach(listMonth() as $key => $val) 
                      <option value="{{$key}}" {{$key == date('m') ? 'selected' : ''}}>{{__($val)}}</option>
                    @endforeach
                  </select>
                </div>
                <label for="tahun" class="col-md-1 col-form-label">Tahun</label>

                <div class="col-md-4">
                  <select name="tahun" class="form-control" >
                    @for($i=2010; $i<=date('Y'); $i++)
                        <option value="{{$i}}" {{$i == date('Y') ? 'selected' : ''}}>{{$i}}</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                    <div class="col-md-4 float-right">
                        <button type="submit" class="btn btn-primary float-right" id="search-btn" disabled>Cari</button>
                    </div>
                </div>
              </div>
            </x-forms.get>
          
          @if(!empty($datas))
          <div class="row">
              <div class="col-md-6">
                  <table class="table table-borderless">
                    <tr>
                      <td>Nama Notaris</td>
                      <td>:</td>
                      <td>{{$namaNotaris}}</td>
                    </tr>
                    <tr>
                      <td>Jumlah Debitur</td>
                      <td>:</td>
                      <td>{{$totalDatas}}</td>
                    </tr>
                    <tr>
                      <td>Rincian Debitur</td>
                      <td>:</td>
                      <td>
                      @for($i = 0; $i < $totalDatas; $i++)
                        {{$i+1}}. {{$datas[$i]['nama_debitur']}} </br>
                      @endfor
                      </td>
                    </tr>
                  </table>
              </div>
          </div>
          @endif
        </x-slot>
    </x-backend.card>
@endsection

@push('scripts')
<script>
  var notarisId = $('#select2-dropdown').val();
  if(notarisId) {
    $('#search-btn').prop('disabled', false);
  }
  $('#select2-dropdown').on('change', function(e, f) {
    console.log(this.value);
    if(this.value) {
      $('#search-btn').prop('disabled', false);
    }
  })
</script>

@endpush
