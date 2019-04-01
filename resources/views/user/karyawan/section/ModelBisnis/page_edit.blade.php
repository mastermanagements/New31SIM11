@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Model Bisnis
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
         <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Model Bisnis</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('ubah-mb/'.$mb->id) }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Model Bisnis</label>
                                <input type="text" name="nm_mb" class="form-control" id="exampleInputEmail1" value="{{ $mb->nm_mb }}" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sasaran</label>
                                <textarea class="form-control" placeholder="Masukan sasaran Anda" name="sasaran" id="sasaran" required>
                                {!! $mb->sasaran !!}
                                    </textarea>
                                <small style="color: red">* Tidak boleh kosong</small>
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
     <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'sasaran',{
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