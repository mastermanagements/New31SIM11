@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Halaman Ubah Data Kompetitor
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Kompetitor</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-kompetitor/'.$data_kompetitor->id) }}" enctype="multipart/form-data">
                            <div class="box-body">

                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input name="nm_kompetitor" class="form-control" placeholder="Nama Investor" value="{{ $data_kompetitor->nm_kompetitor }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Badan Hukum</label>
                                        <input name="badan_hukum" class="form-control" placeholder="Nama Investor" value="{{ $data_kompetitor->badan_hukum }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Bidang Usaha</label>
                                        <input name="bidang_usaha" class="form-control" placeholder="Nama Investor" value="{{ $data_kompetitor->bidang_usaha }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat</label>
                                        <textarea name="alamat" class="form-control" placeholder="Nomor KTP" required>{{ $data_kompetitor->alamat }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Provinsi</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                                            <option>Pilih Provinsi</option>
                                            @foreach($provinsi as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $data_kompetitor->id_prov ? 'selected' : '' }}>{{ $value->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Kabupaten</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_kabupaten" required>
                                            <option>Pilih Kabupaten</option>
											@foreach($kabupaten as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $data_kompetitor->id_kab ? 'selected' : '' }}>{{ $value->nama_kabupaten }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									 <div class="form-group">
                                        <label for="exampleInputEmail1">CP</label>
                                        <input name="cp" class="form-control" placeholder="Contact Person" value="{{ $data_kompetitor->cp }}">
                                       
                                    </div>
									 <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor. Handphone Telp</label>
                                        <input name="telp" class="form-control" placeholder="Nomor. Telp" value="{{ $data_kompetitor->telp }}">
                                       
                                    </div>
									 <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor. Handphone</label>
                                        <input name="hp" class="form-control" placeholder="Nomor. Handphone" value="{{ $data_kompetitor->hp }}">
                                        
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Nomor. Whatshapp</label>
                                        <input name="wa" class="form-control" placeholder="Nomor. Whatshapp" value="{{ $data_kompetitor->wa }}">
                                        
                                    </div>
									 <div class="form-group">
                                        <label for="exampleInputEmail1">Telegram</label>
                                        <input name="teleg" class="form-control" placeholder="Telegram" value="{{ $data_kompetitor->teleg }}">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input name="email" class="form-control" placeholder="Email" value="{{ $data_kompetitor->email }}">
                                       
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Web</label>
                                        <input name="web" class="form-control" placeholder="Web" value="{{ $data_kompetitor->web }}">
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">FB</label>
                                        <input name="akun_fb" class="form-control" placeholder="FB" value="{{ $data_kompetitor->akun_fb }}">
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">FB</label>
                                        <input name="fanspages" class="form-control" placeholder="Fans Page" value="{{ $data_kompetitor->fanspages }}">
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Twitter</label>
                                        <input name="twitter" class="form-control" placeholder="Twitter" value="{{ $data_kompetitor->twitter }}">
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Instagram</label>
                                        <input name="ig" class="form-control" placeholder="Instagram" value="{{ $data_kompetitor->ig }}">
                                    </div>
									<div class="form-group">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="put">
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">

                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
@stop

@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        //Initialize Select2 Elements
        $(function () {
            $('.select2').select2();

            $('[name="id_provinsi"]').change(function () {
                $.ajax({
                    url:"{{ url('getKabupatenK') }}/" + $(this).val(),
                    dataType: "json",
                    success: function (result) {
                        var option="<option>Pilih Kabupaten</option>";
                        $.each(result, function (id, val) {
                            option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
							
                        });
                        $('[name="id_kabupaten"]').html(option);
                    }
                })
            })

        })
    </script>
@stop