@extends('user.keuangan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row" style="padding: 15px">
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket">
                    <i class="fa fa-file-text-o"></i> Jurnal Umum
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket">
                    <i class="fa fa-file-text-o"></i> Buku Besar
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket">
                    <i class="fa fa-file-text-o"></i> Neraca Saldo
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket">
                    <i class="fa fa-file-text-o"></i> Laba Rugi
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket">
                    <i class="fa fa-file-text-o"></i> Perubahan Modal
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket">
                    <i class="fa fa-file-text-o"></i> Neraca
                </a>
            </div>
        </div>
        <div class="row">
            @if(Session::get('menu-laporan-keuangan')=="jurnal_umum")
                @include('user.keuangan.section.laporan.jurnal_umum.page')
            @endif
        </div>

    </section>
    <!-- /.content -->
</div>
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $('#datepicker1').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
        })
    </script>
    @if(Session::get('menu-laporan-keuangan')=="jurnal_umum")
        @include('user.keuangan.section.laporan.jurnal_umum.js')
    @endif
@stop