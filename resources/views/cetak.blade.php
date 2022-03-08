<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cetak PDF | Estimasi Retribusi IMB</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-9"> 
               <div class="row p-3 bg-body round">                  
                    <div class="row ">
                        <h5 class="hitung">Data Dasar</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: {{$estimasi->created_at->format('d-m-Y')}}</td>
                                </tr>
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
                    </div>
                    <div class="row">
                        <h5 class="hitung">Sarana</h5>
                        <table class="table table-borderless">
                            @php
                                $totalsarana = 0;
                            @endphp
                            @foreach($estimasi->detailsarana as $detail)
                    
                            <tr>
                                <td>{{$detail->sarana->nama}}</td>
                                <td>{{$detail->jumlah_sarana}} x {{number_format($detail->sarana->biaya,0)}}</td>
                                <td>{{number_format($detail->jumlah_sarana*$detail->sarana->biaya,0)}}</td>
                            </tr>
                            @php
                                $totalsarana += $detail->jumlah_sarana * $detail->sarana->biaya;
                            @endphp
                            @endforeach 
                            <tfoot class="border-top">
                                <tr>
                                <th scope="col">Total</th>
                                <th scope="col"> </th>
                                <th scope="col">Rp {{number_format($totalsarana,0)}}</th>
                                </tr> 
                            </tfoot>
                        </table>
                    </div>

                    <div class="row ">
                        <h5 class="hitung">Indeks Parameter</h5>
                        <div class="mt-2">
                            <label class="mb-2"><b>Fungsi</b></label>
                            @foreach($estimasi->detail_estimasi as $detail)
                                @if ($detail->indeks->parameter == "fungsi")
                                <p>{{$detail->indeks->tingkatan}} ( Indeks : {{$detail->indeks->bobot_indeks}} )</p>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <label class="mb-2"><b>Waktu</b></label>
                            @foreach($estimasi->detail_estimasi as $detail)
                            @if ($detail->indeks->parameter == "waktu")
                                <p>{{$detail->indeks->tingkatan}} ( Indeks : {{$detail->indeks->bobot_indeks}} )</p>
                            @endif
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <table class="table">
                                <tr>
                                    <th class="hitung">Klasifikasi</th>
                                    <th class="text-center">Indeks x Bobot Kategori</th>
                                    <th>Total</th>
                                </tr>
                                @php
                                    $jml = 0;
                                    $ik = 0;
                                @endphp
                                @foreach($estimasi->detail_estimasi as $detail)
                                @if ($detail->indeks->kategori_indeks_id!==Null)
                                <tr>
                                    <td>{{$detail->indeks->kategori_indeks->nama}} : {{$detail->indeks->tingkatan}}</td>
                                    <td class="text-center">{{$detail->indeks->bobot_indeks}} x {{$detail->indeks->kategori_indeks->bobot_kategori}}</td>
                                        @php 
                                        $jml = $detail->indeks->bobot_indeks * $detail->indeks->kategori_indeks->bobot_kategori
                                        @endphp
                                    <td>{{$jml}}</td>
                                </tr>
                                    @php
                                        $ik += $detail->indeks->bobot_indeks * $detail->indeks->kategori_indeks->bobot_kategori;
                                    @endphp
                                @endif
                                @endforeach
                                <tr>
                                    <th class="hitung">Indeks Klasifikasi</th>
                                    <td></td>
                                    
                                    <th>{{$ik}}</th>
                                </tr>     
                            </table>
                        </div>  
                    <div class="mt-1 mb-2">
                        @php
                            $tes = 1;
                        @endphp
                        <p> Indeks Terintegrasi = Indeks Fungsi x Indeks Waktu x Indeks Klasifikasi</p>
                        <p class="tab_it">
                            = @foreach($estimasi->detail_estimasi as $detail)
                                @if ($detail->indeks->kategori_indeks_id == Null)
                                    {{$detail->indeks->bobot_indeks}} x
                                    @php
                                        $tes = $tes * $detail->indeks->bobot_indeks;
                                    @endphp
                                @endif
                            @endforeach
                            
                            @php
                                $it = 1;
                            @endphp
                            @php
                                $it = $tes*$ik;
                            @endphp
                            {{$ik}}
                        </p>
                        <p class="tab_it"> = {{$it}}</p>
                    </div>
                </div>

                    <div class="row ">
                        <h5 class="hitung">Total Biaya Retribusi</h5>
                        <div class="mt-2">
                            <p>Total Retribusi = L x It x Indeks Gedung x HSbg + Biaya Sarana</p>
                            <p class="tab_total">
                                =  {{$estimasi->luas_bangunan}} x {{$it}} x {{$estimasi->gedungs->bobot_indeks}} 
                                x {{number_format($estimasi->gedungs->biaya,0)}} + Rp{{number_format($totalsarana,0)}}
                            </p>
                            <p class="tab_total"> = Rp {{number_format($estimasi->total_biaya,0)}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{asset('admin/plugins/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('admin/plugins/toastr/js/toastr.init.js')}}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
