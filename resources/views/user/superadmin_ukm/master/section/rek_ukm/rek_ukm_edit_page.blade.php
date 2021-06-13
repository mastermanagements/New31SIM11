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
           Halaman Ubah Rekening Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Rekening Perusahaan</h3>
                       <h5 class="pull-right"><a href="{{ url('pengaturan-perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('update-rek-ukm/'.$rek_ukm->id) }}" enctype="multipart/form-data">
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif
                        <div class="col-md-6">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Usaha</label>
                                       <div class="form-group">
                                           @foreach($usaha as $usaha)
                                           <label>
                                               <input type="radio"  name="id_perusahaan" class="minimal" value="{{ $usaha->id}}" @if($usaha->id==$rek_ukm->id_perusahaan) checked @endif required>
                                               {{ $usaha->nm_usaha }}
                                           </label>
                                           @endforeach
                                           <p></p>
                                       <small style="color: red">* Tidak Boleh Kosong</small>
                                       </div>
                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Nama Bank</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="nama_bank" class="form-control" placeholder="Nama Bank" value="{{ $rek_ukm->nama_bank }}" required>

                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">No Rekening</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="no_rek" class="form-control" placeholder="No. Rekening" value="{{ $rek_ukm->no_rek }}" required>

                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Atas Nama</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="atas_nama" class="form-control" placeholder="Pemilik Rekening" value="{{ $rek_ukm->atas_nama }}" required>

                               </div>
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Kantor Cabang</label>&nbsp;<strong style="color: red">*</strong>
                                   <input name="kcp" class="form-control" placeholder="Kantor Cabang" value="{{ $rek_ukm->kcp }}" required>
                               </div>
                            </div>
                          </div>
                          <div class="box-footer">
                            <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                          </div>
                        <div class="box-footer">
                                   <input type="hidden" name="_method" value="put">
                                   {{ csrf_field() }}
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
