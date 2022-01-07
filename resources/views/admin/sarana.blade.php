@extends('admin.mainlayout')

@section('title','Sarana | Admin IMB')

@section('container')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Sarana</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Sarana</h4>
                    <button type="button" class="btn btn-primary mt-2 mb-3" data-toggle="modal" data-target="#ModalSarana">
                        Tambahkan Data Sarana
                      </button>

                      <!-- The Modal -->
                    <div class="modal fade" id="ModalSarana">
                      <div class="modal-dialog">
                        <div class="modal-content">
                        
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form method="post" action="{{route('input_sarana')}}">
                                @csrf
                                <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" >
                                </div>
                                <div class="form-group">
                                  <label for="kategori">Kategori</label>
                                  <input type="text" class="form-control" id="kategori" placeholder="kategori" name="kategori" >
                                </div>
                                <div class="form-group mt-2">
                                  <label for="biaya">Biaya</label>
                                  <input type="text" class="form-control " id="biaya" placeholder="biaya" name="biaya" >
                                </div>
                                <div class="form-group mt-2">
                                  <label for="keterangan">Keterangan</label>
                                  <input type="text" class="form-control" id="keterangan" placeholder="keterangan" name="keterangan">
                                </div>
                                <div class="form-group mt-4"> 
                                    <button type="submit" class="btn btn-primary" >Simpan </button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Biaya (Rp)</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($saranas as $sarana)
                          <tr> 
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sarana->id}}</td>
                            <td>{{$sarana->nama}}</td>
                            <td>{{$sarana->kategori}}</td>
                            <td>{{number_format($sarana->biaya,0)}}</td>
                            <td>{{$sarana->keterangan}}</td>
                            <td>
                            @if ($sarana->status == 1)
                              <a href="{{ route('edit_statusSarana', $sarana->id) }}" class="label label-pill label-success"
                                  data-toggle="modal" data-target="#editStatus_{{$sarana->id}}">
                                  Aktif
                              </a> 
                            @else
                              <a href="{{ route('edit_statusSarana', $sarana->id) }}" class="label label-pill label-danger"
                                  data-toggle="modal" data-target="#editStatus_{{$sarana->id}}">
                                  Nonaktif
                              </a>
                            @endif
                              <div class="modal fade" id="editStatus_{{$sarana->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      @if($sarana->status == 1)
                                        <h4 class="modal-title">Nonaktifkan Data {{$sarana->nama}}</h4>
                                      @else
                                        <h4 class="modal-title">Aktifkan Data {{$sarana->nama}}</h4>
                                      @endif
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="sarana/{{$sarana->id}}">
                                        @method('put')
                                        @csrf
                                        <div class="form-group"> 
                                          @if($sarana->status == 1)
                                            <p>Saat ini data Anda sedang dalam keadaan Aktif. Apakah Anda yakin untuk menonaktifkan data ini?</p>
                                          @else
                                            <p>Saat ini data Anda sedang dalam keadaan Nonaktif. Apakah Anda yakin untuk mengaktifkan data ini?</p>
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
                            <td>
                            <a href="dashboard/sarana/{{$sarana->id}}" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{$sarana->id}}">
                                Edit
                              </a>

                            <!-- The Modal -->
                            <div class="modal fade" id="edit_{{$sarana->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <form method="post" action="{{route('edit_sarana')}}">
                                    @method('patch')
                                    @csrf
                                        <div class="form-group">
                                              <label for="id">ID</label>
                                              <input type="text" class="form-control" id="id" value="{{$sarana->id}}" name="id" readonly>
                                            </div>
                                        <div class="form-group mt-2">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control " id="nama" value="{{$sarana->nama}}" name="nama" >
                                        </div>
                                        <div class="form-group">
                                          <label for="kategori">Kategori</label>
                                          <input type="text" class="form-control" id="kategori" value="{{$sarana->kategori}}" name="kategori" >
                                        </div>
                                        <div class="form-group mt-2">
                                          <label for="biaya">Biaya (Rp)</label>
                                          <input type="text" class="form-control" id="biaya" value="{{$sarana->biaya}}" name="biaya">
                                        </div>
                                        <div class="form-group mt-2">
                                          <label for="keterangan">Keterangan</label>
                                          <input type="text" class="form-control" id="keterangan" value="{{$sarana->keterangan}}" name="keterangan">
                                        </div>
                                        <div class="form-group mt-4"> 
                                            <button type="submit" class="btn btn-primary" >Simpan </button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
 @endsection