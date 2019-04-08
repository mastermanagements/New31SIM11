@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    {{--<link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">--}}

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Arsip
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Arsip</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-arsip/'. $data_arsip->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Arsip</label>
                                <select class="form-control select2" style="width: 100%;" name="id_jenis_arsip" required>
                                    @if(empty($jenis_arsip))
                                        <option>Jenis Proposal Masih Kosong</option>
                                    @else
                                        @foreach($jenis_arsip as $value)
                                            <option value="{{ $value->id }}" @if($data_arsip->id_jenis_arsip == $value->id) selected @endif>{{ $value->jenis_arsip }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan Arsip</label>
                                <textarea name="ket" class="form-control" required>{{ $data_arsip->ket }}</textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">File Arsip</label>
                                <input type="file" id="exampleInputFile" name="file_arsip" required>
                                <small>{{ $data_arsip->file_arsip }}</small>
                                <p class="help-block" style="color:red">*Format file yang disarankan .rar atau .zip</p>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
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
    {{--<script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}
    <script>

//        $('#datepicker').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });
//        $('#datepicker1').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop