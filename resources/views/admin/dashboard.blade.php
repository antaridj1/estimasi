@extends('admin.mainlayout')

@section('title','Dashboard | Admin IMB')

@section('container')
<!--**********************************
            Content body start
        ***********************************-->

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Estimasi Retribusi</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_estimasi}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-calculator"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Registrasi</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_regis}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Gedung</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_gedung}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-building"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Sarana Prasarana </h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_sarana}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-road"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kelola Master</h4>
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                        
                                            <tbody>
                                                <tr>
                                                    <td>Indeks</td>
                                                    <td><a href="/indeks" type="button" class="btn mb-1 btn-primary btn-sm">Kelola Data</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Gedung</td>
                                                    <td><a href="/gedung" type="button" class="btn mb-1 btn-primary btn-sm">Kelola Data</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Sarana</td>
                                                    <td><a href="/sarana" type="button" class="btn mb-1 btn-primary btn-sm">Kelola Data</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Masyarakat</td>
                                                    <td><a href="/gedung" type="button" class="btn mb-1 btn-primary btn-sm">Kelola Data</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        <!--**********************************
            Content body end
        ***********************************-->
@endsection