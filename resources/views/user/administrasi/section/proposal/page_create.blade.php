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
            Proposal
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Proposal</h3>
						<h5 class="pull-right"><a href="{{ url('Surat')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-proposal') }}" method="post">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Proposal</label>
                                <select class="form-control select2" style="width: 100%;" name="id_jenis_prop" required>
                                    @if(empty($jenis_proposal))
                                        <option>Jenis Proposal Masih Kosong</option>
                                    @else
                                        @foreach($jenis_proposal as $value)
                                            <option value="{{ $value->id }}">{{ $value->jenis_proposal }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul Proposal </label>
                                <input type="text" name="judul_prop" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Proposal</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Proposal" name="tgl_prop" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ditujukan </label>
                                <input type="text" name="ditujukan" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputFile">File scan surat</label>--}}
                                {{--<input type="file" id="exampleInputFile" name="file_surat" required>--}}
                                {{--<p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png, .gif</p>--}}
                            {{--</div>--}}

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