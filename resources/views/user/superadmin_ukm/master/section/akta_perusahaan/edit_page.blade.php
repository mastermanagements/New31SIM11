@extends('user.superadmin_ukm.master.master_user')

@section('skin')
  <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Ubah Akta
        </h1>
    </section>
    <!--main content-->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Ubah Akta</h3>
                     <h5 class="pull-right"><a href="{{ url('pengaturan-perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                </div>
                <!-- /.box-header -->

				         <!-- form start -->
                <form role="form" method="post" action="{{ url('update-akta/'.$akta->id) }}" enctype="multipart/form-data">
                    <div class="box-body">
                        @if(!empty(session('message_success')))
                            <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                        @elseif(!empty(session('message_fail')))
                            <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif

                          <div class="col-md-6">
             								<div class="form-group">
             									<label for="exampleInputEmail1">Nomor Akta</label>&nbsp;<strong style="color: red">*</strong>
             									<input type="text" class="form-control" name="no_akta" value="{{ $akta->no_akta }}" required>
                              <input type="hidden" class="form-control" name="id_perusahaan" value="{{ $akta->id_perusahaan }}" required>

             								</div>
                            <div class="form-group">
             									<label for="exampleInputEmail1">Tanggal Akta</label>&nbsp;<strong style="color: red">*</strong>
             									<input type="text" class="form-control" name="tgl_akta" value="{{ date('d-m-Y'), strtotime($akta->tgl_akta)}}" id="datepicker" required>

             								</div>
                            <div class="form-group">
             									<label for="exampleInputEmail1">Notaris</label>&nbsp;<strong style="color: red">*</strong>
             									<input type="text" class="form-control" name="notaris" value="{{ $akta->notaris }}" required>

             								</div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail1">No rak</label>
                              <input type="text" class="form-control" name="no_rak" value="{{ $akta->no_rak }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File scan akta</label>
                                <input type="file" id="exampleInputFile" name="file_akta">
                                <p class="help-block" style="color:red">*Format file yang disarankan .rar dan .zip, kami sarankan agar file rar terpassword untuk kenyamanan anda</p>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Keterangan</label>
                              <input type="text" class="form-control" name="ket" value="{{ $akta->ket }}">
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

                        <!-- /.col -->

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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
        $('#datepicker1').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop
