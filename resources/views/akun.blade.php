<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>home</title>
  </head>
  <body>
<div class="container">
<h1>Akun Saya</h1>
<a href="/estimasi">Back</a>
<a href="/logout">Logout</a>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Biodata</h5>
        @foreach($masyarakat as $user)
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
        <a href="akun/{{$user->id}}" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{$user->id}}">
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
                <form method="post" action="{{route('edit_user')}}">
                @method('patch')
                @csrf
                    <div class="form-group">
                          <input type="text" class="form-control" id="id" value="{{$user->id}}" name="id" hidden>
                        </div>
                    <div class="form-group mt-2">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control " id="nama" value="{{$user->nama}}" name="nama" >
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email" value="{{$user->email}}" name="email" >
                    </div>
                    <div class="form-group mt-2">
                      <label for="no_ktp">NIK</label>
                      <input type="text" class="form-control" id="no_ktp" value="{{$user->no_ktp}}" name="no_ktp">
                    </div>
                    <div class="form-group mt-2">
                      <label for="telp">No. Telp</label>
                      <input type="text" class="form-control" id="telp" value="{{$user->telp}}" name="telp">
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
        @endforeach
    </div>
</div>

</div>
  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>