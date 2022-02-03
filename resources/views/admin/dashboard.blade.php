@extends('admin.mainlayout')

@section('title','Dashboard | Admin IMB')

@section('container')
<!--**********************************
            Content body start
        ***********************************-->

            <div class="container-fluid mt-3">
                <div class="row">
                    <a href="/dashboard/estimasi" class="col-lg-6 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Estimasi Retribusi</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_estimasi}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-calculator"></i></span>
                            </div>
                        </div>
                    </a>
                    <a href="/dashboard/masyarakat" class="col-lg-6 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">User</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_regis}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    <a href="/dashboard/gedung" class="col-lg-6 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Gedung</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$jumlah_gedung}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-building"></i></span>
                            </div>
                        </div>
                    <a href="/dashboard/sarana" class="col-lg-6 col-sm-6">
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

                
            <!-- #/ container -->
        <!--**********************************
            Content body end
        ***********************************-->
@endsection