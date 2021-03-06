@extends('admin.mainlayout')

@section('title','Indeks | Admin IMB')

@section('container')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Indeks</a></li>
        </ol>
    </div>
</div>
            <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Data Indeks</h4>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div class="search mr-2">
                                <form action="/dashboard/indeks">
                                    @if(request('parameter'))
                                        <input type="hidden" name="parameter" value="{{request('parameter')}}">
                                    @endif
                                    <div class="input-group">
                                        <input class="form-control border-end-0 border" type="search" placeholder="Search" id="example-search-input" aria-describedby="button-addon2" name="search" value="{{request('search')}}">
                                        <span class="input-group-append">
                                            <button class="btn btn-outline-secondary border-start-0 border-bottom-0 border" type="submit" >
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        <!-- Example single danger button -->
                            <div class="basic-dropdown">
                                <div class="dropdown">
                                    @if(request('parameter'))
                                    <button type="button" class="btn btn-secondary shadow-sm dropdown-toggle" data-toggle="dropdown">{{request('parameter')}}</button>
                                    @else
                                    <button type="button" class="btn btn-secondary shadow-sm dropdown-toggle" data-toggle="dropdown">Semua Indeks</button>
                                    @endif
                                    <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/dashboard/indeks">Semua</a>
                                            <a class="dropdown-item" href="/dashboard/indeks?parameter=fungsi">Fungsi</a>
                                            <a class="dropdown-item" href="/dashboard/indeks?parameter=klasifikasi">Klasifikasi</a>
                                            <a class="dropdown-item" href="/dashboard/indeks?parameter=waktu">Waktu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ModalIndeks">
                            Tambahkan Data Indeks
                        </button>
                    </div>
                    <!-- Modal end -->
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered zero-configuration text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    @if(request('parameter') == "klasifikasi")
                                    <th>Kategori</th>
                                    @elseif(!request('parameter'))
                                    <th>Kategori</th>
                                    @endif
                                    <th>Tingkatan</th>
                                    <th>Bobot</th>
                                    <th>Parameter</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tabel_edit">
                                @foreach ($indeks as $indek)
                                <tr>
                                    <td>{{$loop->iteration}}</td> 
                                    @if (!request('parameter'))
                                        @if ($indek->kategori_indeks_id == null)
                                            <td>-</td>
                                        @else
                                            <td>{{$indek->kategori_indeks->nama}}</td>
                                        @endif 
                                    @elseif (request('parameter') == "klasifikasi")
                                        <td>{{$indek->kategori_indeks->nama}}</td>
                                    @endif
                                    <td class="text-left">{{$indek->tingkatan}}</td>
                                    <td>{{$indek->bobot_indeks}}</td>
                                    <td>{{$indek->parameter}}</td>
                                    <td>
                                    @if ($indek->status == true)
                                        <a href="{{ route('edit_keaktifan', $indek->id) }}" class="label label-success"
                                            data-toggle="modal" data-target="#editStatus_{{$indek->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Nonaktifkan">
                                            Aktif
                                        </a> 
                                        @else
                                        <a href="{{ route('edit_keaktifan', $indek->id) }}" class="label label-danger"
                                            data-toggle="modal" data-target="#editStatus_{{$indek->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Aktifkan">
                                            Nonaktif
                                        </a>
                                        @endif
                                        <div class="modal fade" id="editStatus_{{$indek->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                @if($indek->status == 1)
                                                    <h4 class="modal-title">Nonaktifkan Data {{$indek->nama}}</h4>
                                                @else
                                                    <h4 class="modal-title">Aktifkan Data {{$indek->nama}}</h4>
                                                @endif
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="post" action="indeks/{{$indek->id}}">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-group"> 
                                                    @if($indek->status == true)
                                                        <p>Saat ini data Anda sedang dalam keadaan Aktif. Apakah Anda yakin untuk menonaktifkan data ini?</p>
                                                    @else
                                                        <p>Saat ini data Anda sedang dalam keadaan Nonaktif. Apakah Anda yakin untuk mengaktifkan data ini?</p>
                                                    @endif
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" >Ya </button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="dashboard/indeks/{{$indek->id}}" class="label label-secondary button_edit m-1"
                                            data-toggle="modal" data-target="#edit_{{$indek->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- The Modal Edit -->
                                        <div class="modal fade " id="edit_{{$indek->id}}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body text-left">
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
                                                                <select class="form-control edit_select @error('parameter') is-invalid @enderror"
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
                                                                @error('parameter')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                         
                                                            <div class="form-group mt-2 kategori" style="display:{{ ($indek->kategori_indeks_id == null) ? 'none' : 'block' }}">
                                                                <label for="kategori_indeks_id">Kategori</label>
                                                                <select class="form-control @error('kategori_indeks_id') is-invalid @enderror"
                                                                    aria-label=".form-select-sm example"
                                                                    name="kategori_indeks_id"
                                                                    value="{{$indek->kategori_indeks->nama}}">
                                                                    <option selected value="">
                                                                        Pilih Kategori
                                                                    </option>
                                                                    @foreach ($kategori as $ktgr)
                                                                    @if($ktgr->id == $indek->kategori_indeks->id)
                                                                    <option selected value="{{$ktgr->id}}">
                                                                        {{$ktgr->nama}}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{$ktgr->id}}">{{$ktgr->nama}}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('kategori_indeks_id')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="tingkatan">Tingkatan</label>
                                                                <input type="text" class="form-control @error('tingkatan') is-invalid @enderror" id="tingkatan"
                                                                    value="{{$indek->tingkatan}}" name="tingkatan">
                                                                @error('tingkatan')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="bobot_indeks">Bobot</label>
                                                                <input type="text" class="form-control @error('bobot_indeks') is-invalid @enderror" id="bobot_indeks"
                                                                    value="{{$indek->bobot_indeks}}" name="bobot_indeks">
                                                                @error('bobot_indeks')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text-area" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                                                    value="{{$indek->keterangan}}" name="keterangan">
                                                                @error('keterangan')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-4">
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="dashboard/indeks/{{$indek->id}}" class="label label-primary" data-toggle="modal" 
                                          data-target="#detail_{{$indek->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                          <i class="fa fa-search"></i>
                                        </a>
                                      <!-- Modal -->
                                        <div class="modal fade" id="detail_{{$indek->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Keterangan</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                <p>{{$indek->keterangan}}</p>
                                                </div>
                                                <!-- Modal footer -->
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Modal end -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{$indeks->links()}}
                    </div>
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
                                            <select class="form-control @error('parameter') is-invalid @enderror" aria-label=".form-select-sm example" name="parameter"
                                                id="parameter">
                                                <option value="fungsi">Fungsi</option>
                                                <option value="klasifikasi">Klasifikasi</option>
                                                <option value="waktu">Waktu</option>
                                            </select>
                                            @error('parameter')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group" id="kategori_indeks">
                                            <label for="kategori_indeks_id">Kategori</label>
                                            <select class="form-control @error('kategori_indeks_id') is-invalid @enderror" value="{{ @old('kategori_indeks_id') }}" aria-label=".form-select-sm example"
                                                name="kategori_indeks_id" id="kategori_indeks_id">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $ktgr)
                                                <option value="{{$ktgr->id}}">{{$ktgr->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori_indeks_id')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="tingkatan">Tingkatan</label>
                                            <input type="text" class="form-control @error('tingkatan') is-invalid @enderror" value="{{ @old('tingkatan') }}" id="tingkatan"
                                                name="tingkatan">
                                            @error('tingkatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="bobot_indeks">Bobot</label>
                                            <input type="text" class="form-control @error('bobot_indeks') is-invalid @enderror" value="{{ @old('bobot_indeks') }}" id="bobot_indeks" 
                                                name="bobot_indeks">
                                            @error('bobot_indeks')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" value="{{ @old('keterangan') }}" id="keterangan"
                                                name="keterangan">
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">Simpan </button>
                                        </div>
                                    </form>
                                <div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('.edit_select').on('change', function () {
            if ($(this).val() == 'klasifikasi') {
                $(this).parents('.modal').find('.kategori').show();
            } else {
                $(this).parents('.modal').find('.kategori').hide();
            }
        })

        $('#parameter').on('change', function () {
            if ($(this).val() == 'klasifikasi') {
                $(this).parents('.modal').find('#kategori_indeks').show();
            } else {
                $(this).parents('.modal').find('#kategori_indeks').hide();
            }
        })
        
        $('[data-bs-toggle="tooltip"]').tooltip();   
    });

</script>

@endsection