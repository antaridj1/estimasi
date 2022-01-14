@extends('layouts.main')

@section('title','Riwayat | Estimasi Retribusi IMB')

@section('container')

<div class="container container_margin">
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <div class="accordion" id="accordionExample">
                @foreach($estimasis as $estimasi)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{$estimasi->id}}">
                    <button class="accordion-button"  data-bs-toggle="collapse" data-bs-target="#collapse_{{$estimasi->id}}" aria-expanded="true" aria-controls="collapse_{{$estimasi->id}}">
                        {{$estimasi->total_biaya}}
                    </button>
                    </h2>
                    <div id="collapse_{{$estimasi->id}}" class="accordion-collapse collapse show" aria-labelledby="heading_{{$estimasi->id}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
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

                            <h5 class="hitung">Sarana</h5>
                            <table class="table table-borderless">
                         
                            @foreach($estimasi->detailsarana as $detail)
                           
                                <tr>
                                    <td>{{$detail->sarana->nama}}</td>
                                </tr>
                           
                            @endforeach 
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection