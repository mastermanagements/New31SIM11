@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
   <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>


   <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kontrak Kerja
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
                        <h3 class="box-title">Formulir Kontrak Kerja</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-kontrak-kerja') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Kontrak</label>
                                <input type="text" name="no_kontrak" class="form-control">
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Karyawan</label>
                                <select class="form-control select2" style="width: 100%;" name="id_ky" required>
                                    @if(empty($karyawan))
                                        <option>Nama Karyawan Masih Kosong</option>
                                    @else
                                        @foreach($karyawan as $value)
                                            <option value="{{ $value->id }}">{{ $value->nama_ky }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Kontrak</label>
                                <select class="form-control select2" style="width: 100%;" name="id_jenis_kontrak" required>
                                    @if(empty($jenis_kontrak))
                                        <option>Rekrutmen Masih Kosong</option>
                                    @else
                                        @foreach($jenis_kontrak as $value)
                                            <option value="{{ $value->id }}">{{ $value->jenis_kontrak }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Masuk </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Mulai Kontrak" name="tgl_masuk" >
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Selesai </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Mulai Kontrak" name="tgl_selesai" >
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea type="text" name="ket" class="form-control"></textarea>
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
            format: 'dd-mm-yyyy'
        });

        $('#datepicker1').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


        //Initialize Select2 Elements
        $(function () {

            CKEDITOR.replace( 'ket',{
                height: 300
            } );

            //iCheck for checkbox and radio inputs
            $('.select2').select2()

        })
    </script>
@stop