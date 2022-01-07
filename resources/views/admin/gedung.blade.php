@extends('admin.mainlayout')

@section('title','Gedung | Admin IMB')

@section('container')



  <!-- Modal end -->


<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Gedung</a></li>
        </ol>
    </div>
</div>
            <!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Gedung</h4>
                    <button type="button" class="btn btn-primary mt-2 mb-3" data-toggle="modal" data-target="#ModalGedung">
                      Tambahkan Data gedung
                    </button>

                    <!-- The Modal -->
                    <div class="modal fade" id="ModalGedung">
                      <div class="modal-dialog">
                        <div class="modal-content">
                        
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form method="post" action="{{route('input_gedung')}}">
                                @csrf
                                <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ @old('nama') }}" id="nama" placeholder="Nama" name="nama" >
                                  @error('nama')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="bobot_indeks">Bobot</label>
                                  <input type="text" class="form-control @error('bobot_indeks') is-invalid @enderror" value="{{ @old('bobot_indeks') }}" id="bobot_indeks" placeholder="Bobot Indeks" name="bobot_indeks" >
                                  @error('bobot_indeks')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group mt-2">
                                  <label for="biaya">Biaya</label>
                                  <input type="text" class="form-control @error('biaya') is-invalid @enderror" value="{{ @old('biaya') }}" id="biaya" placeholder="Biaya" name="biaya" >
                                  @error('biaya')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group mt-2">
                                  <label for="keterangan">Keterangan</label>
                                  <input type="text" class="form-control @error('keterangan') is-invalid @enderror" value="{{ @old('keterangan') }}" id="keterangan" placeholder="Keterangan" name="keterangan">
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
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th >No.</th>
                                    <th >ID</th>
                                    <th >Nama</th>
                                    <th >Bobot</th>
                                    <th >Biaya (Rp)</th>
                                    <th >Ket</th>
                                    <th >Status</th>
                                    <th >Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gedungs as $gedung)
                                  <tr> 
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$gedung->id}}</td>
                                    <td>{{$gedung->nama}}</td>
                                    <td>{{$gedung->bobot_indeks}}</td>
                                    <td>{{number_format($gedung->biaya,0)}}</td>
                                    <td>{{$gedung->keterangan}}</td>
                                    <td>
                                    @if ($gedung->status == 1)
                                      <a href="{{ route('edit_statusGedung', $gedung->id) }}" class="label label-pill label-success"
                                          data-toggle="modal" data-target="#editStatus_{{$gedung->id}}">
                                          Aktif
                                      </a> 
                                    @else
                                      <a href="{{ route('edit_statusGedung', $gedung->id) }}" class="label label-pill label-danger"
                                          data-toggle="modal" data-target="#editStatus_{{$gedung->id}}">
                                          Nonaktif
                                      </a>
                                    @endif
                                      <div class="modal fade" id="editStatus_{{$gedung->id}}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              @if($gedung->status == 1)
                                                <h4 class="modal-title">Nonaktifkan Data {{$gedung->nama}}</h4>
                                              @else
                                                <h4 class="modal-title">Aktifkan Data {{$gedung->nama}}</h4>
                                              @endif
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                              <form method="post" action="gedung/{{$gedung->id}}">
                                                @method('put')
                                                @csrf
                                                <div class="form-group"> 
                                                  @if($gedung->status == 1)
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
                                    <a href="dashboard/gedung/{{$gedung->id}}" class="btn btn-primary" data-toggle="modal" 
                                        data-target="#edit_{{$gedung->id}}">
                                        Edit
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="edit_{{$gedung->id}}">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                        
                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                            <h4 class="modal-title">Edit Data</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          
                                          <!-- Modal body -->
                                          <div class="modal-body">
                                            <form method="post" action="{{route('edit_gedung')}}">
                                            @method('patch')
                                            @csrf
                                                <div class="form-group">
                                                      <label for="id">ID</label>
                                                      <input type="text" class="form-control" id="id" value="{{$gedung->id}}" name="id" readonly>
                                                    </div>
                                                <div class="form-group mt-2">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{$gedung->nama}}" name="nama" >
                                                    @error('nama')
                                                      <div class="invalid-feedback">
                                                        {{$message}}
                                                      </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                  <label for="bobot_indeks">Bobot</label>
                                                  <input type="text" class="form-control @error('bobot_indeks') is-invalid @enderror" id="bobot_indeks" value="{{$gedung->bobot_indeks}}" name="bobot_indeks" >
                                                  @error('bobot_indeks')
                                                    <div class="invalid-feedback">
                                                      {{$message}}
                                                    </div>
                                                  @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label for="biaya">Biaya (Rp)</label>
                                                  <input type="text" class="form-control @error('biaya') is-invalid @enderror" id="biaya" value="{{$gedung->biaya}}" name="biaya">
                                                  @error('biaya')
                                                    <div class="invalid-feedback">
                                                      {{$message}}
                                                    </div>
                                                  @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label for="keterangan">Keterangan</label>
                                                  <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{$gedung->keterangan}}" name="keterangan">
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
                                          <!-- Modal footer -->
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