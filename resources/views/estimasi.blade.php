@extends('layouts.main')

@section('title','Estimasi Retribusi IMB')

@section('container')
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Ketahui Perkiraan Biaya Retribusi IMB Dengan Mudah</h1>
          <h2>Dalam sekali klik Anda dapat mengetahui perkiraan biaya retribusi Izin Mendirikan Bangunan Anda</h2>
          <div>
            <a href="/hitung" class="btn-get-started scrollto">Hitung Estimasi</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="assets/img/hero-img.svg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->
  @endsection


