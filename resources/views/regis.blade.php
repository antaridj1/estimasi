@extends('layouts.main')

@section('title','Daftar | Estimasi Retribusi IMB')

@section('container')

   <!-- ======= Regis Section ======= -->
   <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/login.svg" class="img-fluid animated">
          </div> 
          <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <form method="post" action="{{route('regis')}}" enctype="multipart/form-data" class="php-email-form" role="form" >
            @csrf
            <div class="row">
                <div class="section-title">
                    <p>Daftar Akun</p>
                </div>
                <div class="form-group col-md-6">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ @old('nama') }}" id="nama" required>
                  @error('nama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="email">Username</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ @old('email') }}" name="email" id="email" required>
                  @error('email')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="form-group mt-3">
                  <label for="telp">No Telepon</label>
                  <input type="text" class="form-control @error('telp') is-invalid @enderror" value="{{ @old('telp') }}" id="telp" name="telp" required>
                  @error('telp')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
              </div>
              <div class="form-group mt-3">
                  <label for="no_ktp" class="form-label">NIK</label>
                  <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" value="{{ @old('no_ktp') }}" id="no_ktp" name="no_ktp" required>
                  @error('no_ktp')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
              </div>
              <div class="form-group mt-3">
                  <label for="password1" class="form-label">Password</label>
                  <input type="password" class="form-control @error('password1') is-invalid @enderror" value="{{ @old('password1') }}" id="password1" name="password1" required>
                  @error('password1')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
              </div>
              <div class="form-group mt-3">
                  <label for="password2" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control @error('password1') is-invalid @enderror" value="{{ @old('password2') }}" id="password2" name="password2" required>
                  @error('password2')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
              </div>
              <div class="text-center"><button type="submit">Daftar</button></div>
              <div class="text-center mt-3 "><p>Sudah memiliki Akun? <a href="/login"> Masuk</a></p></div>
            </form>
            
          </div>
        </div>
      </div>
    </section><!-- End Regis Section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" rel="stylesheet" type="text/css">

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>

@if(session()->has('status'))
<script>
    $(document).ready(function(){       
        Swal.fire({        
           type: '{{session()->get('status')}}',
           title: '{{session()->get('message')}}',
           showConfirmButton: false,
           timer: 3000
        })
    });
</script>
@endif


  




@endsection

