<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
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
      <th scope="col">ID</th>
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
        <td>{{$ind->id}}</td>
        <td>{{$ind->kategori}}</td>
        <td>{{$ind->tingkatan}}</td>
        <td>{{$ind->bobot_indeks}}</td>
        <td>{{$ind->keterangan}}</td>
        <td>{{$ind->status}}</td>
        <td>
          <a href="" class="btn btn-primary" >
            Edit
          </a>
        </td>
      </tr>
    </tbody>
</table>
      </div>
      </div>
      </div>

  </body>
</html>