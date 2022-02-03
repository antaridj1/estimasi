
@extends('layouts.main')

@section('title','Profil | Retribusi IMB')

@section('container')

@foreach($masyarakat as $user)
<div class="container container_margin">
  <div class="row justify-content-center">
    <div class="card col-9 round shadow-black ">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h4 class="card-title mb-2"><b>Biodata</b></h4>
            <div class="contact">
              <button type="button" class="btn btn-primary" title="Edit" data-bs-placement="Top" data-bs-toggle="tooltip" data-toggle="modal" data-target="#edit_{{$user->id}}">
              <i class="bi bi-pencil-square"></i>
              </button>
            </div>
          </div>
              <table class="table table-borderless">
                <tr>
                    <td>Nama</td>
                    <td>: {{$user->nama}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{$user->email}}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{$user->no_ktp}}</td>
                </tr>
                <tr>
                    <td>No. Telp</td>
                    <td>: {{$user->telp}}</td>
                </tr>
            </table>
           
            <!-- The Modal -->
            <div class="modal fade" id="edit_{{$user->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                    <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                  </div>
                    
                    <!-- Modal body -->
                  <div class="modal-body">
                    <form method="post" action="{{route('edit_user')}}">
                    @method('patch')
                    @csrf
                        <div class="form-group">
                              <input type="text" class="form-control" id="id" value="{{$user->id}}" name="id" hidden>
                            </div>
                        <div class="form-group mt-2">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{$user->nama}}" name="nama" >
                            @error('nama')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                            @enderror
                          </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}" name="email" >
                          @error('email')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                          @enderror
                        </div>
                        <div class="form-group mt-2">
                          <label for="no_ktp">NIK</label>
                          <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" value="{{$user->no_ktp}}" name="no_ktp">
                          @error('no_ktp')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                          @enderror
                        </div>
                        <div class="form-group mt-2">
                          <label for="telp">No. Telp</label>
                          <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" value="{{$user->telp}}" name="telp">
                          @error('telp')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                          @enderror
                        </div>
                        <div class="form-group mt-4"> 
                          <div class="contact">
                            <button type="submit" class="btn btn-primary" >Simpan </button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="card col-9 round shadow-black mt-4">
        <div class="card-body contact">
            <button type="button" class="btn btn-primary mt-3 mb-3" data-toggle="modal" data-target="#editPass_{{$user->id}}">
                Ubah Password
            </button>

            <!-- The Modal -->
            <div class="modal fade" id="editPass_{{$user->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                    
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" action="{{route('edit_pass_akun')}}">
                        @csrf
                            <div class="form-group mt-2">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama" name="password_lama" >
                                @error('password_lama')
                                    <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru" >
                                @error('password_baru')
                                    <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="konfirmasi">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('konfirmasi') is-invalid @enderror" id="konfirmasi" name="konfirmasi">
                                @error('konfirmasi')
                                    <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mt-4"> 
                                <button type="submit" class="btn btn-primary">Simpan </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
            $('[data-bs-toggle="tooltip"]').tooltip();   
        });
</script>
 @endsection