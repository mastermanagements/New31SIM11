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
            Rekruitmen
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
                        <h3 class="box-title">Formulir Pelamar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-lamaran/'.$data->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rekrutmen</label>
                                <select class="form-control select2" style="width: 100%;" name="id_loker" required>
                                    @if(empty($loker))
                                        <option>Rekrutmen Masih Kosong</option>
                                    @else
                                        @foreach($loker as $value)
                                            <option value="{{ $value->id }}">{{ $value->nm_loker }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pelamar</label>
                                <input type="text" name="nm_pel" class="form-control" id="exampleInputEmail1" placeholder="Nama Pelamar" value="{{ $data->nm_pel }}" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Posisi Pelamar</label>
                                <input type="text" name="posisi" class="form-control" id="exampleInputEmail1" placeholder="Nama Pelamar" value="{{ $data->posisi }}" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Lamaran</label>
                                <div class="form-group">
                                    @foreach($jenis_lamaran as $key=>$value)
                                        <label>
                                            <input type="radio"  name="jenis_lamaran" class="minimal" value="{{ $key}}" @if($key==$data->jenis_lamaran) checked @endif required>
                                            {{ $value}}
                                        </label>
                                        <br>
                                    @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                             </div>

                            <div class="form-group">
                                <label>Tanggal Masuk </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal berkas lamaran masuk" value="{{ date('d-m-Y', strtotime($data->tgl_masuk)) }}" name="tgl_masuk" >
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Berkas lamaran</label>
                                <input class="form-control" type="file" name="berkas_lamaran" id="berkas_lamaran" required>
                                <span style="color: red">Nama file :{{ $data->berkas_lamaran }}</span>
                                <br>
                                <small style="color: red">* Tidak boleh kosong</small>
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