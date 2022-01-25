@extends('layouts.main')

@section('title','Hitung | Estimasi Retribusi IMB')

@section('container')

    <div class="container container_margin">
        <div class="row justify-content-center">
            <div class="col-sm-9">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/estimasi">Beranda</a></li>
                        <li class="breadcrumb-item active"><a href="#">Hitung</a></li>
                    </ol>
                </nav>
                <form method="post" action="{{route('hitung')}}">
                    @csrf
                    <div id="form_umum">
                        <div class="col-12 shadow-sm p-3 mb-2 bg-body round">
                            <div class="d-flex justify-content-evenly">
                                <div class="col-sm-6">
                                    <div class="form-group p-3">
                                        <label class="hitung" for="luas_bangunan">Luas Bangunan</label>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control @error('luas_bangunan') is-invalid @enderror" value="{{ @old('luas_bangunan') }}" id="luas_bangunan" placeholder="Luas Bangunan"
                                                name="luas_bangunan">
                                            <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                                            @error('luas_bangunan')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group p-3">
                                        <label class="hitung" for="luas_tanah">Luas Tanah</label>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control @error('luas_tanah') is-invalid @enderror" value="{{ @old('luas_tanah') }}" id="luas_tanah" placeholder="Luas Tanah"
                                                name="luas_tanah">
                                            <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                                            @error('luas_tanah')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group p-4 shadow-sm bg-body round h-100 {{($errors->first('fungsi') ? 'estimasi_error' : '')}}">
                                <label for="fungsi" class="hitung">Fungsi Bangunan</label>
                                <div class="row">
                                    <div class="d-flex justify-content-evenly"> 
                                        @foreach ($fungsis as $fungsi)
                                        @if($loop->first || $loop->index % 3 == 0)
                                        <div class="col">
                                        @endif
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fungsi" id="{{$fungsi->tingkatan}}"
                                                    value="{{$fungsi->id}}">
                                                <label class="form-check-label" for="{{$fungsi->tingkatan}}">
                                                    {{$fungsi->tingkatan}}
                                                </label>
                                            </div>
                                        @if($loop->iteration % 3 == 0 || $loop->last)
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                {!! $errors->first('fungsi', '<p class="text-error mt-2">This field is required</p>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-evenly">
                                <div class="col-6 mb-2 me-1 ">
                                    <div class="form-group p-4 shadow-sm bg-body round h-100 {{($errors->first('gedung') ? 'estimasi_error' : '')}}">
                                        <label class="hitung" for="gedung">Status Bangunan</label>
                                        @foreach ($gedungs as $gedung)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gedung" id="{{$gedung->nama}}"
                                                value="{{$gedung->id}}">
                                            <label class="form-check-label" for="{{$gedung->nama}}">
                                                {{$gedung->nama}}
                                            </label>
                                        </div>
                                        @endforeach
                                        {!! $errors->first('gedung', '<p class="text-error mt-2">This field is required</p>') !!}
                                    </div>
                                </div>
                                <div class="col-6 ms-1 p-4 shadow-sm mb-2 bg-body round {{($errors->first('waktu') ? 'estimasi_error' : '')}}">
                                    <div class="form-group">
                                        <label for="waktu" class="hitung ">Jangka Waktu Bangunan</label>
                                        @foreach ($jangka_waktu as $waktu)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="waktu" id="{{$waktu->id}}"
                                                value="{{$waktu->id}}">
                                            <label class="form-check-label" for="{{$waktu->id}}">
                                                {{$waktu->tingkatan}}
                                            </label>
                                        </div>
                                        @endforeach
                                        {!! $errors->first('waktu', '<p class="text-error mt-2">This field is required</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        @foreach ($kategori_indeks as $ktgr)
                            @if($ktgr->slug == "zonasi_gempa")
                                <div class="col-12">
                                    <div class="form-group p-4 shadow-sm mb-2 bg-body round {{($errors->has($ktgr->slug) ? 'estimasi_error' : '')}}">
                                        <label for="{{$ktgr->nama}}" class="hitung">{{$ktgr->nama}}</label>
                                            @foreach ($indeks as $tk_indek)  
                                                @if ($tk_indek->kategori_indeks->slug == $ktgr->slug)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="{{$ktgr->slug}}" id="{{$tk_indek->id}}"
                                                                value="{{$tk_indek->id}}">
                                                            <label class="form-check-label" for="{{$tk_indek->id}}">
                                                                {{$tk_indek->tingkatan}}
                                                            </label>
                                                        </div>
                                                @endif
                                            @endforeach
                                        {!! $errors->first($ktgr->slug, '<p class="text-error mt-2">This field is required</p>') !!}
                                    </div>
                                </div>
                            @else
                                @if($loop->first || $loop->index % 2 == 0) 
                                    <div class="row">
                                        <div class="d-flex justify-content-evenly">
                                @endif
                
                                    <div class="col-6 h-100 {{ ($loop->iteration % 2 == 0) ? 'ms-1' : ' me-1' }}">
                                        <div class="form-group p-4 shadow-sm mb-2 bg-body round {{($errors->has($ktgr->slug) ? 'estimasi_error' : '')}}">
                                            <label for="{{$ktgr->nama}}" class="hitung">{{$ktgr->nama}}</label>
                                                @foreach ($indeks as $tk_indek)  
                                                    @if ($tk_indek->kategori_indeks->slug == $ktgr->slug)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="{{$ktgr->slug}}" id="{{$tk_indek->id}}"
                                                                    value="{{$tk_indek->id}}">
                                                                <label class="form-check-label" for="{{$tk_indek->id}}">
                                                                    {{$tk_indek->tingkatan}}
                                                                </label>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            {!! $errors->first($ktgr->slug, '<p class="text-error mt-2">This field is required</p>') !!}
                                        </div>
                                    </div>
                                @if($loop->iteration % 2 == 0 || $loop->last)
                                        </div>
                                    </div>
                                @endif
                            @endif
                           
                        @endforeach
                    </div>
                    
                    <!-- The Modal -->
                    <div class="modal fade" id="ModalSarana">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Sarana Prasarana</h4>
                                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    @foreach ($kategori_sarana as $ktgr)
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{$ktgr->id}}">
                                                <button class="accordion-button {{ ($loop->first ? '' : 'collapsed') }}" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{$ktgr->id}}" aria-expanded="true"
                                                    aria-controls="collapse{{$ktgr->id}}">
                                                    {{$ktgr->kategori}}
                                                </button>
                                            </h2>
                                            <div id="collapse{{$ktgr->id}}"
                                                class="accordion-collapse collapse {{ ($loop->first ? 'show' : '') }}"
                                                aria-labelledby="heading{{$ktgr->id}}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach ($saranas as $sarana)
                                                    @if ($sarana->kategori == $ktgr->kategori)
                                                    <div class="form-check">
                                                        <input class="form-check-input {{$sarana->kategori}}" type="checkbox"
                                                            value="{{$sarana->nama}}" name="sarana[]" id="{{$sarana->id}}">
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
                                    <button type="button" class="btn btn-primary" id="simpan" data-dismiss="modal">Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-12 round p-4 shadow-sm bg-body">                           
                                <table class="table table-borderless text-center">
                                    <label class="hitung">Sarana Prasarana</label>
                                    <tbody id="datanya"></tbody>
                                </table>
                                <div class="secondary mb-2">
                                    <button type="button" class="shadow-sm" id="btnmodal" data-toggle="modal" data-target="#ModalSarana">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambahkan Sarana
                                    </button>
                                </div>              
                        </div>

                        

                    <div class="form-group mt-4 contact">
                        <button type="submit" class="btn btn-primary">Hitung </button>
                    </div>
		        </form>
            </div>
        </div>
    </div>
    




     <script>
        // //Checkbox
        // const modal = document.getElementById('ModalSarana');
        // const checks = modal.querySelectorAll('.form-check-input');
        // checks.forEach(function (check) {
        //     check.addEventListener('click', function (e) {
        //         e.target.classList.toggle('checked');
        //     });
        // });
      //   let array = [];
      //   //Show Sarana
      //   const simpan = document.getElementById('simpan');
      //   simpan.addEventListener('click', function () {
      //       const checkbox = modal.querySelectorAll('.checked');
			// const checkboxdie = modal.querySelectorAll('.checked');
      //       const table = document.querySelector('table');

      //       checkbox.forEach(function (box) {
      //           if (array.includes(box.value) == false) {
      //               array.push(box.value);
      //               // console.log(array);
      //               const tr = document.createElement('tr');
      //               const td = document.createElement('td');
      //               const td2 = document.createElement('td');
      //               let teks = document.createTextNode(box.value);
      //               const jumlah = document.createElement('input');
      //               jumlah.setAttribute('name', 'jumlah_sarana[]');
      //               td.appendChild(teks);
      //               td2.appendChild(jumlah);
      //               tr.appendChild(td);
      //               tr.appendChild(td2);
      //               table.appendChild(tr);
      //           }
      //       });
      //   });

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
	<script>
		$(document).ready(function () {
			function ubahKeSlug(Text) {
				return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
			}
			$('#simpan').on('click', function () {
				let dataCheck = $(this).parents('.modal').find('.form-check-input:checked');
				let dataUncheck = $(this).parents('.modal').find('.form-check-input:not(:checked)');
				const table = $('#datanya');
				let datanya = '';
				$.each(dataCheck, function (index, value) {
					if (!table.find('tr[data-id="' + dataCheck.eq(index).val() + '"]').length) {
						console.log('ini checked : '+dataCheck.eq(index).val());
                        if(dataCheck.eq(index).hasClass("Perkerasan"||"Penghubung"||"Kolam")){
						table.append('<tr data-id="'+dataCheck.eq(index).val()+'">\
										<td>'+dataCheck.eq(index).val()+'</td>\
                                        <td>\ <div class="input-group">\
											<input type="number" class="form-control" placeholder="Ukuran Sarana" name="jumlah_sarana[]"> <span class="input-group-text">m<sup>2</sup></span>\ <div>\
										</td>\
									</tr>');
                        }
                        else if(dataCheck.eq(index).hasClass("Pembatas")){
						table.append('<tr data-id="'+dataCheck.eq(index).val()+'">\
										<td>'+dataCheck.eq(index).val()+'</td>\
                                        <td>\ <div class="input-group">\
											<input type="number" class="form-control" placeholder="Ukuran Sarana" name="jumlah_sarana[]"> <span class="input-group-text">m</span>\ <div>\
										</td>\
									</tr>');
                        }
                        else{
						table.append('<tr data-id="'+dataCheck.eq(index).val()+'">\
										<td>'+dataCheck.eq(index).val()+'</td>\
                                        <td>\ <div class="input-group">\
											<input type="number" class="form-control" placeholder="Jumlah Sarana" name="jumlah_sarana[]"> <span class="input-group-text">Unit</span>\ <div>\
										</td>\
									</tr>');
                        }
					}
                    // function incrementValue(e) {
                    //     e.preventDefault();
                    //     var fieldName = $(e.target).data('field');
                    //     var parent = $(e.target).closest('div');
                    //     var currentVal = parseInt(parent.find('input[type=number]').val(), 10);

                    //     if (!isNaN(currentVal)) {
                    //         parent.find('input[type=number]').val(currentVal + 1);
                    //     } else {
                    //         parent.find('input[type=number]').val(1);
                    //     }
                    //     }

                    //     function decrementValue(e) {
                    //     e.preventDefault();
                    //     var fieldName = $(e.target).data('field');
                    //     var parent = $(e.target).closest('div');
                    //     var currentVal = parseInt(parent.find('input[type=number]').val(), 10);

                    //     if (!isNaN(currentVal) && currentVal > 1) {
                    //         parent.find('input[type=number]').val(currentVal - 1);
                    //     } else {
                    //         parent.find('input[type=number]').val(1);
                    //     }
                    //     }

                    //     $('.input-group').on('click', '.button-plus', function(e) {
                    //     incrementValue(e);
                    //     });

                    //     $('.input-group').on('click', '.button-minus', function(e) {
                    //     decrementValue(e);
                    //     });

                    // JUMLAH SARANA

                    // <td>\ <div class="input-group plus-minus-input">\
                    //                             <input type="button" value="-" class="tombol button-minus" data-field="quantity">\
                    //                             <input type="number" step="1" min="1" value="1" name="jumlah_sarana[]" class="quantity-field">\
                    //                             <input type="button" value="+" class="tombol button-plus" data-field="quantity">\</div>\
					// 					</td>\

				});
				$.each(dataUncheck, function (index, value) {
					if (table.find('tr[data-id="' + dataUncheck.eq(index).val() + '"]').length) {
						console.log('ini unchecked : ' + dataUncheck.eq(index).val());
						table.find('tr[data-id="' + dataUncheck.eq(index).val() + '"]').remove();
					}
				});
			})
		})

        
	</script>
@endsection