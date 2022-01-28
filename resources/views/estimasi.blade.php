@extends('layouts.main')

@section('title','Estimasi Retribusi IMB')

@section('container')
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <!-- <div class="d-flex"> -->
        <!-- <img src="assets/img/dpmptsp_logo.png"  width="80%" alt=""> -->
        <!-- <div> -->
      
        
        <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="8000">
      <div class="d-block">
      <h1 class="mb-2">Estimasi Retribusi Izin Mendirikan Bangunan</h1>
              
              <h2>Ketahui biaya retribusi Izin Mendirikan Bangunan Anda dengan mudah</h2>
              <div>
            <a href="/hitung" class="btn-get-started scrollto">Hitung Estimasi</a>
          </div>
            </div>
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <div class="text-center">
      <img src="assets/img/kab_badung.png" width="20%" class="mb-2 mt-0" height="20%" class="d-block" alt="...">
      <div>
        <h4>PEMERINTAH KABUPATEN BADUNG</h4>
      <!-- <h4>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Badung</h4> -->
      <h4>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KABUPATEN BADUNG</h4>
 <div>
            <a href="/hitung" class="btn-get-started scrollto">Hitung Estimasi</a>
          </div>
        </div>
      
    </div>
   
      </div>
    
    </div>
</div>
<!-- </div> -->
<!-- </div> -->
        
         
      
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="assets/img/hero-img.svg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->
  @endsection


