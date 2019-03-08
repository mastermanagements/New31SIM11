@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Halaman Ubah Jabatan {{ $usaha->nm_usaha }}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Jabatan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-jabatan/'. $jabatan->id) }}" enctype="multipart/form-data">
                            <div class="box-body">
                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <input type="text" class="form-control" placeholder="Masukan Nama Jabatan Anda" value="{{ $jabatan->nm_jabatan }}" name="nm_jabatan" required>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tingkatan (Level) Jabatan</label>
                                    <div class="form-group">
                                        <label>
                                            <input type="radio"  name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==0) checked @endif value="0" required>
                                            Direktur/CEO/Dirut/Pimpinan
                                        </label>
                                        <label>
                                            <input type="radio" name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==1) checked @endif value="1">
                                            Bagian Administrasi
                                        </label>
                                        <label>
                                            <input type="radio" name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==2) checked @endif value="2">
                                            Bagian Produk
                                        </label>
                                        <label>
                                            <input type="radio" name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==3) checked @endif value="3">
                                            Bagian Marketing
                                        </label>
                                        <label>
                                            <input type="radio" name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==4) checked @endif value="4">
                                            Bagian Keuangan
                                        </label>
                                        <label>
                                            <input type="radio" name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==5) checked @endif value="5">
                                            Bagian HRD
                                        </label>
                                        <label>
                                            <input type="radio" name="level_jabatan" class="minimal" @if($jabatan->level_jabatan==5) checked @endif value="6">
                                            Bagian Penggajian
                                        </label>
                                    </div>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                            </div>
                            <div class="box-footer">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="id_perusahaan" value="{{ $usaha->id }}" required>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.box -->
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
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $(function () {
            $('.select2').select2();

            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            });
        })
    </script>
@stop