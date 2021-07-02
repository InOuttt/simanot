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
        <h2 class="text-center" style="padding-left: 25%;">Laporan Notaris Bulan: {{__($bulan)}} Tahun: {{$tahun}}</h2>
      </div>
    </div>
    <div class="row entered">&nbsp;</div>
    <div class="row ">
      <div class="col-md-12 ">
        <h4 class="">&nbsp;</h2>
      </div>
    </div>
    <div class="row ">
    <table class="table word-setting" border="1px solid">
      <thead>
        <tr>
          <th style="width: 70px">Nama Notaris</th>
          <th style="width: 100px">Total Covernote</th>
          <th style="width: 100px">Total Dokumen</th>
          <th style="width: 100px">Dokumen Belum selesai</th>
          <th style="width: 100px">Dokumen Selesai</th>
          <th style="width: 100px">Dokumen Koreksi</th>
        </tr >
      </thead>
      <tbody>
        @foreach($datas as $data => $val)
        <tr>
          <td>{{$val->nama}}</td>
          <td>{{$val->covernotes_count}}</td>
          <td>{{$val->covernotes_documents_count}}</td>
          <td>{{$val->documents_unfinish_count}}</td>
          <td>{{$val->documents_finish_count}}</td>
          <td>{{$val->documents_correction_count}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</body>
</html>