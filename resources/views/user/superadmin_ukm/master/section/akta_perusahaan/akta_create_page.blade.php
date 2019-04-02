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
           Halaman Membuat Akta Usaha
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Akta</h3>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('akta-visi') }}" enctype="multipart/form-data">
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif

                           <div class="form-group">
                               <label for="exampleInputEmail1">Usaha Akta</label>
                                   <div class="form-group">
                                       @foreach($usaha as $usaha)
                                       <label>
                                           <input type="radio"  name="id_perusahaan" class="minimal" value="{{ $usaha->id}}" required>
                                           {{ $usaha->nm_usaha }}
                                       </label>
                                       @endforeach
                                       <p></p>
                                   <small style="color: red">* Tidak Boleh Kosong</small>
                                   </div>
                           </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Nomor Akta</label>
                                   <input name="no_akta" class="form-control" placeholder="No. Akta" required>
                                   <small style="color: red">* Tidak boleh kosong</small>
                               </div>
                               <div class="form-group">
                                   <label>Date:</label>

                                   <div class="input-group date">
                                       <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Akta" name="tgl_akta" required>
                                   </div>
                                   <!-- /.input group -->
                                   <small style="color: red">* Tidak boleh kosong</small>
                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Notaris</label>
                                   <input name="notaris" class="form-control" placeholder="Nama Notaris" required>
                                   <small style="color: red">* Tidak boleh kosong</small>
                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Bentuk Usaha</label>
                                   <input name="bentuk_usaha" class="form-control" placeholder="CV, PT, Dll" required>
                                   <small style="color: red">* Tidak boleh kosong</small>
                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">No. Rak</label>
                                   <input name="no_rak" class="form-control" placeholder="No.rak akta asli anda simpan">
                               </div>
                               <div class="form-group">
                                   <label for="exampleInputFile">File Akta</label>
                                   <input type="file" id="exampleInputFile" name="file_akta" required>
                                   <p class="help-block" style="color:red">*Format file yang disarankan .rar dan .zip, kami sarankan agar file rar terpassword untuk kenyamanan anda</p>
                               </div>
                               <div class="box-footer">
                           {{csrf_field()}}
                           <button type="submit" class="btn btn-primary">Submit</button>
                       </div>
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