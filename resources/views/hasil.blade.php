@extends('layouts.main')

@section('title','Hasil| Estimasi Retribusi IMB')

@section('container')

<div class="container container_margin">
    <div class="row justify-content-center">
    <h1>HASIL</h1>
      <div class="col-sm-9">
          <div class="row shadow-sm p-3 mb-1 bg-body round">
              <h5 class="hitung">Data Dasar</h5>
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
          <div class="row shadow-sm p-3 mb-1 bg-body round">
            <h5 class="hitung">Sarana</h5>
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
          <div class="row shadow-sm p-3 mb-1 bg-body round">
            <h5 class="hitung">Indeks Parameter</h5>
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

          <div class="row shadow-sm p-3 mb-1 bg-body round">
            <h5 class="hitung">Total Biaya Retribusi</h5>
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
    </div>
</div>