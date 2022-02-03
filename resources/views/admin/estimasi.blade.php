@extends('admin.mainlayout')

@section('title','Estimasi | Admin IMB')

@section('container')



  <!-- Modal end -->


<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Estimasi</a></li>
        </ol>
    </div>
</div>
            <!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Estimasi</h4>
                    <div class="d-flex justify-content-between">
                      <form action="/dashboard/estimasi">
                          <div class="input-group">
                              <input class="form-control border-end-0 border" type="search" placeholder="Search" id="example-search-input" aria-describedby="button-addon2" name="search" value="{{request('search')}}">
                              <span class="input-group-append">
                                  <button class="btn btn-outline-secondary border-start-0 border-bottom-0 border" type="submit" >
                                      <i class="fa fa-search"></i>
                                  </button>
                              </span>
                          </div>
                      </form>
                    </div>
                   

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered zero-configuration text-center">
                            <thead>
                                <tr>
                                    <th >No.</th>
                                    <th >Tanggal & Waktu</th>
                                    <th >Email Masyarakat</th>
                                    <th >Status Gedung</th>
                                    <th >Total (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estimasis as $estimasi)
                                  <tr> 
                                    <td>{{$loop->iteration}}</td>                                 
                                    <td>{{$estimasi->created_at}}</td>
                                    <td class="text-left">{{$estimasi->masyarakat->email}}</td>
                                    <td>{{$estimasi->gedungs->nama}}</td>
                                    <td class="text-right">{{number_format($estimasi->total_biaya,0)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{$estimasis->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection