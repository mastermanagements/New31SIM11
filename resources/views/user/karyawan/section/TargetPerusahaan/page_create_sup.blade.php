@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
   <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
   <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Target Supervisor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-tjp') }}" class="btn btn-primary">Tambah</a>
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah  Target Supervisor Perusahaan</h3>
                        <h5 class="pull-right"><a href="{{ url('Target-Perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-target-sup') }}" method="post">
                      <div class="box-body">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Target Manager </label>&nbsp;<strong style="color: red">*</strong>
                              <select class="form-control select2" style="width: 100%;" name="id_target_man" required>
                                           <option>Pilih Target Manager</option>
                                          @foreach($target_man as $value)
                                              <option value="{{ $value->id }}">Target {{ $value->getJabatan->nm_jabatan }} Tahun {{ $value->tahun }}&nbsp;:&nbsp;{{ $value->target_manager }} &nbsp; jumlah {{ $value->jumlah_target }} &nbsp; per {{ $value->satuan_target }}</option>
                                          @endforeach
                              </select>

                          </div>
                          <div class="form-group">
                              <label>Tahun </label>&nbsp;<strong style="color: red">*</strong>
                              <div class="input-group date">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="tahun" required>
                              </div>

                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Divisi</label>&nbsp;<strong style="color: red">*</strong>
                              <select class="form-control select2" style="width: 100%;" name="id_divisi_p" required>
                                           <option>Pilih Divisi</option>
                                          @foreach($divisi_p as $value)
                                              <option value="{{ $value->id }}">{{ $value->nm_devisi }}</option>
                                          @endforeach
                              </select>

                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1"> Jabatan</label>&nbsp;<strong style="color: red">*</strong>
                              <select class="form-control select2" style="width: 100%;" name="id_jabatan_p" required>
                                           <option>Pilih Jabatan</option>
                                          @foreach($jabatan_p as $value)
                                              @if($value->level_jabatan == 2)
                                              <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                              @endif
                                          @endforeach
                              </select>

                          </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukan Target Supervisor Perusahaan Anda</label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="text" class="form-control" placeholder="Masukan Target Supervisor" name="target_supervisor"  required></input>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukkan Jumlah Target Spesifik </label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="number" class="form-control" placeholder="Masukan Jumlah Target dalam bentuk angka" name="jumlah_target"  required></input>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Satuan Target Per</label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="text" class="form-control" placeholder="Masukan Satuan Target Anda" name="satuan_target"  required></input>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                        </div>
                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
     <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy',
        viewMode: "years",
        minViewMode: "years"
    });
    $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy',
        viewMode: "years",
        minViewMode: "years"
    });

        window.onload = function() {
            CKEDITOR.replace( 'isi_tjp',{
                height: 100
            } );
        };
    </script>
@stop
