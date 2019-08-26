@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kompetitor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Data Kompetitor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-kompetitor') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kompetitor</label>
                                <input type="text" name="nm_kompetitor" class="form-control" placeholder="Nama Kompetitor" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Badan Hukum</label>
                                <input type="text" name="badan_hukum" class="form-control" placeholder="Nama Kompetitor" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Bidang Usaha</label>
                                <input type="text" name="bidang_usaha" class="form-control" placeholder="Nama Kompetitor" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
								<textarea name="alamat" class="form-control" id="alamat_k" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Provinsi</label>
                                   <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                                        <option>Pilih Provinsi</option>
                                         @foreach($provinsi as $value)
                                           <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Kabupaten</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_kabupaten" required>
                                        <option>Pilih Kabupaten</option>
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kontak Person</label>
                                <input type="text" name="cp" class="form-control" placeholder="Nomor Kontak Person" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Telepon</label>
                                <input type="text" name="telp" class="form-control" placeholder="No. Telepon Supplier" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone </label>
                                <input type="text" name="hp" class="form-control" placeholder="No. Handphone Supplier" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. WA</label>
                                <input type="text" name="wa" class="form-control" placeholder="No. Whatsapp" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">No. Telegram</label>
                                <input type="text" name="teleg" class="form-control" placeholder="No. Telegram" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Web</label>
                                <input type="text" name="web" class="form-control" placeholder="Web" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Akun FB</label>
                                <input type="text" name="akunfb" class="form-control" placeholder="FB" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Fans Page</label>
                                <input type="text" name="fanpages" class="form-control" placeholder="Fans Page" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Twitter</label>
                                <input type="text" name="twitter" class="form-control" placeholder="Twitter" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">IG</label>
                                <input type="text" name="ig" class="form-control" placeholder="Instagram" />
                                <small style="color: orange">* Isi Jika ada</small>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
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