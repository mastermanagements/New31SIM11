@extends('user.keuangan.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transaksi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li @if(Session::get('menu_transaksi')=="penerimaan") class="active" @endif ><a href="{{ url('Transaksi') }}" >Penerimaan</a></li>
                        <li @if(Session::get('menu_transaksi')=="pengeluaran") class="active" @endif><a href="#tab_2" >Pengeluaran</a></li>
                    </ul>
                    <div class="tab-content">
                        @if(Session::get('menu_transaksi')=="penerimaan")
                            @include('user.keuangan.section.transaksi.penerimaan.page')
                        @else
                            @include('user.keuangan.section.transaksi.pengeluaran.page')
                        @endif
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@stop

@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        })
    </script>
    @if(Session::get('menu_transaksi')=="penerimaan")
        @include('user.keuangan.section.transaksi.penerimaan.Js')
    @else
        {{--@include('user.keuangan.section.transaksi.pengeluaran.page')--}}
    @endif
@stop