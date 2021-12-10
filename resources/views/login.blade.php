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
                  <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
                </div>
              </div>
              <div class="form-group mt-3 mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
              </div>
              <div class="text-center">
                <button type="submit" value="submit">Masuk</button>
              </div>
              <div class="text-center mt-3 ">
                <p>Belum memiliki Akun? <a href="/regis"> Daftar Akun</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Login Section -->
@endsection

  </body>
</html>