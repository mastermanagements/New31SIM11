@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Tambah Usaha
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Usaha</h3>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('store-usaha') }}" enctype="multipart/form-data">
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nama Usaha</label>
                               <input type="text" class="form-control" placeholder="Masukan Nama Usaha Anda" name="nm_usaha" required>
                               <small style="color: red">* Tidak boleh kosong</small>
                           </div>
                               <div class="form-group">
                               <label for="exampleInputEmail1">Singkatan Usaha</label>
                               <input type="text" class="form-control" placeholder="Masukan Singkatan Usaha Anda" name="singkatan_usaha" required>
                               <small style="color: red">* Tidak boleh kosong</small>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputPassword1">Alamat</label>
                               <textarea class="form-control" placeholder="Masukan alaman usaha anda" name="alamat" required></textarea>
                               <small style="color: red">* Tidak boleh kosong</small>
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
                               <label for="exampleInputEmail1">Kode Pos</label>
                               <input type="text" class="form-control" placeholder="Masukan Kode pos" name="kd_pos">
                                <small style="color: orange">* Isi Jika Ada</small>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Telepon</label>
                               <input type="text" class="form-control" name="telp" placeholder="Masukan Nomor Telepon Anda">
                               <small style="color: orange">* Isi Jika Ada</small>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Handphone</label>
                               <input type="text" class="form-control" name="hp" placeholder="Masukan Nomor Handphone Anda" required>
                               <small style="color: red">* Tidak boleh kosong</small>
							   
                           </div> <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Whatshapp</label>
                               <input type="text" class="form-control" name="wa" placeholder="Masukan Nomor Whatshap Anda" required>
								<small style="color: red">* Tidak boleh kosong</small>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Telegram</label>
                               <input type="text" class="form-control" name="teleg" placeholder="Masukan Telegram Anda">
                               <small style="color: orange">* Isi Jika Ada</small>
                           </div>

                           <div class="form-group">
                               <label for="exampleInputEmail1">Jenis Usaha</label>
                               <div class="form-group">
                                   <label>
                                       <input type="radio"  name="jenis_usaha" class="minimal" value="0" required>
                                       Perdagangan
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" class="minimal" value="1">
                                       Jasa
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" class="minimal" value="2">
                                       Barang & Jasa
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" class="minimal" value="3">
                                       Manufaktur
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" class="minimal" value="4">
                                       Pertanian
                                   </label>
								   <label>
                                       <input type="radio" name="jenis_usaha" class="minimal" value="5">
                                       Kuliner
                                   </label>
                               </div>
                               <small style="color: red">* Tidak Boleh Kosong</small>
                           </div>

                           <div class="form-group">
                               <label for="exampleInputEmail1">Email</label>
                               <input type="email" class="form-control" name="email" placeholder="Masukan email Anda" required>
                               <small style="color: red">* Tidak Boleh Kosong</small>
                           </div>

                       <div class="form-group">
                           <label for="exampleInputEmail1">Website</label>
                           <input type="text" class="form-control" name="web" placeholder="Masukan Nama Website anda">
                           <small style="color: orange">* isi jika ada</small>
                       </div>
                       <!-- /.box-body -->
                       <div class="form-group">
                           <label for="exampleInputFile">Logo Usaha</label>
                           <input type="file" id="exampleInputFile" name="logo" required>
                           <p class="help-block" style="color:red">* Tidak Boleh Kosong</p>
                       </div>

                       </div>
                       <div class="box-footer">
                           {{csrf_field()}}
                           <button type="submit" class="btn btn-primary">Submit</button>
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
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();

           //iCheck for checkbox and radio inputs
           $('input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           });

           $('[name="id_provinsi"]').change(function () {
               $.ajax({
                   url:"{{ url('getKabupaten') }}/" + $(this).val(),
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