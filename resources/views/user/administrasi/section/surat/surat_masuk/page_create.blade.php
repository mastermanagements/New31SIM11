@extends('user.administrasi.master_user')

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
            Surat masuk
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir surat masuk</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-surat-masuk') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Tanggal surat masuk</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal surat masuk" name="tgl_surat_masuk" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hal </label>
                                <input type="text" name="hal" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dari </label>
                                <input type="text" name="dari" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Ditujukan</label>
                                <select class="form-control select2" style="width: 100%;" name="ditujukan" required>
                                    @if(empty($jabatan))
                                        <option>Jabatan masih kosong</option>
                                    @else
                                        @foreach($jabatan as $value)
                                            <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File scan surat</label>
                                <input type="file" id="exampleInputFile" name="file_surat">
                                <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png, .gif</p>
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