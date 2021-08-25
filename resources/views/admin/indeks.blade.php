<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dashboard Admin</title>
  </head>
  <body>
<div class="container">
<h1>DASHBOARD ADMIN</h1>
<a href="/logout">Logout</a>
<a href="/dashboard/indeks">Indeks</a>
<a href="/dashboard/sarana">Sarana</a>
<a href="/dashboard/gedung">Gedung</a>

<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#ModalIndeks">
    Tambahkan Data Indeks
  </button>

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
        <div class="modal-body">
          <form method="post" action="{{route('input_indeks')}}">
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
                <label for="tingkatan">Tingkatan</label>
                <input type="text" class="form-control " id="tingkatan" placeholder="tingkatan" name="tingkatan" >
              </div>
              <div class="form-group mt-2">
                <label for="bobot_indeks">Bobot</label>
                <input type="text" class="form-control" id="bobot_indeks" placeholder="bobot" name="bobot_indeks">
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

        <!-- Modal footer -->
        
        
      </div>
    </div>
  </div>
</div>

<div class="container">
<div class="row justify-content-center">
<div class="mt-3">
<table class="table table-bordered text-center">
  <thead class="table-light">
    <tr>
      <th scope="col">No.</th>
      <th scope="col">ID</th>
      <th scope="col">Nama</th>
      <th scope="col">Kategori</th>
      <th scope="col">Tingkatan</th>
      <th scope="col">Bobot</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
      
     @foreach ($indek as $ind)
      <tr> 
        <td>{{$loop->iteration}}</td>
        <td>{{$ind->id}}</td>
        <td>{{$ind->nama}}</td>
        <td>{{$ind->kategori}}</td>
        <td>{{$ind->tingkatan}}</td>
        <td>{{$ind->bobot_indeks}}</td>
        <td>{{$ind->keterangan}}</td>
        <td>{{$ind->status}}</td>
        <td>
        <a href="dashboard/indeks/{{$ind->id}}" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{$ind->id}}">
            Edit
          </a>

         <!-- The Modal -->
        <div class="modal fade" id="edit_{{$ind->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" action="{{route('edit_indeks')}}">
                @method('patch')
                @csrf
                    <div class="form-group">
                          <label for="id">ID</label>
                          <input type="text" class="form-control" id="id" value="{{$ind->id}}" name="id" readonly>
                        </div>
                        <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" value="{{$ind->nama}}" name="nama" >
                    </div>
                    <div class="form-group">
                      <label for="kategori">Kategori</label>
                      <input type="text" class="form-control" id="kategori" value="{{$ind->kategori}}" name="kategori" >
                    </div>
                    <div class="form-group mt-2">
                      <label for="tingkatan">Tingkatan</label>
                      <input type="text" class="form-control " id="tingkatan" value="{{$ind->tingkatan}}" name="tingkatan" >
                    </div>
                    <div class="form-group mt-2">
                      <label for="bobot_indeks">Bobot</label>
                      <input type="text" class="form-control" id="bobot_indeks" value="{{$ind->bobot_indeks}}" name="bobot_indeks">
                    </div>
                    <div class="form-group mt-2">
                      <label for="keterangan">Keterangan</label>
                      <input type="text" class="form-control" id="keterangan" value="{{$ind->keterangan}}" name="keterangan">
                    </div>
                    <div class="form-group mt-2">
                      <label for="status">Status</label>
                      <input type="text" class="form-control" id="status" value="{{$ind->status}}" name="status">
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
        </div>

        <a href="dashboard/indeks/{{$indeks->id}}" class="btn btn-primary" data-toggle="modal" data-target="#editStatus_{{$indeks->id}}">
            Non-aktifkan
        </a>
        <div class="modal fade" id="editStatus_{{$indeks->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Nonaktifkan Data {{$indeks->nama}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" action="indeks/{{$indeks->id}}">
                @method('put')
                @csrf
                <div class="form-group mt-4"> 
                    <p>Apakah Anda yakin?</p>
                    <div class="form-group mt-4"> 
                        <button type="submit" class="btn btn-primary" >Ya </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
              </div>
              <!-- Modal footer -->
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
      </div>

  </body>
</html>