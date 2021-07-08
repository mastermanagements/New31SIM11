@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Mengubah Ijin Usaha
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Ijin Usaha</h3>
                       <h5 class="pull-right"><a href="{{ url('pengaturan-perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('ijin-usaha-update/'.$ijin->id) }}" enctype="multipart/form-data">
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif

                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Usaha</label>&nbsp;<strong style="color: red">*</strong>
                                   <div class="form-group">
                                       @foreach($usaha as $usaha)
                                       <label>
                                           <input type="radio"  name="id_perusahaan" class="minimal" value="{{ $usaha->id}}" @if($usaha->id==$ijin->id_perusahaan) checked @endif required>
                                           {{ $usaha->nm_usaha }}
                                       </label>
                                       @endforeach
                                       <p></p>
                                   <small style="color: red">* Tidak Boleh Kosong</small>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Nama Izin</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="nm_ijin" class="form-control" placeholder="Nama Izin" value="{{ $ijin->nm_ijin }}" required>

                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">No Izin</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="no_ijin" class="form-control" placeholder="No. Izin" value="{{ $ijin->no_ijin }}" required>

                               </div>
                               <div class="form-group">
                                   <label>Tanggal Berlaku:</label>&nbsp;<strong style="color: red">*</strong>

                                   <div class="input-group date">
                                       <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Berlaku" name="berlaku" value="{{ date('d-m-Y', strtotime($ijin->berlaku)) }}" required>
                                   </div>
                                   <!-- /.input group -->

                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Kualifikasi</label>&nbsp;<strong style="color: red">*</strong>
                                   <textarea name="kualifikasi" class="form-control" placeholder="Kualifikasi" required>{{ $ijin->kualifikasi }}</textarea>

                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Instansi Pemberi</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="instansi_pemberi" class="form-control" placeholder="Instansi Pemberi" value="{{ $ijin->instansi_pemberi }}" required>

                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Klasifikasi</label>&nbsp;<strong style="color: red">*</strong>
                                   <textarea name="klasifikasi" class="form-control" placeholder="Klasifikasi" required>{{ $ijin->klasifikasi }}</textarea>

                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">No. Rak</label>
                                   <input name="no_rak" class="form-control" placeholder="No.rak dokumen asli anda simpan" value="{{ $ijin->no_rak }}">
                               </div>

                               <div class="form-group">
                                  <label for="exampleInputFile">File UI</label>
                                   <input type="file" id="exampleInputFile" name="file_iu">
                                   <input type="hidden" id="exampleInputFile" name="file_iu_old" value="{{ $ijin->file_iu }}">
                                   <img src="{{ asset('ijinUsaha/'.$ijin->file_iu) }}" style="width: 100px; height: 100px; margin: 10px">
                                   <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png dan .gif</p>
                               </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                          </div>
                       <div class="box-footer">
                                   <input type="hidden" name="_method" value="put">
                                   {{ csrf_field() }}
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>


        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();

           //Date picker
           $('#datepicker').datepicker({
               autoclose: true,
               format: 'dd-mm-yyyy'
           });




           //iCheck for checkbox and radio inputs
           $('input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           })

       })
    </script>
@stop
