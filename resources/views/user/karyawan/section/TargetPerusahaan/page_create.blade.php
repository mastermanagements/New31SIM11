@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
   <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
   <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Target Jangka Panjang Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-tjp') }}" class="btn btn-primary">Buat Target Jangka Panjang Perusahaan Anda</a>
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah  Target Jangka Panjang Perusahaan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-tjp') }}" method="post">
                        <div class="box-body">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Jangka Waktu</label>
                              <input type="number" max="50" name="periode" class="form-control" id="exampleInputEmail1" placeholder="Berapa Tahun Anda Akan Mencapai Goal Tersebut?, Tulis angka Tahunnya" required>
                              <small style="color: red">* Tidak Boleh Kosong</small>
                          </div>
                          <div class="form-group">
                              <label>Tahun Mulai</label>
                              <div class="input-group date">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="thn_mulai" required>
                              </div>
                              <!-- /.input group -->
                            <small style="color: red">* Tidak Boleh Kosong</small>
                          </div>
                            <div class="form-group">
                                <label>Tahun selesai</label>
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="datepicker2" placeholder="Tahun" name="thn_selesai" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukan Target Jangka Panjang Perusahaan Anda</label>
                                    <textarea class="form-control" placeholder="Masukan Target Jngka Panjang Perusahaan Anda" name="target_puncak" id="isi_tjp" required></textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukkan Jumlah Target Spesifik</label>
                                    <input type="number" class="form-control" placeholder="Masukan Jumlah Target Anda dalam bentuk angka" name="jumlah_target"  required></input>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Satuan Target Per</label>
                                    <input type="text" class="form-control" placeholder="Masukan Satuan Target Anda" name="satuan_target"  required></input>
                                    <small style="color: red">* Tidak boleh kosong</small>
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
