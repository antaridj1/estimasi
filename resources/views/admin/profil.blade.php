@extends('admin.mainlayout')

@section('title','Profil | Admin IMB')

@section('container')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profil</a></li>
        </ol>
    </div>
</div>
            <!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profil Admin</h4>
                    @foreach($admin as $user)
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
                                <td>Alamat</td>
                                <td>: {{$user->alamat}}</td>
                            </tr>
                            <tr>
                                <td>No. Telp</td>
                                <td>: {{$user->telp}}</td>
                            </tr>
                        </table>

                        <a href="{{ route('edit_admin',$user->id) }}" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{$user->id}}">
                            Edit
                        </a>

                        <!-- The Modal -->
                        <div class="modal fade" id="edit_{{$user->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="post" action="{{route('edit_admin')}}">
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
                                            <label for="telp">No. Telp</label>
                                            <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" value="{{$user->telp}}" name="telp">
                                            @error('telp')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{$user->alamat}}" name="alamat">
                                            @error('alamat')
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach($admin as $user)
                        <a href="{{ route('edit_pass_admin',$user->id) }}" class="btn btn-primary" data-toggle="modal" data-target="#edit_pass_{{$user->id}}">
                            Ubah Password
                        </a>

                        <!-- The Modal -->
                        <div class="modal fade" id="edit_pass_{{$user->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="post" action="{{route('edit_pass_admin')}}">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection