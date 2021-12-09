<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>home</title>
  </head>
  <body>
<div class="container">
<h1>HASIL</h1>
<a href="/hitung">BACK</a>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Data Dasar</h5>
      @foreach($estimasis as $estimasi)
      <table class="table table-borderless">
        <tr>
          <td>Luas Tanah</td>
          <td>{{$estimasi->luas_tanah}} m2</td>
        </tr>
        <tr>
          <td>Luas Bangunan</td>
          <td>{{$estimasi->luas_bangunan}} m2</td>
        </tr>
        <tr>
          <td>Status Bangunan</td>
          <td>{{$estimasi->gedungs->nama}}</td>
        </tr>
      </table>
    @endforeach
    </div>
</div>

<div class="card">
  <div class="card-body">
  <h5 class="card-title">Sarana</h5>
  <table class="table table-borderless">
    @foreach($detail_saranas as $detail_sarana)
        <tr>
          <td>{{$detail_sarana->saranas->nama}}</td>
          <td>{{$detail_sarana->jumlah_sarana}} x {{$detail_sarana->saranas->biaya}}</td>
          <td>{{$detail_sarana->jumlah_sarana*$detail_sarana->saranas->biaya}}</td>
        </tr>
    @endforeach 
        <tfoot>
          <tr>
            <th scope="col">Total</th>
            <th scope="col"> </th>
            <th scope="col">{{$total_sarana}}</th>
          </tr> 
        </tfoot>
    </table>
    </div>
</div>

<div class="card">
  <div class="card-body">
  <h5 class="card-title">Indeks Parameter</h5>
  <p><b>Fungsi</b></p>
    @foreach($detail_estimasis as $detail_estimasi)
        @if ($detail_estimasi->indeks->parameter == "fungsi")
          <p>{{$detail_estimasi->indeks->tingkatan}} | Indeks : {{$detail_estimasi->indeks->bobot_indeks}}</p>
        @endif
      @endforeach
  <p><b>Waktu</b></p>
    @foreach($detail_estimasis as $detail_estimasi)
      @if ($detail_estimasi->indeks->parameter == "waktu")
          <p>{{$detail_estimasi->indeks->tingkatan}} | Indeks : {{$detail_estimasi->indeks->bobot_indeks}}</p>
      @endif
    @endforeach
  <table class="table mb-0">
  <p><b>Klasifikasi</b></p>
    @foreach($detail_estimasis as $detail_estimasi)
      @if ($detail_estimasi->indeks->kategori_indeks_id!==Null)
        <tr>
          <td>{{$detail_estimasi->indeks->kategori_indeks->nama}} : {{$detail_estimasi->indeks->tingkatan}}</td>
          <td>Indeks : {{$detail_estimasi->indeks->bobot_indeks}}</td>
          <td>Bobot Kategori : {{$detail_estimasi->indeks->kategori_indeks->bobot_kategori}}</td>
        </tr>
      @endif
    @endforeach
    </table>
    <div>
      <p>Indeks Klasifikasi = 
          @foreach($detail_estimasis as $detail_estimasi)
            @if ($detail_estimasi->indeks->kategori_indeks_id!==Null)
              ({{$detail_estimasi->indeks->bobot_indeks}}x{{$detail_estimasi->indeks->kategori_indeks->bobot_kategori}})+
            @endif
          @endforeach
            = {{$ik}}
      </p>
      <p>Indeks Terintegrasi =  
        @foreach($detail_estimasis as $detail_estimasi)
           @if ($detail_estimasi->indeks->kategori_indeks_id == Null)
              {{$detail_estimasi->indeks->bobot_indeks}}x
          @endif
        @endforeach
        {{$ik}} = {{$it}}
      </p>
    </div>
    </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Total Biaya Retribusi</h5>
      <p>Bangunan Gedung = L x It x Indeks Gedung x HSbg</p>
      @foreach($estimasis as $estimasi)
      <p>= 
          {{$estimasi->luas_bangunan}} x {{$it}} x {{$estimasi->gedungs->bobot_indeks}} x {{$estimasi->gedungs->biaya}}
      </p>
      <p> = {{$bangunan_gedung}} </p>
      <br></br>
      <p> Total Retribusi = Biaya Bangunan + Biaya Prasarana</p>
      <p> = {{$bangunan_gedung}} + {{$total_sarana}}</p>
      <p> = {{$estimasi->total_biaya}}</p>
      @endforeach
  </div>
</div>

  </body>
</html>