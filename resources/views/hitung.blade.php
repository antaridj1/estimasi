<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Hitung Estimasi</title>
  </head>
  <body>
    <div class="container">
      <h1>HITUNG ESTIMASI</h1>
      <a href="/estimasi">Home</a>

      <form method="post" action="{{route('hitung')}}">
        @csrf
        <div id="form_umum">
          <div class="form-group">
              <label for="luas_bangunan">Luas Bangunan</label>
              <input type="number" class="form-control" id="luas_bangunan" placeholder="Luas Bangunan" name="luas_bangunan">
          </div>
          <div class="form-group">
              <label for="luas_tanah">Luas Tanah</label>
              <input type="number" class="form-control" id="luas_tanah" placeholder="Luas Tanah" name="luas_tanah" >
          </div>
          <div class="form-group">
              <label for="gedung">Status Bangunan</label>
              @foreach ($gedungs as $gedung)
              <div class="form-check">
                      <input class="form-check-input" type="radio" name="gedung" id="{{$gedung->nama}}" value="{{$gedung->id}}">
                      <label class="form-check-label" for="{{$gedung->nama}}">
                      {{$gedung->nama}}
                      </label>
                  </div>
              @endforeach
          </div>
          <div class="form-group">
              <label for="fungsi">Fungsi Bangunan</label>
              @foreach ($fungsis as $fungsi)
              <div class="form-check">
                      <input class="form-check-input" type="radio" name="fungsi" id="{{$fungsi->nama}}" value="{{$fungsi->id}}">
                      <label class="form-check-label" for="{{$fungsi->nama}}">
                      {{$fungsi->nama}}
                      </label>
                  </div>
              @endforeach
          </div>
          @foreach ($indeks as $indek)
          @if ($indek->kategori == "klasifikasi")
          <div class="form-group">
              <label for="{{$indek->nama}}">{{$indek->nama}}</label>
              @foreach ($tingkatan_indeks as $tk_indek)
              @if ($tk_indek->nama == $indek->nama)
              <div class="form-check">
                      <input class="form-check-input" type="radio" name="{{$tk_indek->nama}}" id="{{$tk_indek->tingkatan}}" value="{{$tk_indek->id}}">
                      <label class="form-check-label" for="{{$tk_indek->tingkatan}}">
                      {{$tk_indek->tingkatan}}
                      </label>
                  </div>
              @endif
              @endforeach
          </div>
          @endif
          @endforeach
          <div class="form-group">
              <label for="waktu">Jangka Waktu Bangunan</label>
              @foreach ($jangka_waktu as $waktu)
              <div class="form-check">
                      <input class="form-check-input" type="radio" name="waktu" id="{{$waktu->nama}}" value="{{$waktu->id}}">
                      <label class="form-check-label" for="{{$waktu->nama}}">
                      {{$waktu->nama}}
                      </label>
                  </div>
              @endforeach
          </div>
        </div>

          <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#ModalSarana">
            Tambahkan Sarana
          </button>
          <!-- The Modal -->
          <div class="modal fade" id="ModalSarana">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Sarana Prasarana</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
               
                  <!-- Modal body -->
                <div class="modal-body">
                  @foreach ($kategori_sarana as $ktgr)
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                      <div class="accordion-item">
                     
                        <h2 class="accordion-header" id="panelsStayOpen-heading_{{$ktgr->id}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse_{{$ktgr->id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse_{{$ktgr->id}}">
                          {{$ktgr->kategori}}
                        </button>
                        </h2>
                          <div id="panelsStayOpen-collapse_{{$ktgr->id}}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading_{{$ktgr->id}}">
                            <div class="accordion-body">
                              @foreach ($saranas as $sarana)
                              @if ($sarana->kategori == $ktgr->kategori)
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{$sarana->nama}}" name="sarana[]" id="{{$sarana->id}}" >
                                  <label class="form-check-label" for="{{$sarana->id}}">
                                      {{$sarana->nama}}
                                  </label>
                              </div>
                              @endif
                              @endforeach
                            </div>
                          </div>
                      
                      </div>
                    </div>
                  @endforeach
                </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="simpan"  data-dismiss="modal">Simpan </button>
                  </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row justify-content-center">
              <div class="mt-3">
                <table class="table table-bordered text-center">
                  <tbody>   
                    <tr> 
                      <td> Nama Sarana</td>
                      <td> Jumlah</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="form-group mt-4"> 
            <button type="submit" class="btn btn-primary">Submit </button>
          </div>
        </div>
      </form>
    </div>
        

    <script>
      //Checkbox
        const modal = document.getElementById('ModalSarana');
        const checks = modal.querySelectorAll('.form-check-input');
        checks.forEach(function(check){
          check.addEventListener('click',function(e){
            e.target.classList.toggle('checked');
          });
        });
        let array = [];
      //Show Sarana
        const simpan = document.getElementById('simpan');
        simpan.addEventListener('click',function(){
          const checkbox = modal.querySelectorAll('.checked');
          const table = document.querySelector('table');
          
          checkbox.forEach(function(box){
            if(array.includes(box.value)==false){
            array.push(box.value);
            // console.log(array);
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            const td2 = document.createElement('td');
            let teks = document.createTextNode(box.value);
            const jumlah = document.createElement('input');
            jumlah.setAttribute('name','jumlah_sarana[]');
            td.appendChild(teks);
            td2.appendChild(jumlah);
            tr.appendChild(td);
            tr.appendChild(td2);
            table.appendChild(tr);
            }
          });
        });

      //   const modal = document.getElementById('ModalSarana');
      //   const checks = modal.querySelectorAll('.form-check-input');
      //   checks.forEach(function(check){
      //     check.addEventListener('click',function(e){
      //       e.target.classList.toggle('checked');
       
      //       const checkbox = modal.querySelectorAll('.checked');
      //       checkbox.forEach(function(box){
      //         const table = document.querySelector('table');
      //         const tr = document.createElement('tr');
      //         const td = document.createElement('td');
      //         const td2 = document.createElement('td');
      //         let teks = document.createTextNode(box.value);
      //         const jumlah = document.createElement('input');
      //         jumlah.setAttribute('name','jumlah_sarana[]');
      //         td.appendChild(teks);
      //         td2.appendChild(jumlah);
      //         tr.appendChild(td);
      //         tr.appendChild(td2);
      //         table.appendChild(tr);
      //       });

      //     });
      //  });

      //     const simpan = document.getElementById('simpan');
      //       simpan.addEventListener('click',function(){
      //     //
      //     });



      //Display 
        // const formUmum = document.getElementById('form_umum');
        // const formKlasifikasi = document.getElementById('form_klasifikasi');
        // const buttonNext = document.getElementById('next');
        // buttonNext.addEventListener('click',function(){
        //   formUmum.style.display = 'none';
        //   formKlasifikasi.style.display = 'none';
        // });
        // const button = document.getElementById('next');
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>