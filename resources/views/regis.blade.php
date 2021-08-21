<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Regis</title>
  </head>
  <body>
<div class="container">
<div class="row">
    <div class="col-6">
    <h1> REGISTRASI </h1>
  <form method="post" action="{{route('regis')}}" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" aria-describedby="email">
  </div>
  <div class="mb-3">
    <label for="password1" class="form-label">Password</label>
    <input type="password" class="form-control" id="password1" name="password1">
  </div>
  <div class="mb-3">
    <label for="password2" class="form-label">Konfirmasi Password</label>
    <input type="password" class="form-control" id="password2" name="password2">
  </div>
  <div class="mb-3">
    <label for="telp" class="form-label">No Telepon</label>
    <input type="text" class="form-control" id="telp" name="telp" aria-describedby="telp">
  </div>
  <div class="mb-3">
    <label for="no_ktp" class="form-label">NIK</label>
    <input type="text" class="form-control" id="no_ktp" name="no_ktp" aria-describedby="no_ktp">
  </div>
  
  <button type="submit" class="btn btn-primary">Registrasi</button>
</form>
</div>
</div>
</div>
  </body>
</html>