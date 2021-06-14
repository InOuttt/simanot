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
        <h2 class="text-center" style="padding-left: 25%;">Jumlah Covernote Jatuh Tempo Terhitung Dari Tanggal : {{$tanggal}} {{__('bulan-'.$bulan)}} {{$tahun}}</h2>
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
          <th style="width: 100px">0 - 3 bulan</th>
          <th style="width: 100px">3 - 6 bulan</th>
          <th style="width: 100px"> > 6 bulan</th>
        </tr >
      </thead>
      <tbody>
        @foreach($datas as $data => $val)
        <tr>
          <td>{{$val->nama}}</td>
          <td>{{$val->covernote_under90}}</td>
          <td>{{$val->covernote_between180}}</td>
          <td>{{$val->covernote_more180}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</body>
</html>