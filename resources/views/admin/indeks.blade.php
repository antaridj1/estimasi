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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Dashboard Admin</title>
    <style type="text/css">

      #kategori_indeks {
        display:none;
    }

    
      </style>

  </head>
  <body>
<div class="container">
<h1>DASHBOARD ADMIN</h1>
<a href="/logout">Logout</a>
<a href="/dashboard/indeks">Indeks</a>
<a href="/dashboard/sarana">Sarana</a>
<a href="/dashboard/gedung">Gedung</a>
<a href="/dashboard/kategoriIndeks">Kategori Indeks</a>

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
          <form method="post" action="{{route('input_indeks')}}" id="form_id">
              @csrf
              <div class="form-group mt-2" id="dropdown_input">
                <label for="parameter">Parameter</label>
                <select class="form-select" aria-label=".form-select-sm example" name="parameter" id="parameter" onchange="myFunction()">
                  <option value="fungsi">Fungsi</option>
                  <option value="klasifikasi">Klasifikasi</option>
                  <option value="waktu">Waktu</option>
                </select>
              </div>
              <div class="form-group" id="kategori_indeks">
              <label for="kategori_indeks_id">Kategori</label>
                <select class="form-select" aria-label=".form-select-sm example" name="kategori_indeks_id" id="kategori_indeks_id">
                  @foreach ($kategori as $ktgr)
                    <option value="{{$ktgr->id}}">{{$ktgr->nama}}</option>
                  @endforeach
                </select>
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
        <div>
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
      <th scope="col">No.</th>
      <th scope="col">ID</th>
      <th scope="col">Kategori</th>
      <th scope="col">Tingkatan</th>
      <th scope="col">Bobot</th>
      <th scope="col">Parameter</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody class="tabel_edit">
      
     @foreach ($indeks as $indek)
      <tr> 
        <td>{{$loop->iteration}}</td>
        <td>{{$indek->id}}</td>
        <td>{{$indek->kategori_indeks->nama}}</td> 
        <td>{{$indek->tingkatan}}</td>
        <td>{{$indek->bobot_indeks}}</td>
        <td>{{$indek->parameter}}</td>
        <td>{{$indek->keterangan}}</td>
        <td>{{$indek->status}}</td>
        <td>
        <a href="dashboard/indeks/{{$indek->id}}" class="btn btn-primary button_edit" data-toggle="modal" data-target="#edit_{{$indek->id}}">
            Edit
          </a>

         <!-- The Modal -->
        <div class="modal fade " id="edit_{{$indek->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" id="test">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" action="{{route('edit_indeks')}}" >
                @method('patch')
                @csrf
                    <div class="form-group">
                          <label for="id">ID</label>
                          <input type="text" class="form-control" id="id" value="{{$indek->id}}" name="id" readonly>
                      </div>
                    <div class="form-group mt-2">
                      <label for="parameter_edit">Parameter</label>
                      <select class="form-select edit_select" aria-label=".form-select-sm example" name="parameter" value="{{$indek->parameter}}" >
                        <option value="fungsi" {{ $indek->parameter == "fungsi" ? 'selected': ''}}> Fungsi</option>
                        <option value="klasifikasi" {{ $indek->parameter == "klasifikasi" ? 'selected': ''}}> Klasifikasi</option>
                        <option value="waktu" {{ $indek->parameter == "waktu" ? 'selected': ''}} >Waktu</option>
                      </select>
                    </div>
                    
                   
                    <div class="form-group mt-2 kategori" >
                      <label for="kategori_indeks_id">Kategori</label>
                      <select class="form-select" aria-label=".form-select-sm example" name="kategori_indeks_id"   value="{{$indek->kategori_indeks->nama}}">
                        @foreach ($kategori as $ktgr)
                          @if($ktgr->id == $indek->kategori_indeks->id)
                              <option selected value="{{$ktgr->id}}">{{$ktgr->nama}}</option>
                          @else
                            <option value="{{$ktgr->id}}">{{$ktgr->nama}}</option>
                          @endif
                        @endforeach
                      </select>
                    
                   
                    </div>
                    <div class="form-group mt-2">
                      <label for="tingkatan">Tingkatan</label>
                      <input type="text" class="form-control " id="tingkatan" value="{{$indek->tingkatan}}" name="tingkatan" >
                    </div>
                    <div class="form-group mt-2">
                      <label for="bobot_indeks">Bobot</label>
                      <input type="text" class="form-control" id="bobot_indeks" value="{{$indek->bobot_indeks}}" name="bobot_indeks">
                    </div>
                    <div class="form-group mt-2">
                      <label for="keterangan">Keterangan</label>
                      <input type="text" class="form-control" id="keterangan" value="{{$indek->keterangan}}" name="keterangan">
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
                                <th scope="col">No.</th>
                                <th scope="col">ID</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tingkatan</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Parameter</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tabel_edit">
                            @foreach ($indeks as $indek)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$indek->id}}</td>
                                <td>{{$indek->kategori_indeks->nama}}</td>
                                <td>{{$indek->tingkatan}}</td>
                                <td>{{$indek->bobot_indeks}}</td>
                                <td>{{$indek->parameter}}</td>
                                <td>{{$indek->keterangan}}</td>
                                <td>{{$indek->status}}</td>
                                <td>
                                    <a href="dashboard/indeks/{{$indek->id}}" class="btn btn-primary button_edit" data-toggle="modal" data-target="#edit_{{$indek->id}}">
                                        Edit
                                    </a>

                                    <!-- The Modal Edit -->
                                    <div class="modal fade " id="edit_{{$indek->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data</h4>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close" id="test">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form method="post" action="{{route('edit_indeks')}}">
                                                        @method('patch')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="id">ID</label>
                                                            <input type="text" class="form-control" id="id"
                                                                value="{{$indek->id}}" name="id" readonly>
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="parameter_edit">Parameter</label>
                                                            <select class="form-select edit_select"
                                                                aria-label=".form-select-sm example" name="parameter"
                                                                value="{{$indek->parameter}}">
                                                                <option value="fungsi"
                                                                    {{ $indek->parameter == "fungsi" ? 'selected': ''}}>
                                                                    Fungsi</option>
                                                                <option value="klasifikasi"
                                                                    {{ $indek->parameter == "klasifikasi" ? 'selected': ''}}>
                                                                    Klasifikasi</option>
                                                                <option value="waktu"
                                                                    {{ $indek->parameter == "waktu" ? 'selected': ''}}>
                                                                    Waktu</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-2 kategori" style="display: none">
                                                            <label for="kategori_indeks_id">Kategori</label>
                                                            <select class="form-select"
                                                                aria-label=".form-select-sm example"
                                                                name="kategori_indeks_id"
                                                                value="{{$indek->kategori_indeks->nama}}">
                                                                @foreach ($kategori as $ktgr)
																	@if($ktgr->id == $indek->kategori_indeks->id)
																	<option selected value="{{$ktgr->id}}">{{$ktgr->nama}}
																	</option>
																	@else
																	<option value="{{$ktgr->id}}">{{$ktgr->nama}}</option>
																	@endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="tingkatan">Tingkatan</label>
                                                            <input type="text" class="form-control " id="tingkatan"
                                                                value="{{$indek->tingkatan}}" name="tingkatan">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="bobot_indeks">Bobot</label>
                                                            <input type="text" class="form-control" id="bobot_indeks"
                                                                value="{{$indek->bobot_indeks}}" name="bobot_indeks">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" class="form-control" id="keterangan"
                                                                value="{{$indek->keterangan}}" name="keterangan">
                                                        </div>
                                                        <div class="form-group mt-4">
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Modal footer -->


                                            </div>
                                        </div>
                                    </div>

									<a href="dashboard/indeks/{{$indek->id}}" class="btn btn-primary" data-toggle="modal"
										data-target="#editStatus_{{$indek->id}}">
										Non-aktifkan
									</a>

									<!-- The Modal Non-Aktifkan -->
									<div class="modal fade" id="editStatus_{{$indek->id}}">
										<div class="modal-dialog">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Nonaktifkan Data {{$indek->nama}}</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<!-- Modal body -->
												<div class="modal-body">
													<form method="post" action="indeks/{{$indek->id}}">
														@method('put')
														@csrf
														<div class="form-group mt-4">
															<p>Apakah Anda yakin?</p>
															<div class="form-group mt-4">
																<button type="submit" class="btn btn-primary">Ya </button>
																<button type="button" class="btn btn-secondary"
																	data-dismiss="modal">Batal</button>
															</div>
													</form>
												</div>
												<!-- Modal footer -->
											</div>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

    {{-- <script>


        //kategori
        function myFunction() {
            const kategori = document.getElementById('kategori_indeks');
            let x = document.getElementById('parameter').value;
            if (x == "klasifikasi") {
                kategori.style.display = 'block';
            } else {
                kategori.style.display = 'none';
            }
        }

        // $(document).ready(function(){
        
        
        //   $(".button_edit").on("click", function(){
        //     $(".edit_select").$(this).val();

        //   });
        
        //   //  for(i=0;i<select.length;i++){
        //   //   value = $(".edit")[i].text();
        //   //  }
         
        //   // console.log(value);
        //   // if(value == "klasifikasi"){
        //   //   $("#kategori_edit").show();
        //   // }else{
        //   //   $("#kategori_edit").hide();
        //   // }
        // });
         
          // function edit_param(){
          // const buttons = document.getElementsByClassName('button_edit');
          // //let kategoris = document.getElementsByClassName('kategori');
          // const kategoris = document.getElementById('kategori_edit');
          // for(i=0;i<buttons.length;i++){
          //   buttons[i].addEventListener('click',function(){
          //       let x = document.getElementById('parameter_edit').value;
              
          //       if(x == "klasifikasi"){
          //         kategoris.style.display = 'block';
          //       }
          //       else{
          //         kategoris.style.display = 'none';
          //       }
              
          //   }); 

          // }
          // }


          // let buttons = document.getElementsByClassName('button_edit');
          
          

          // buttons.forEach(function(button){
          //   button.addEventListener('click',function(){
          //     let selects = document.getElementsByClassName('edit_select');
          //     selects.forEach(function(select){
          //       let kategoris = document.getElementsByClassName('kategori');
          //       kategoris.forEach(function(kategori){
          //         if(select.value == "klasifikasi"){
          //             kategori.style.display = 'block';
          //         }
          //         else{
          //           kategori.style.display = 'none';
          //         }
          //       }); 
          //     });
              
              
          //   }); 

          
          // }); 

        let buttons = document.getElementsByClassName('button_edit');
        let selects = document.querySelectorAll('edit_select');
        val = [];
        for(i=0;i<buttons.length;i++){
         
          selects.forEach(function(select){
                val.push(select.value);
              });
            buttons[i].addEventListener('click',function(){
            
             
              console.log(val[i]);
            });
        }


          // if(x == "klasifikasi"){
          //   kategoris.style.display = 'block';
          // }
          // else{
          //   kategoris.style.display = 'none';
          // }
        
        // function edit_param(){
        //   const kategoris = document.getElementById('kategori_edit');
        //   let x = document.getElementById('parameter_edit').value;
        //   if(x == "klasifikasi"){
        //     kategoris.style.display = 'block';
        //   }
        //   else{
        //     kategoris.style.display = 'none';
        //   }
        // }
    </script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
	<script>
		$(document).ready(function () {
			$('.edit_select').on('change', function () {
				if ($(this).val() == 'klasifikasi') {
					$(this).parents('.modal').find('.kategori').show();
				} else {
					$(this).parents('.modal').find('.kategori').hide();
				}
			})
		})
	</script>
</body>

</html>