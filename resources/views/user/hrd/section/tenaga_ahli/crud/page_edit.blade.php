@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">


   <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ubah Sertifikasi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-8">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Sertifikasi</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-sertifikasi/'.$sertifikasi->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="id_ky" value="{{ $sertifikasi->id_ky }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lembaga Sertifikat</label>
                                <input type="text" name="lembaga_sertifikasi" class="form-control" id="exampleInputEmail1" value="{{ $sertifikasi->lembaga_sertifikasi }}" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Sertifikat</label>
                                <input type="text" name="no_sertifikat" value="{{ $sertifikasi->no_sertifikat }}" class="form-control" id="exampleInputEmail1"  required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Klasifikasi</label>
                                <input type="text" name="klasifikasi"  value="{{ $sertifikasi->klasifikasi }}" class="form-control" id="exampleInputEmail1"  required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Registrasi</label>
                                <input type="text" name="no_registrasi" value="{{ $sertifikasi->no_registrasi }}" class="form-control" id="exampleInputEmail1"  required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Diterapkan</label>
                                <input type="text" name="ditetapkan" value="{{ $sertifikasi->ditetapkan }}" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Penetapan</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="{{ date('d-m-Y', strtotime($sertifikasi->tgl_penetapan)) }}" id="datepicker"  name="tgl_penetapan" >
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Masa Berlaku</label>
                                <input type="number" name="masa_berlaku" value="{{ $sertifikasi->masa_berlaku }}" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Asosiasi</label>
                                <input type="text" name="asosiasi" value="{{ $sertifikasi->asosiosi }}" class="form-control" id="exampleInputEmail1"  required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Anggota</label>
                                <input type="text" name="no_anggota" value="{{ $sertifikasi->no_anggota }}" class="form-control" id="exampleInputEmail1"  required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Posisi Proyek</label>
                                <input type="text" name="posisi_proyek" value="{{ $sertifikasi->posisi_proyek }}"  class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>



                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
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
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
     <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        //Initialize Select2 Elements
        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            });

            $('.select2').select2()

        })
    </script>
@stop