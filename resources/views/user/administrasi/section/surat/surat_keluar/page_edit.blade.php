@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Surat keluar
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir surat keluar</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-surat-keluar/'.$data_surat_keluar->id) }}" method="post">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Surat</label>
                                    <select class="form-control select2" style="width: 100%;" name="jenis_surat" required>
                                        @if(empty($jenis_surat))
                                            <option>Jabatan masih kosong</option>
                                        @else
                                            @foreach($jenis_surat as $value)
                                                <option value="{{ $value->id }}" @if($data_surat_keluar->jenis_surat == $value->id) selected @endif>{{ $value->jenis_surat_keluar }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Isi Surat </label>
                                    <textarea name="isi_surat" class="form-control" id="isi_surat" required>{!! $data_surat_keluar->isi_surat !!}</textarea>
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

        window.onload = function() {
            CKEDITOR.replace('isi_surat',{
                height: 600
            } );
        };
    </script>
@stop