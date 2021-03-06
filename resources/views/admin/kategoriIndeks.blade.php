@extends('admin.mainlayout')

@section('title','Kategori Indeks | Admin IMB')

@section('container')


  <!-- Modal end -->

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Kategori Indeks</a></li>
        </ol>
    </div>
</div>
            <!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Kategori Indeks</h4>
                    <div class="d-flex justify-content-between">
                      <form action="/dashboard/kategoriIndeks">
                          <div class="input-group">
                              <input class="form-control border-end-0 border" type="search" placeholder="Search" id="example-search-input" aria-describedby="button-addon2" name="search" value="{{request('search')}}">
                              <span class="input-group-append">
                                  <button class="btn btn-outline-secondary border-start-0 border-bottom-0 border" type="submit" >
                                      <i class="fa fa-search"></i>
                                  </button>
                              </span>
                          </div>
                      </form>
                      <button type="button" class="btn btn-primary mt-2 mb-3" data-toggle="modal" data-target="#ModalIndeks">
                          Tambahkan Kategori
                      </button>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="ModalIndeks">
                      <div class="modal-dialog">
                        <div class="modal-content">
                        
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="modal-body text-left">
                            <form method="post" action="{{route('input_kategoriIndeks')}}">
                                @csrf
                                <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ @old('nama') }}" id="nama" name="nama" >
                                  @error('nama')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group mt-2">
                                  <label for="bobot_kategori">Bobot</label>
                                  <input type="text" class="form-control @error('bobot_kategori') is-invalid @enderror" value="{{ @old('bobot_kategori') }}" id="bobot_kategori" name="bobot_kategori">
                                  @error('bobot_kategori')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group mt-2">
                                  <label for="keterangan">Keterangan</label>
                                  <input type="text" class="form-control @error('keterangan') is-invalid @enderror" value="{{ @old('keterangan') }}" id="keterangan" name="keterangan">
                                  @error('keterangan')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
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
                      <table class="table table-striped table-bordered text-center">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Bobot</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($kategoriIndeks as $kategori)
                            <tr> 
                              <td>{{$loop->iteration}}</td>
                              <td class="text-left">{{$kategori->nama}}</td>
                              <td>{{$kategori->bobot_kategori}}</td>
                              <td>
                                @if ($kategori->status == 1)
                                  <a href="{{ route('edit_statusKategori', $kategori->id) }}" class="label label-success"
                                      data-toggle="modal" data-target="#editStatus_{{$kategori->id}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Nonaktifkan">
                                      Aktif
                                  </a> 
                                @else
                                  <a href="{{ route('edit_statusKategori', $kategori->id) }}" class="label label-danger"
                                      data-toggle="modal" data-target="#editStatus_{{$kategori->id}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Aktifkan">
                                      Nonaktif
                                  </a>
                                @endif
                                <div class="modal fade" id="editStatus_{{$kategori->id}}">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        @if($kategori->status == 1)
                                          <h4 class="modal-title">Nonaktifkan Data {{$kategori->nama}}</h4>
                                        @else
                                          <h4 class="modal-title">Aktifkan Data {{$kategori->nama}}</h4>
                                        @endif
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="post" action="kategoriIndeks/{{$kategori->id}}">
                                          @method('put')
                                          @csrf
                                          <div class="form-group"> 
                                            @if($kategori->status == 1)
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
                                <a href="dashboard/kategoriIndeks/{{$kategori->id}}" class="label label-secondary m-1" 
                                data-toggle="modal" data-target="#edit_{{$kategori->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                                </a>
                                <!-- The Modal -->
                                <div class="modal fade" id="edit_{{$kategori->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Edit Data</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <!-- Modal body -->
                                      <div class="modal-body text-left">
                                        <form method="post" action="{{route('edit_kategoriIndeks')}}">
                                        @method('patch')
                                        @csrf
                                            <div class="form-group">
                                              <label for="id">ID</label>
                                              <input type="text" class="form-control" name="id" value="{{$kategori->id}}" readonly>
                                            </div>
                                            <div class="form-group">
                                              <label for="nama">Nama</label>
                                              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{$kategori->nama}}" name="nama" >
                                              @error('nama')
                                                <div class="invalid-feedback">
                                                  {{$message}}
                                                </div>
                                              @enderror
                                            </div>
                                            <div class="form-group mt-2">
                                              <label for="bobot_kategori">Bobot</label>
                                              <input type="text" class="form-control @error('bobot_kategori') is-invalid @enderror" id="bobot_kategori" value="{{$kategori->bobot_kategori}}" name="bobot_kategori">
                                              @error('bobot_kategori')
                                                <div class="invalid-feedback">
                                                  {{$message}}
                                                </div>
                                              @enderror
                                            </div>
                                            <div class="form-group mt-2">
                                              <label for="keterangan">Keterangan</label>
                                              <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{$kategori->keterangan}}" name="keterangan">
                                              @error('keterangan')
                                                <div class="invalid-feedback">
                                                  {{$message}}
                                                </div>
                                              @enderror
                                            </div>
                                            <div class="form-group mt-4 text-left"> 
                                                <button type="submit" class="btn btn-primary" >Simpan </button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <a href="dashboard/kategoriIndeks/{{$kategori->id}}" class="label label-primary" 
                                data-toggle="modal" data-target="#detail_{{$kategori->id}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                <i class="fa fa-search"></i>
                                </a>
                                <!-- The Modal -->
                                <div class="modal fade" id="detail_{{$kategori->id}}">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Keterangan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                        <p>{{$kategori->keterangan}}</p>
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
                        {{$kategoriIndeks->links()}}
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