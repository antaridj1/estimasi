@extends('layouts.main')

@section('title','Masuk | Estimasi Retribusi IMB')

@section('container')
   <!-- ======= Login Section ======= -->
   <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/login.svg" class="img-fluid animated">
          </div> 
          <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <form method="post" action="{{route('postlogin')}}" enctype="multipart/form-data" class="php-email-form">
            @csrf
              <div class="row">
                <div class="section-title">
                    <p>Login</p>
                </div>
                <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required >
                  @error('email')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              
                <div class="form-group mt-3 mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                  @error('password')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" value="submit">Masuk</button>
                </div>
                <div class="text-center mt-3 ">
                  <p>Belum memiliki Akun? <a href="/regis"> Daftar Akun</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Login Section -->

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
