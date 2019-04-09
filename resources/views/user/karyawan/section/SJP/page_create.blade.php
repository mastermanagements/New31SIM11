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
            Strategi Jangka Panjang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-strategi-jangka-panjang') }}" class="btn btn-primary">Buat Strategi Anda</a>
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Strategi</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-sjp') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode</label>
                                <input type="number" min="1" max="50" name="periode" class="form-control" id="exampleInputEmail1" placeholder="Contoh: 5 tahun, 10 tahun, dll" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukan Strategi Jangka Panjang Anda</label>
                                    <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_sjpg" id="isi_sjpg" required></textarea>
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
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'isi_sjpg',{
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