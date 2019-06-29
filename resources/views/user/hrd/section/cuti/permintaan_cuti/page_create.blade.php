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
            Permintaan Cuti
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
                        <h3 class="box-title">Formulir Permintaan Cuti</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-permintaan-cuti') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Periode </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun Cuti" name="tgl_req" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Jenis Izin</label>
                                <p>
                                @foreach($jenis_izin as $key => $value)
                                    <input type="radio" class="minimal" name="jenis_izin" value="{{ $key }}"> {{ $value }}
                                @endforeach
                                </p>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Pengaturan Cuti</label>
                                <select class="form-control select2" style="width: 100%;" name="id_cuti" required>
                                    @if(empty($data_h_cuti))
                                        <option>Pengaturan cuti Masih Kosong</option>
                                    @else
                                        <option value="null">Izin/Sakit</option>
                                        @foreach($data_h_cuti as $value)
                                            <option value="{{ $value->id }}">{{ $value->pengaturan_cuti->nm_cuti }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Permintaan Berhapa hari cuti</label>
                                <input type="number" name="lama_request" class="form-control">
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Status</label>
                                <p>
                                    @foreach($upprove as $key => $value)
                                        <input type="radio" class="minimal" name="upprove" value="{{ $key }}"> {{ $value }}
                                    @endforeach
                                </p>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Atasan</label>
                                <select class="form-control select2" style="width: 100%;" name="atasan" required>
                                    @if(empty($karyawan))
                                        <option>Pengaturan cuti Masih Kosong</option>
                                    @else
                                        @foreach($karyawan as $value)
                                            <option value="{{ $value->id }}">{{ $value->nama_ky }}</option>
                                        @endforeach
                                    @endif
                                </select>
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