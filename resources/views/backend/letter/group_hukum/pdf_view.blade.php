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

    .text-center {
      padding-left: 25%;
    }
  </style>
</head>
<body>
  <div class="container">

    <div class="row ">
      <div class="col-md-12 ">
        <h2 class="text-center">Laporan Outstanding Covernote Jatuh Tempo {{__($bulan)}} {{$tahun}}</h2>
        <h3 style="padding-left: 40%;" >Cluster {{$cluster}}</h2>
      </div>
    </div>
    <div class="row entered">&nbsp;</div>
    <div class="row ">
    <table class="table word-setting" border="1px solid">
      <thead>
        <tr>
          <th style="width: 70px">Nama Notaris</th>
          <th style="width: 100px">Tanggal Terbit CN</th>
          <th style="width: 100px">Tanggal Jatuh Tempo CN</th>
          <th style="width: 70px">Nama Debitur</th>
          <th style="width: 80px">Nama dokumen</th>
          <th style="width: 70px">No. dokumen</th>
          <th style="width: 100px">Tanggal dokumen</th>
          <th style="width: 150px">Keterangan Saat ini</th>
        </tr >
      </thead>
      <tbody>
        @foreach($datas as $data => $val)
        <tr>
          <td>{{$val->covernote->notaris->nama}}</td>
          <td>{{carbon($val->covernote->tanggal_covernote)->format('d-m-Y')}}</td>
          <td>{{carbon($val->covernote->jatuh_tempo)->format('d-m-Y')}}</td>
          <td>{{$val->covernote->nama_debitur}}</td>
          <td>{{$val->nama}}</td>
          <td>{{$val->nomor}}</td>
          <td>{{carbon($val->tanggal_terbit)->format('d-m-Y')}}</td>
          <td >{{html_entity_decode($val->followup_last_hasil)}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</body>
</html>