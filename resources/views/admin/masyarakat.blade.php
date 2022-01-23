@extends('admin.mainlayout')

@section('title','Masyarakat| Admin IMB')

@section('container')



  <!-- Modal end -->


<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Masyarakat</a></li>
        </ol>
    </div>
</div>
            <!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Masyarakat</h4>
                    <div class="d-flex justify-content-between">
                      <form action="/dashboard/masyarakat">
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
                                    <th >ID</th>
                                    <th >Nama</th>
                                    <th >Email</th>
                                    <th >Telp</th>
                                    <th >NIK</th>
                                    <th >Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masyarakats as $masyarakat)
                                  <tr> 
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$masyarakat->id}}</td>
                                    <td>{{$masyarakat->nama}}</td>
                                    <td>{{$masyarakat->email}}</td>
                                    <td>{{$masyarakat->telp}}</td>
                                    <td>{{$masyarakat->no_ktp}}</td>
                                    @if($masyarakat->status == 1)
                                    <td>Aktif</td>
                                    @else
                                    <td>Nonaktif</td>
                                    @endif
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{$masyarakats->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection