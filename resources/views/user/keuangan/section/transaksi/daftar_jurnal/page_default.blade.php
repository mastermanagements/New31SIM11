@extends('user.keuangan.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Daftar Jurnal
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                       <li @if(Session::get('menu_transaksi')=="daftar_jurnal") class="active" @else class="pull-right" @endif><a href="{{ url('Daftar-jurnal') }}" ><i class="fa fa-file-o"></i>  Daftar Jurnal</a></li>
					   <li @if(Session::get('menu_transaksi')=="jurnal_umum") class="active pull-right" @else class="pull-right" @endif><a href="{{ url('Jurnal-Umum') }}" ><i class="fa fa-file-o"></i>&nbsp;<font color="#1052EE"><b>Jurnal Umum<b></font></a></li>
                    </ul>
                    <div class="tab-content">
                       
                            @include('user.keuangan.section.transaksi.daftar_jurnal.page')
                      
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
        })

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
    </script>
   
        @include('user.keuangan.section.transaksi.daftar_jurnal.js')
  
@stop