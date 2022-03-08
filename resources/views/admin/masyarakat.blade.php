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
                                    <th >Nama</th>
                                    <th >Email</th>
                                    <th >Telp</th>
                                    <th >NIK</th>
                                    <th >Jumlah Estimasi</th>
                                    <th >Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masyarakats as $masyarakat)
                                  <tr> 
                                    <td>{{$loop->iteration}}</td>                                 
                                    <td class="text-left">{{$masyarakat->nama}}</td>
                                    <td class="text-left">{{$masyarakat->email}}</td>
                                    <td>{{$masyarakat->telp}}</td>
                                    <td>{{$masyarakat->no_ktp}}</td>
                                    <td>{{$total_estimasi[$masyarakat->id]}}</td>
                                    <td>
                                        @if ($masyarakat->status == 1)
                                        <a href="{{ route('edit_statusUser', $masyarakat->id) }}" class="label label-success"
                                            data-toggle="modal" data-target="#editStatus_{{$masyarakat->id}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Nonaktifkan">
                                            Aktif
                                        </a> 
                                        @else
                                        <a href="{{ route('edit_statusUser', $masyarakat->id) }}" class="label label-danger"
                                            data-toggle="modal" data-target="#editStatus_{{$masyarakat->id}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Aktifkan">
                                            Nonaktif
                                        </a>
                                        @endif
                                        <div class="modal fade" id="editStatus_{{$masyarakat->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        @if($masyarakat->status == 1)
                                                        <h4 class="modal-title">Nonaktifkan Akun</h4>
                                                        @else
                                                        <h4 class="modal-title">Aktifkan Akun</h4>
                                                        @endif
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="/dashboard/masyarakat/{{$masyarakat->id}}">
                                                        @method('put')
                                                        @csrf
                                                        <div class="form-group"> 
                                                            @if($masyarakat->status == 1)
                                                            <p>Saat ini akun user sedang dalam keadaan Aktif. Apakah Anda yakin untuk menonaktifkan akun ini?</p>
                                                            @else
                                                            <p>Saat ini akun user sedang dalam keadaan Nonaktif. Apakah Anda yakin untuk mengaktifkan akun ini?</p>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary" >Ya </button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
            $('[data-bs-toggle="tooltip"]').tooltip();   
        });
</script>
@endsection