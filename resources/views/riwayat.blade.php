@extends('layouts.main')

@section('title','Riwayat | Estimasi Retribusi IMB')

@section('container')

<div class="container container_margin">
    <div class="row justify-content-center">
        <div class="col-sm-9"> 
            @foreach($estimasis as $estimasi)
               <div class="row">
                    <a href="riwayat/{{$estimasi->id}}" data-toggle="modal" 
                            data-target="#detail_{{$estimasi->id}}"> 
                    
                        <div class="shadow-sm p-3 mb-2 round" id="riwayat"> 
                            <div class="d-flex justify-content-between">
                                <p class="item">ID : {{$estimasi->id}}</p>
                                <small class="date">{{ $estimasi->created_at->diffForHumans()}}</small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="item">Total : <b> Rp {{number_format($estimasi->total_biaya,0)}}</b></h5> 
                                <i class="bi bi-chevron-right item"></i>
                            </div>
                        </div>
                    </a>
                
                    
                    <div class="modal fade" id="detail_{{$estimasi->id}}">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detail Estimasi</h4>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    
                                </div>
                                <div class="modal-body">
                                <div class="row border-grey p-3 m-2 bg-body round">
                                    <h5 class="hitung">Data Dasar</h5>
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
                                </div>
                                <div class="row border-grey p-3 m-2 bg-body round">
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
                                            <th scope="col">{{number_format($totalsarana,0)}}</th>
                                            </tr> 
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="row border-grey p-3 m-2 bg-body round">
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
                                        <table class="table mb-0">
                                            <label class="mb-2"><b>Klasifikasi</b></label>
                                            @foreach($estimasi->detail_estimasi as $detail)
                                            @if ($detail->indeks->kategori_indeks_id!==Null)
                                            <tr>
                                                <td>{{$detail->indeks->kategori_indeks->nama}} : {{$detail->indeks->tingkatan}}</td>
                                                <td>Indeks : {{$detail->indeks->bobot_indeks}}</td>
                                                <td>Bobot Kategori : {{$detail->indeks->kategori_indeks->bobot_kategori}}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        </table>
                                    </div>  
                                    <div class="mt-4">
                                        @php
                                            $ik = 0;
                                        @endphp
                                        <p>Indeks Klasifikasi = 
                                            @foreach($estimasi->detail_estimasi as $detail)
                                                @if ($detail->indeks->kategori_indeks_id!==Null)
                                                    @if(!$loop->last)
                                                        ({{$detail->indeks->bobot_indeks}} x {{$detail->indeks->kategori_indeks->bobot_kategori}}) +
                                                    @else
                                                        ({{$detail->indeks->bobot_indeks}} x {{$detail->indeks->kategori_indeks->bobot_kategori}})
                                                    @endif
                                                    @php
                                                        $ik += $detail->indeks->bobot_indeks * $detail->indeks->kategori_indeks->bobot_kategori;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            = {{$ik}}
                                        </p>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        @php
                                            $tes = 1;
                                        @endphp
                                        <p>Indeks Terintegrasi =  
                                            @foreach($estimasi->detail_estimasi as $detail)
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

                                            {{$ik}} = {{$it}}
                                         </p>
                                         
                                    </div>
                                </div>
                                    <div class="row border-grey p-3 m-2 bg-body round">
                                        <h5 class="hitung">Total Biaya Retribusi</h5>
                                        <div class="mt-2">
                                            <p>Total Retribusi = L x It x Indeks Gedung x HSbg + Biaya Sarana</p>
                                            <p>
                                               =  {{$estimasi->luas_bangunan}} x {{$it}} x {{$estimasi->gedungs->bobot_indeks}} 
                                               x {{number_format($estimasi->gedungs->biaya,0)}} + Rp{{number_format($totalsarana,0)}}
                                            </p>
                                            <p> = Rp {{number_format($estimasi->total_biaya,0)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{$estimasis->links()}}
            </div>
        </div>
    </div>
</div>


@endsection