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
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                  <label for="telp">No Telepon</label>
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="No.Telp" required>
              </div>
              <div class="form-group mt-3">
                  <label for="no_ktp" class="form-label">NIK</label>
                  <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="NIK" required>
              </div>
              <div class="form-group mt-3">
                  <label for="password1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" required>
              </div>
               <div class="form-group mt-3">
                  <label for="password2" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" required>
              </div>
              <div class="text-center"><button type="submit">Daftar</button></div>
              <div class="text-center mt-3 "><p>Sudah memiliki Akun? <a href="/login"> Masuk</a></p></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Regis Section -->
@endsection

