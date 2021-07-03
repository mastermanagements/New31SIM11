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
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir surat masuk</h3>
							<h5 class="pull-right"><a href="{{ url('Surat')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-surat-masuk/'.$data_surat->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tanggal surat masuk</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" value="{{ date('d-m-Y', strtotime($data_surat->tgl_surat_masuk)) }}" id="datepicker" placeholder="Tanggal surat masuk" name="tgl_surat_masuk" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hal </label>
                                    <input type="text" name="hal" class="form-control" id="exampleInputEmail1" value="{{ $data_surat->hal }}" required>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dari </label>
                                    <input type="text" name="dari" class="form-control" id="exampleInputEmail1" value="{{ $data_surat->dari }}" required>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ditujukan</label>
                                    <select class="form-control select2" style="width: 100%;" name="ditujukan" required>
                                        @if(empty($jabatan))
                                            <option>Jabatan masih kosong</option>
                                        @else
                                            @foreach($jabatan as $value)
                                                <option value="{{ $value->id }}" @if($data_surat->ditujukan == $value->id) selected @endif>{{ $value->nm_jabatan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File scan surat</label>
                                    <input type="file" id="exampleInputFile" name="file_surat" required>
                                    <small>Nama File Surat Masuk Sekarang adalah : {{ $data_surat->file_surat }}</small>
                                    <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png, .gif</p>
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