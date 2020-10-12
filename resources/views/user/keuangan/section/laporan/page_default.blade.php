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
                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url('Laporan-keuangan') }}">
                    <i class="fa fa-file-text-o"></i> Jurnal Umum
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url('buku-besar') }}">
                    <i class="fa fa-file-text-o"></i> Buku Besar
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket"  href="{{ url('neraca-saldo') }}">
                    <i class="fa fa-file-text-o"></i> Neraca Saldo
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url('Laba-rugi') }}">
                    <i class="fa fa-file-text-o"></i> Laba Rugi
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url('perubahan-modal') }}">
                    <i class="fa fa-file-text-o"></i> Perubahan Modal
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url('neraca') }}">
                    <i class="fa fa-file-text-o"></i> Neraca
                </a>
            </div>
            <div class="col-md-2" style="padding: 1px">
                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url('arus-kas') }}">
                    <i class="fa fa-file-text-o"></i> Arus Kas
                </a>
            </div>
        </div>
        <div class="row">
            @if(Session::get('menu-laporan-keuangan')=="jurnal_umum")
                @include('user.keuangan.section.laporan.jurnal_umum.page')
            @elseif(Session::get('menu-laporan-keuangan')=="buku_besar")
                @include('user.keuangan.section.laporan.buku_besar.page')
            {{--@elseif(Session::get('menu-laporan-keuangan')=="neraca-saldo")--}}
                {{--@include('user.keuangan.section.laporan.neraca_saldo.page')--}}
            {{--@elseif(Session::get('menu-laporan-keuangan')=="laba-rugi")--}}
                {{--@include('user.keuangan.section.laporan.laba_rugi.page')--}}
            {{--@elseif(Session::get('menu-laporan-keuangan')=="perubahan-modal")--}}
                {{--@include('user.keuangan.section.laporan.perubahan_modal.page')--}}
            {{--@elseif(Session::get('menu-laporan-keuangan')=="neraca")--}}
                {{--@include('user.keuangan.section.laporan.neraca.page')--}}
            {{--@elseif(Session::get('menu-laporan-keuangan')=="arus-kas")--}}
                {{--@include('user.keuangan.section.laporan.arus_kas.page')--}}
            @endif
        </div>

    </section>
    <!-- /.content -->
</div>
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
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
    {{--@elseif(Session::get('menu-laporan-keuangan')=="buku_besar")--}}
        {{--@include('user.keuangan.section.laporan.buku_besar.js')--}}
    {{--@elseif(Session::get('menu-laporan-keuangan')=="neraca-saldo")--}}
        {{--@include('user.keuangan.section.laporan.neraca_saldo.js')--}}
    {{--@elseif(Session::get('menu-laporan-keuangan')=="neraca-saldo")--}}
        {{--@include('user.keuangan.section.laporan.buku_besar.js')--}}
    {{--@elseif(Session::get('menu-laporan-keuangan')=="laba-rugi")--}}
        {{--@include('user.keuangan.section.laporan.laba_rugi.js')--}}
    {{--@elseif(Session::get('menu-laporan-keuangan')=="perubahan-modal")--}}
        {{--@include('user.keuangan.section.laporan.perubahan_modal.js')--}}
    {{--@elseif(Session::get('menu-laporan-keuangan')=="neraca")--}}
        {{--@include('user.keuangan.section.laporan.neraca.js')--}}
    {{--@elseif(Session::get('menu-laporan-keuangan')=="arus-kas")--}}
        {{--@include('user.keuangan.section.laporan.arus_kas.js')--}}
    @endif
@stop