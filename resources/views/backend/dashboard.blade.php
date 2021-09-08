

@extends('backend.layouts.app')

@section('title', __('Dashboard'))
@push('after-styles')

<style>
.loading {
    display:    block;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('/img/loading.gif') 
                50% 50% 
                no-repeat;
}
</style>
@endpush
@section('content')
<div class='loading' id='loading-dashboard-chart'></div>
    <div class="row">
    <div class="col-md-6">
        <div class="card text-center" style="padding: 1.25rem">
            <div class="card-header">
                @lang('Covernote Outstanding')
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <canvas id="dashboard-chart-outstanding-notaris" width="200" height="200"></canvas>
                    <label>Per Notaris</label>
                </div>
                <div class="col-md-6">
                    <canvas id="dashboard-chart-outstanding-cluster" width="200" height="200"></canvas>
                    <label>Per Cluster</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" >
        <div class="card text-center"style="padding: 1.25rem">
            <div class="card-header">
                @lang('Penerimaan Covernote')
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <canvas id="dashboard-chart-penerimaan-notaris" width="200" height="200"></canvas>
                    <label>Per Notaris</label>
                </div>
                <div class="col-md-6">
                    <canvas id="dashboard-chart-penerimaan-cluster" width="200" height="200"></canvas>
                    <label>Per Cluster</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3" >&nbsp;</div>
    <div class="col-md-6" >
        <div class="card text-center"style="padding: 1.25rem">
            <div class="card-header">
                @lang('Total Dokumen Covernote ') <span id="dashboard-total-status"></span> Dokumen
            </div>
            <div class="card-body row">
                <div class="col-md-12" >
                    <canvas id="dashboard-chart-status" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3" >&nbsp;</div>
    <div class="col-md-12" >
        <div class="card"style="padding: 1.25rem">
            <div class="card-header">
                @lang('Follow Up terbaru')
            </div>
            <div class="card-body">
            <div class="overflow-auto" style="height: 500px;">
                    <table class="table table-hover caption-top" >
                      <thead>
                        <tr>
                          <th>Notaris</th>
                          <th>Debitur</th>
                          <th>Cluster</th>
                          <th>Nama Dokumen</th>
                          <th>Tipe</th>
                          <th>Tanggal</th>
                          <th width="100%">Follw Up</th>
                        </tr>
                      </thead>
                      <tbody class="overflow-auto"  >
                      @foreach($followup as $key => $val)
                        <tr>
                            <td>{{$val->covernote->notaris->nama}}</td>
                            <td>{{$val->covernote->nama_debitur}}</td>
                            <td>{{$val->covernote->cluster->nama}}</td>
                            <td> <x-utils.link :href="route('covernote.document.followup.edit', $val->covernoteDocument)" :text="$val->covernoteDocument->nama" target="blank();" /></td>
                            <td>{{$val->type}}</td>
                            <td>{{$val->tanggalLabel}}</td>
                            <td>{{$val->hasil}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
<script>

</script>
@endpush
