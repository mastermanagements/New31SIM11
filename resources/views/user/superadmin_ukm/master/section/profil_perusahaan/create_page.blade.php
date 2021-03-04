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
           Halaman Tambah Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
		<div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Tambah Data Perusahaan</h3>
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

                       <div class="col-md-6">
                         <div class="form-group">
                             <label for="exampleInputEmail1">Nama Perusahaan</label>
                             <input type="text" class="form-control" placeholder="Masukan Nama Usaha Anda" name="nm_usaha" value="{{ old('nm_usaha') }}" required>
                             <small style="color: red">* Tidak boleh kosong</small>
                         </div>
                             <div class="form-group">
                             <label for="exampleInputEmail1">Singkatan Usaha</label>
                             <input type="text" class="form-control" placeholder="Masukan Singkatan Usaha Anda" name="singkatan_usaha" value="{{ old('singkatan_usaha') }}">
                         </div>
                         <div class="form-group">
                             <label for="exampleInputPassword1">Alamat</label>
                             <textarea class="form-control" placeholder="Masukan alaman usaha anda" name="alamat" value="{{ old('alamat') }}" required></textarea>
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
                             <input type="text" class="form-control" placeholder="Masukan Kode pos" name="kd_pos" value="{{ old('kd_pos') }}">
                              <small style="color: orange">* Isi Jika Ada</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Telepon</label>
                             <input type="text" class="form-control" name="telp" placeholder="Masukan Nomor Telepon Perusahaan" value="{{ old('telp') }}">
                             <small style="color: orange">* Isi Jika Ada</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1"> Handphone</label>
                             <input type="text" class="form-control" name="hp" placeholder="Masukan Nomor Handphone Perusahaan" required value="{{ old('hp') }}">
                             <small style="color: red">* Tidak boleh kosong</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Whatshapp</label>
                             <input type="text" class="form-control" name="wa" placeholder="Masukan Nomor Whatshap Perusahaan" required value="{{ old('wa') }}">
                             <small style="color: red">* Tidak boleh kosong</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Telegram</label>
                             <input type="text" class="form-control" name="teleg" placeholder="Masukan Telegram Perusahaan" value="{{ old('teleg') }}">
                             <small style="color: orange">* Isi Jika Ada</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Fans Page FB</label>
                             <input type="text" class="form-control" name="fp" placeholder="Masukan fans page Perusahaan" value="{{ old('fp') }}">
                             <small style="color: orange">* Isi Jika Ada</small>
                         </div>
                       </div>
                       <!-- /.col -->
                       <div class="col-md-6">
                         <div class="form-group">
                             <label for="exampleInputEmail1">IG</label>
                             <input type="text" class="form-control" name="ig" placeholder="Masukan Instagram Perusahaan" value="{{ old('ig') }}">
                             <small style="color: orange">* Isi Jika Ada</small>
						             </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Twitter</label>
                             <input type="text" class="form-control" name="twitter" placeholder="Masukan twitter Perusahaan" value="{{ old('twitter') }}">
                             <small style="color: orange">* Isi Jika Ada</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Tiktok</label>
                             <input type="text" class="form-control" name="tiktok" placeholder="Masukan tiktok Perusahaan" value="{{ old('tiktok') }}">
                             <small style="color: orange">* Isi Jika Ada</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Email</label>
                             <input type="text" class="form-control" name="email" placeholder="Masukan Email Perusahaan" required value="{{ old('email') }}">
                             <small style="color: red">* Tidak boleh kosong</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Website</label>
                             <input type="text" class="form-control" name="web" placeholder="Masukan Nama Website anda" value="{{ old('web') }}">
                             <small style="color: orange">* isi jika ada</small>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Badan Usaha</label>
                            <div class="form-group">
                              <label>
                                <input type="radio"  name="badan_usaha" class="minimal" value="0" required>&nbsp;PT&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="badan_usaha" class="minimal" value="1">&nbsp;CV&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="badan_usaha" class="minimal" value="2">&nbsp;UD&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="badan_usaha" class="minimal" value="3">&nbsp;Firma&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="badan_usaha" class="minimal" value="4">&nbsp;Koperasi&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="badan_usaha" class="minimal" value="5">&nbsp;Yayasan&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="badan_usaha" class="minimal" value="6">&nbsp;Belum ada&nbsp;
                              </label><br>
                              <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Usaha</label>
                            <div class="form-group">
                              <label>
                                <input type="radio"  name="jenis_usaha" class="minimal" value="0" required>&nbsp;Perdagangan&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="jenis_usaha" class="minimal" value="1">&nbsp;Jasa&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="jenis_usaha" class="minimal" value="2">&nbsp;Perdagangan dan Jasa&nbsp;
                              </label>
                              <label>
                                <input type="radio" name="jenis_usaha" class="minimal" value="3">&nbsp;Manufaktur&nbsp;
                              </label><br>
                              <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Bidang Usaha</label>
                             <input type="text" class="form-control" name="bidang_usaha" placeholder="Bidang Usaha (mis: Kesehatan, Elektronik, Bangunan, kuliner,dll)" required value="{{ old('bidang_usaha') }}">
                             <small style="color: red">* Tidak boleh kosong</small>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Spesifikasi Usaha</label>
                             <input type="text" class="form-control" name="spesifik_usaha" placeholder="Spesifikasi Usaha (mis: Laundry, toko komputer, notaris, toko bangunan, dll)" required value="{{ old('spesifik_usaha') }}">
                             <small style="color: red">* Tidak boleh kosong</small>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Jenis Jasa</label>
                           <div class="form-group">
                            <label>
                               <input type="radio"  name="jenis_jasa" class="minimal" value="0" required>&nbsp;Jasa Murni&nbsp;
                             </label>
                             <label>
                               <input type="radio" name="jenis_jasa" class="minimal" value="1">&nbsp;Jasa & barang&nbsp;
                             </label><br>
                             <small style="color: orange">*Jasa murni, misal: notaris, desain grafis. Jasa & barang misalnya service komputer, jasa laundry, dll.</small>
                           </div>
                         </div>
                           <div class="form-group">
                             <label for="exampleInputEmail1">Jenis Kantor</label>
                             <div class="form-group">
                               <label>
                               <input type="radio"  name="jenis_kantor" class="minimal" value="0" required>&nbsp;Pusat&nbsp;
                                </label>
                                <label>
                               <input type="radio" name="jenis_kantor" class="minimal" value="1">&nbsp;Cabang&nbsp;
                             </label><br>
                             <small style="color: orange">*Jika ada</small>
                            </div>
                           </div>
                           <div class="form-group">
                               <label for="exampleInputFile">Logo Usaha</label>
                               <input type="file" id="exampleInputFile" name="logo" required>
                              <small style="color: red">* Tidak boleh kosong</small>
                           </div>

                       </div>
                       <!-- /.col -->

                     <div class="box-footer">
                        {{csrf_field()}}
                          <button type="submit" class="btn btn-primary pull-right">Submit</button>
                      </div>
					         </form>
                 </div>
                <!-- /.box-body -->

              </div>
               <!-- /.box -->
			 </div>
            <!-- /.col -->
		</div>
       <!-- /.row -->
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
