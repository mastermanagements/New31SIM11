@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>

    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop



@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Absensi Karyawan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Absensi Bulanan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-absensi/'. $data->id) }}" method="post" >
                            <input type="hidden" name="_method" value="put">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Karyawan</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_ky" required>
                                        @if(empty($data_karyawan))
                                            <option>Data Karyawan Masih Kosong</option>
                                        @else
                                            @foreach($data_karyawan as $value)
                                                <option value="{{ $value->id }}" @if($data->data== $value->id) selected @endif>{{ $value->nama_ky }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Periode </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Mulai Kerja Per Bulan" name="periode" value="{{ date('d-m-Y', strtotime($data->periode)) }}" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Normal Hari</label>
                                    <input class="form-control" name="normal_hari" value="{{ $data->normal_hari }}">
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hadir</label>
                                    <input type="number" class="form-control" name="hadir" value="{{ $data->hadir }}">
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Terlambat Masuk</label>
                                    <input type="number" class="form-control" name="terlambat_masuk" value="{{ $data->terlambat_masuk }}">
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tidak Absen Masuk</label>
                                    <input type="number" class="form-control" name="tdk_absen_m"  value="{{ $data->tidak_absen_m }}">
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tidak Absen Pulang</label>
                                    <input type="number" class="form-control" name="tdk_absen_p" value="{{ $data->tidak_absen_p }}">
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Izin Bulan Ini</label>
                                    <input type="number" class="form-control" name="jum_izin" value="{{ $data->jum_izin }}">
                                    <small style="color: red">* Tidak Boleh Kosong</small>
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
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            viewMode: "months",
            minViewMode: "months"
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