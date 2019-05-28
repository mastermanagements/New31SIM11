@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jobs Decs
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
                        <h3 class="box-title">Formulir Job Decs</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-JD') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pilih Jabatan</label>
                                <select class="form-control select2" style="width: 100%;" name="id_jabatan_p" required>
                                             <option>Pilih Jabatan</option>
											@foreach($jabatan as $value)
                                                <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                            @endforeach
                                </select>
                                <small style="color: red" id="notify"></small>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukan Job Decs Anda</label>
                                    <textarea class="form-control"  name="job_desc" id="job_desc" required>

                                    </textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
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
     <!-- iCheck 1.0.1 -->
     <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });
        window.onload = function() {
            CKEDITOR.replace( 'job_desc',{
                height: 600
            } );
        };

        //Initialize Select2 Elements
//        $(function () {
//
//            //iCheck for checkbox and radio inputs
//            $('input[type="radio"].minimal').iCheck({
//                checkboxClass: 'icheckbox_minimal-blue',
//                radioClass   : 'iradio_minimal-blue'
//            })
//
//        })
    </script>
@stop