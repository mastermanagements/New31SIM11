@extends('user.karyawan.master_user')

@section('skin')
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Rencana Pelatihan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Rencana Pelatihan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-rencana-pelatihan/'. $data->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Periode </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun Anggaran" value="{{ date('Y',strtotime($data->thn_anggaran)) }}" name="thn_anggaran" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Tema Pelatihan</label>
                                    <textarea id="alasan" class="form-control" name="tema"> {{ $data->tema }}</textarea>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Pelatihan </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Pelatihan" value="{{ date('d-m-Y', strtotime($data->tgl_pelatihan)) }}" name="tgl_pelatihan" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label>Biaya </label>
                                    <input type="number" min="0" class="form-control"  placeholder="Biaya Pelatihan" value="{{ $data->biaya }}" name="biaya" required>
                                    <!-- /.input group -->
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
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

        $('#datepicker1').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });



    </script>
@stop