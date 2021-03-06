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
           Halaman Ubah Usaha
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
                       <h5 class="pull-right"><a href="{{ url('pengaturan-perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('update-usaha/'.$usaha->id) }}" enctype="multipart/form-data">
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif
                        <div class="col-md-6">
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nama Usaha</label>&nbsp;<strong style="color: red">*</strong>
                               <input type="text" class="form-control" placeholder="Masukan Nama Usaha Anda" name="nm_usaha" value="{{ $usaha->nm_usaha }}" required>

                           </div>
                               <div class="form-group">
                               <label for="exampleInputEmail1">Singkatan Usaha</label>&nbsp;<strong style="color: red">*</strong>
                               <input type="text" class="form-control" placeholder="Masukan Singkatan Usaha Anda" name="singkatan_usaha" value="{{ $usaha->singkatan_usaha }}" required>

                           </div>
                           <div class="form-group">
                               <label for="exampleInputPassword1">Alamat</label>&nbsp;<strong style="color: red">*</strong>
                               <textarea class="form-control" placeholder="Masukan alaman usaha anda" name="alamat" required>{{ $usaha->alamat }}</textarea>

                           </div>

                           <div class="form-group">
                               <label for="exampleInputFile">Provinsi</label>&nbsp;<strong style="color: red">*</strong>
                               <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                                   @foreach($provinsi as $value)
                                   <option value="{{ $value->id }}" @if($usaha->id_prov== $value->id) selected @endif>{{ $value->nama_provinsi }}</option>
                                   @endforeach
                               </select>

                           </div>

                           <div class="form-group">
                             <label for="exampleInputFile">Provinsi</label>&nbsp;<strong style="color: red">*</strong>
                             <select class="form-control select2" style="width: 100%;" name="id_kabupaten" required>
                                 @foreach($kabupaten as $value)
                                 <option value="{{ $value->id }}" @if($usaha->id_kab== $value->id) selected @endif>{{ $value->nama_kabupaten}}</option>
                                 @endforeach
                             </select>

                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Kode Pos</label>
                               <input type="text" class="form-control" placeholder="Masukan Kode pos" name="kd_pos" value="{{ $usaha->kode_pos }}">

                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Telepon</label>
                               <input type="text" class="form-control" name="telp" {{ $usaha->telp }} placeholder="Masukan Nomor Telepon Anda">

                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Handphone</label>&nbsp;<strong style="color: red">*</strong>
                               <input type="text" class="form-control" name="hp" value="{{ $usaha->hp }}" placeholder="Masukan Nomor Handphone Anda">

                           </div> <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Whatshap</label>&nbsp;<strong style="color: red">*</strong>
                               <input type="text" class="form-control" name="wa" value="{{ $usaha->wa }}" placeholder="Masukan Nomor Whatshap Anda">

                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Nomor Telegram</label>
                               <input type="text" class="form-control" name="teleg" value="{{ $usaha->teleg}}" placeholder="Masukan Telegram Anda">

                           </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Fans Page FB</label>
                               <input type="text" class="form-control" name="fp" placeholder="Masukan fans page Perusahaan" value="{{ $usaha->fp }}">
                           </div>

                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Twitter</label>
                              <input type="text" class="form-control" name="twitter" placeholder="Masukan twitter Perusahaan" value="{{ $usaha->twitter }}">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">IG</label>
                              <input type="text" class="form-control" name="ig" placeholder="Masukan Instagram Perusahaan" value="{{ $usaha->ig }}">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Tiktok</label>
                              <input type="text" class="form-control" name="tiktok" placeholder="Masukan tiktok Perusahaan" value="{{ $usaha->tiktok }}">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>&nbsp;<strong style="color: red">*</strong>

                              <input type="text" class="form-control" name="email" placeholder="Masukan Email Perusahaan" required value="{{ $usaha->email }}" >
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Website</label>
                              <input type="text" class="form-control" name="web" placeholder="Masukan Nama Website anda" value="{{ $usaha->web}}">
                          </div>
                          <div class="form-group">
                             <label for="exampleInputEmail1">Badan Usaha</label>&nbsp;<strong style="color: red">*</strong>
                             <div class="form-group">
                               <label>
                                 <input type="radio"  name="badan_usaha" @if($usaha->badan_usaha==0) checked @endif class="minimal" value="0" required>&nbsp;PT&nbsp;
                               </label>
                               <label>
                                 <input type="radio" name="badan_usaha" @if($usaha->badan_usaha==1) checked @endif class="minimal" value="1">&nbsp;CV&nbsp;
                               </label>
                               <label>
                                 <input type="radio" name="badan_usaha"  @if($usaha->badan_usaha==2) checked @endif class="minimal" value="2">&nbsp;UD&nbsp;
                               </label>
                               <label>
                                 <input type="radio" name="badan_usaha"  @if($usaha->badan_usaha==3) checked @endif class="minimal" value="3">&nbsp;Firma&nbsp;
                               </label>
                               <label>
                                 <input type="radio" name="badan_usaha"  @if($usaha->badan_usaha==4) checked @endif class="minimal" value="4">&nbsp;Koperasi&nbsp;
                               </label>
                               <label>
                                 <input type="radio" name="badan_usaha"  @if($usaha->badan_usaha==5) checked @endif class="minimal" value="5">&nbsp;Yayasan&nbsp;
                               </label>
                               <label>
                                 <input type="radio" name="badan_usaha"  @if($usaha->badan_usaha==6) checked @endif class="minimal" value="6">&nbsp;Belum ada&nbsp;
                               </label><br>
                             </div>
                          </div>
                           <div class="form-group">
                               <label for="exampleInputEmail1">Jenis Usaha</label>&nbsp;<strong style="color: red">*</strong>
                               <div class="form-group">
                                   <label>
                                       <input type="radio"  name="jenis_usaha" @if($usaha->jenis_usaha==0) checked @endif class="minimal" value="0" required>
                                       Perdagangan
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" @if($usaha->jenis_usaha==1) checked @endif class="minimal" value="1">
                                       Jasa
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" @if($usaha->jenis_usaha==2) checked @endif class="minimal" value="2">
                                       Barang & Jasa
                                   </label>
                                   <label>
                                       <input type="radio" name="jenis_usaha" @if($usaha->jenis_usaha==3) checked @endif class="minimal" value="3">
                                       Manufaktur
                                   </label>                                 
                               </div>

                           </div>
                           <div class="form-group">
                                 <label for="exampleInputEmail1">Status Kantor</label>&nbsp;<strong style="color: red">*</strong>
                                 <div class="form-group">
                                     <label>
                                         <input type="radio"  name="jenis_kantor" @if($usaha->jenis_kantor==0) checked @endif class="minimal" value="0" required>
                                         Pusat
                                     </label>
                                     <label>
                                         <input type="radio" name="jenis_kantor" @if($usaha->jenis_kantor==1) checked @endif class="minimal" value="0">
                                         Cabang
                                     </label>
                                 </div>
                           </div>

                             <div class="form-group">
                                 <label for="exampleInputEmail1">Bidang Usaha</label>&nbsp;<strong style="color: red">*</strong>
                                 <input type="text" class="form-control" name="bidang_usaha"  required value="{{ $usaha->bidang_usaha }}">
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">Spesifikasi Usaha</label>&nbsp;<strong style="color: red">*</strong>
                                 <input type="text" class="form-control" name="spesifik_usaha" required value="{{ $usaha->spesifik_usaha }}">
                             </div>
                             <div class="form-group">
                               <label for="exampleInputEmail1">Jenis Jasa</label>
                               <div class="form-group">
                                <label>
                                   <input type="radio"  name="jenis_jasa" @if($usaha->jenis_jasa==0) checked @endif class="minimal" value="0"> &nbsp;Jasa Murni&nbsp;
                                 </label>
                                 <label>
                                   <input type="radio" name="jenis_jasa" @if($usaha->jenis_jasa==1) checked @endif class="minimal" value="1">&nbsp;Jasa & barang&nbsp;
                                 </label><br>
                                 <strong style="color: green">*Jasa murni, misal: notaris, desain grafis. Jasa & barang misalnya service komputer, jasa laundry, dll.</strong>
                               </div>
                             </div>
                           <div class="form-group">
                               <label for="exampleInputFile">Logo Usaha</label>
                               <input type="file" id="exampleInputFile" name="logo" value="{{ $usaha->logo }}">

                           </div>
                       </div>
                     </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                      <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                      </div>
                       <div class="box-footer">
                           {{csrf_field()}}
                           <input type="hidden" name="_method" value="put"/>
                           <button type="submit" class="btn btn-primary">Simpan</button>
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
