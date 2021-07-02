<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
    .word-setting {
      /* table-layout: fixed; */
      word-wrap: break-word;
    }
    .entered {
    };
    .table {
      border: 1px solid;
      width: 100%;
    }
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    /* tr:nth-child(even) {
      background-color: #dddddd;
    } */
  </style>
</head>
<body>
  <div class="container">

    <div class="row ">
      <div class="col-md-12 ">
        <h2 class="text-center" style="padding-left: 25%;">Lampiran Surat Outstanding per{{__($bulan)}} {{$tahun}}</h2>
      </div>
    </div>
    <div class="row entered">&nbsp;</div>
    <div class="row ">
      <div class="col-md-12 ">
        <h4 class="">Nama Notaris : {{$notaris}}</h2>
      </div>
    </div>
    <div class="row ">
    <table class="table word-setting" border="1px solid">
      <thead>
        <tr>
          <th style="width: 70px">Nama Debitur</th>
          <th style="width: 100px">Nomor Covernote</th>
          <th style="width: 100px">Tanggal Terbit Covernote</th>
          <th style="width: 100px">Tanggal Jatuh Tempo Covernote</th>
          <th style="width: 70px">cluster</th>
          <th style="width: 80px">Nama Dokumen</th>
          <th style="width: 70px">No. Dok</th>
          <th style="width: 100px">Tgl. Dok</th>
          <th style="width: 70px">Status Akta</th>
          <th style="width: 150px">Keterangan Saat ini</th>
          <th style="width: 70px">Tanggapan Notaris</th>
        </tr >
      </thead>
      <tbody>
        @foreach($datas as $data => $val)
        <tr>
          <td>{{$val->covernote->nama_debitur}}</td>
          <td>{{$val->covernote->no_covernote}}</td>
          <td>{{carbon($val->covernote->tanggal_covernote)->format('d-m-Y')}}</td>
          <td>{{carbon($val->covernote->jatuh_tempo)->format('d-m-Y')}}</td>
          <td>{{$val->covernote->cluster->nama}}</td>
          <td>{{$val->nama}}</td>
          <td>{{$val->nomor}}</td>
          <td>{{carbon($val->tanggal_terbit)->format('d-m-Y')}}</td>
          <td>{{$val->status_label}}</td>
          <td >{{html_entity_decode($val->followup_last_hasil)}}</td>
          <td width="100px">&nbsp;</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</body>
</html>