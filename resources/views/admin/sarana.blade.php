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
                    <div class="d-flex justify-content-between">
                      <form action="/dashboard/sarana">
                          <div class="input-group">
                              <input class="form-control border-end-0 border" type="search" placeholder="Search" id="example-search-input" aria-describedby="button-addon2" name="search" value="{{request('search')}}">
                              <span class="input-group-append">
                                  <button class="btn btn-outline-secondary border-start-0 border-bottom-0 border" type="submit" >
                                      <i class="fa fa-search"></i>
                                  </button>
                              </span>
                          </div>
                      </form>
                      <button type="button" class="btn btn-primary mt-2 mb-3" data-toggle="modal" data-target="#ModalSarana">
                          Tambahkan Data Sarana
                      </button>
                    </div>

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
                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ @old('nama') }}" id="nama" name="nama" >
                                  @error('nama')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group mt-2">
                                  <label for="kategori">Kategori</label>
                                  <select class="form-control @error('kategori') is-invalid @enderror" value="{{ @old('kategori') }}" 
                                  aria-label=".form-select-sm example" name="kategori" id="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Pembatas">Konstruksi Pembatas (m)</option>
                                    <option value="Penanda">Konstruksi Penanda Masuk (unit)</option>
                                    <option value="Perkerasan">Konstruksi Perkerasan (m<sup>2</sup>)</option>
                                    <option value="Penghubung">Konstruksi Penghubung (m<sup>2</sup>)</option>
                                    <option value="Kolam">Konstruksi Kolam (m<sup>2</sup>)</option>
                                    <option value="Menara">Konstruksi Menara (unit)</option>
                                    <option value="Monumen">Konstruksi Monumen (unit)</option>
                                    <option value="Instalasi">Konstruksi Instalasi/Gardu (unit)</option>
                                    <option value="Reklame">Konstruksi Reklame (unit)</option>
                                    <option value="Tambahan">Lain-Lain</option>
                                  </select>
                                  @error('kategori')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                  @enderror
                                </div>
                                <div class="form-group mt-2">
                                  <label for="biaya">Biaya</label>
                                  <input type="text" class="form-control @error('biaya') is-invalid @enderror" value="{{ @old('biaya') }}" id="biaya" name="biaya" >
                                  @error('biaya')
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
                      <table class="table table-striped table-bordered zero-configuration text-center">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Biaya (Rp)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($saranas as $sarana)
                          <tr> 
                            <td>{{$loop->iteration}}</td>
                            <td class="text-left">{{$sarana->nama}}</td>
                            <td>{{$sarana->kategori}}</td>
                            <td class="text-right">{{number_format($sarana->biaya,0)}}</td>
                            <td>
                            @if ($sarana->status == 1)
                              <a href="{{ route('edit_statusSarana', $sarana->id) }}" class="label label-success"
                                  data-toggle="modal" data-target="#editStatus_{{$sarana->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Nonaktifkan">
                                  Aktif
                              </a> 
                            @else
                              <a href="{{ route('edit_statusSarana', $sarana->id) }}" class="label label-danger"
                                  data-toggle="modal" data-target="#editStatus_{{$sarana->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Aktifkan">
                                  Nonaktif
                              </a>
                            @endif
                              <div class="modal fade" id="editStatus_{{$sarana->id}}">
                                <div class="modal-dialog modal-dialog-centered">
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
                            <a href="dashboard/sarana/{{$sarana->id}}" class="label label-secondary m-1" data-toggle="modal" data-target="#edit_{{$sarana->id}}" 
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
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
                                        <div class="form-group text-left">
                                              <label for="id">ID</label>
                                              <input type="text" class="form-control" id="id" value="{{$sarana->id}}" name="id" readonly>
                                            </div>
                                        <div class="form-group text-left mt-2">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{$sarana->nama}}" name="nama" >
                                            @error('nama')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @enderror
                                          </div>
                                        <div class="form-group text-left mt-2">
                                          <label for="kategori">Kategori</label>
                                          <select class="form-control edit_select @error('kategori') is-invalid @enderror"
                                            aria-label=".form-select-sm example" name="kategori" value="{{$sarana->kategori}}">
                                              <option value="Pembatas" {{ $sarana->kategori == "Pembatas" ? 'selected' : '' }} > Konstruksi Pembatas (m)</option>
                                              <option value="Penanda" {{ $sarana->kategori == "Penanda" ? 'selected' : '' }}>Konstruksi Penanda Masuk (unit)</option>
                                              <option value="Perkerasan" {{ $sarana->kategori == "Perkerasan" ? 'selected' : '' }}>Konstruksi Perkerasan (m<sup>2</sup>)</option>
                                              <option value="Penghubung"{{ $sarana->kategori == "Penghubung" ? 'selected' : '' }}>Konstruksi Penghubung (m<sup>2</sup>)</option>
                                              <option value="Kolam" {{ $sarana->kategori == "Kolam" ? 'selected' : '' }}>Konstruksi Kolam (m<sup>2</sup>)</option>
                                              <option value="Menara" {{ $sarana->kategori == "Menara" ? 'selected' : '' }}>Konstruksi Menara (unit)</option>
                                              <option value="Monumen" {{ $sarana->kategori == "Monumen" ? 'selected' : '' }}>Konstruksi Monumen (unit)</option>
                                              <option value="Instalasi" {{ $sarana->kategori == "Instalasi" ? 'selected' : '' }}>Konstruksi Instalasi/Gardu (unit)</option>
                                              <option value="Reklame" {{ $sarana->kategori == "Reklame" ? 'selected' : '' }}>Konstruksi Reklame (unit)</option>
                                              <option value="Tambahan" {{ $sarana->kategori == "Tambahan" ? 'selected' : '' }}>Lain-Lain</option>
                                          </select>
                                          @error('kategori')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                          @enderror
                                        </div>
                                        <div class="form-group text-left mt-2">
                                          <label for="biaya">Biaya (Rp)</label>
                                          <input type="text" class="form-control @error('biaya') is-invalid @enderror" id="biaya" value="{{$sarana->biaya}}" name="biaya">
                                          @error('biaya')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                          @enderror
                                        </div>
                                        <div class="form-group text-left mt-2">
                                          <label for="keterangan">Keterangan</label>
                                          <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{$sarana->keterangan}}" name="keterangan">
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
                              <a href="dashboard/sarana/{{$sarana->id}}" class="label label-primary" data-toggle="modal" 
                                    data-target="#detail_{{$sarana->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                    <i class="fa fa-search"></i>
                                  </a>
                                <!-- Modal -->
                                  <div class="modal fade" id="detail_{{$sarana->id}}">
                                      <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                      
                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                          <h4 class="modal-title">Keterangan</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          
                                          <!-- Modal body -->
                                          <div class="modal-body">
                                          <p>{{$sarana->keterangan}}</p>
                                          </div>
                                          <!-- Modal footer -->
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
                        {{$saranas->links()}}
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