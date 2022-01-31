@extends('layouts.main')

@section('title','Hasil| Estimasi Retribusi IMB')

@section('container')

<div class="container container_margin">
    <div class="row justify-content-center">
      <div class="col-sm-9">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/estimasi">Beranda</a></li>
              <li class="breadcrumb-item"><a href="/hitung">Hitung</a></li>
              <li class="breadcrumb-item active"><a href="#">Hasil</a></li>
            </ol>
          </nav>
          <div class="row shadow-sm p-3 mb-2 bg-body round">
              <h5 class="hitung">Data Dasar</h5>
                @foreach($estimasis as $estimasi)
                <table class="table table-borderless">
                  <tr>
                    <td>Luas Tanah</td>
                    <td>: {{$estimasi->luas_tanah}} m<sup>2</sup></td>
                  </tr>
                  <tr>
                    <td>Luas Bangunan</td>
                    <td>: {{$estimasi->luas_bangunan}} m<sup>2</sup></td>
                  </tr>
                  <tr>
                    <td>Status Bangunan</td>
                    <td>: {{$estimasi->gedungs->nama}}</td>
                  </tr>
                </table>
              @endforeach
            </div>
          <div class="row shadow-sm p-3 mb-2 bg-body round">
            <h5 class="hitung">Sarana</h5>
            <table class="table table-borderless">
              @foreach($detail_saranas as $detail_sarana)
                  <tr>
                    <td>{{$detail_sarana->sarana->nama}}</td>
                    <td>{{$detail_sarana->jumlah_sarana}} x Rp {{number_format($detail_sarana->sarana->biaya,0)}}</td>
                    <td>Rp {{number_format($detail_sarana->jumlah_sarana*$detail_sarana->sarana->biaya,0)}}</td>
                  </tr>
              @endforeach 
                  <tfoot class="border-top">
                    <tr>
                      <th scope="col">Total</th>
                      <th scope="col"> </th>
                      <th scope="col">Rp {{number_format($total_sarana,0)}}</th>
                    </tr> 
                  </tfoot>
              </table>
          </div>
          <div class="row shadow-sm p-3 mb-2 bg-body round">
            <h5 class="hitung">Indeks Parameter</h5>
            <div class="mt-2">
              <label class="mb-2"><b>Fungsi</b></label>
                @foreach($detail_estimasis as $detail_estimasi)
                    @if ($detail_estimasi->indeks->parameter == "fungsi")
                      <p>{{$detail_estimasi->indeks->tingkatan}} ( Indeks : {{$detail_estimasi->indeks->bobot_indeks}} )</p>
                    @endif
                  @endforeach
            </div>
            <div class="mt-2">
              <label class="mb-2"><b>Waktu</b></label>
                @foreach($detail_estimasis as $detail_estimasi)
                  @if ($detail_estimasi->indeks->parameter == "waktu")
                      <p>{{$detail_estimasi->indeks->tingkatan}} ( Indeks : {{$detail_estimasi->indeks->bobot_indeks}} )</p>
                  @endif
                @endforeach
            </div>
            <div class="mt-2">
              <table class="table" id="klasifikasi">
            
                <thead>
                  <tr>
                    <th>Klasifikasi</th>
                    <th class="text-center">Indeks x Bobot Kategori</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $jml = 0;
                  @endphp
                  @foreach($detail_estimasis as $detail_estimasi)
                    @if ($detail_estimasi->indeks->kategori_indeks_id!==Null)
                      <tr>
                        <td>{{$detail_estimasi->indeks->kategori_indeks->nama}} : {{$detail_estimasi->indeks->tingkatan}}</td>
                        <!-- <td>Indeks : {{$detail_estimasi->indeks->bobot_indeks}}</td> -->
                        <!-- <td>Bobot Kategori : {{$detail_estimasi->indeks->kategori_indeks->bobot_kategori}}</td> -->
                        <td class="text-center">{{$detail_estimasi->indeks->bobot_indeks}} x {{$detail_estimasi->indeks->kategori_indeks->bobot_kategori}}</td>
                        @php 
                          $jml = $detail_estimasi->indeks->bobot_indeks * $detail_estimasi->indeks->kategori_indeks->bobot_kategori
                        @endphp
                        <td>{{$jml}}</td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Indeks Klasifikasi</th>
                    <td></td>
                    <th>{{$ik}}</th>
                </tr>
                </tfoot>
              </table>
            </div>  
           
            <div class="mt-3 mb-2">
              <p>Indeks Terintegrasi =  Indeks Fungsi x Indeks Waktu x Indeks Klasifikasi</p>
                <p class="indent_it"> =
                  @foreach($detail_estimasis as $detail_estimasi)
                    @if ($detail_estimasi->indeks->kategori_indeks_id == Null)
                        {{$detail_estimasi->indeks->bobot_indeks}} x
                    @endif
                   @endforeach
                  {{$ik}}  
                </p>
                <p class="indent_it"> = {{$it}}</p>
            </div>
          </div>

          <div class="row shadow-sm p-3 mb-2 bg-body round">
            <h5 class="hitung">Total Biaya Retribusi</h5>
            <div class="mt-2">
                <p>Bangunan Gedung = L x It x Indeks Gedung x HSbg</p>
                @foreach($estimasis as $estimasi)
                <p class="indent_gedung">
                  = {{$estimasi->luas_bangunan}} x {{$it}} x {{$estimasi->gedungs->bobot_indeks}} x {{number_format($estimasi->gedungs->biaya,0)}}
                </p>
                <p class="indent_gedung"> = Rp {{number_format($bangunan_gedung,0)}} </p>
                <p> Total Retribusi = Biaya Bangunan + Biaya Prasarana</p>
                <p class="indent_total"> = Rp {{number_format($bangunan_gedung,0)}} + Rp {{number_format($total_sarana,0)}}</p>
                <p class="indent_total"> = <b> Rp {{number_format($estimasi->total_biaya,0)}} </b> </p>
                @endforeach
            </div>
          </div>
        </div>
    </div>
</div>

<header id="total" class="fixed-bottom d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-center">
      <nav id="navbar" class="navbar">
        @foreach($estimasis as $estimasi)
          <h4 class="hitung"> TOTAL = Rp {{number_format($estimasi->total_biaya,0)}}</h4>
        @endforeach
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

@endsection