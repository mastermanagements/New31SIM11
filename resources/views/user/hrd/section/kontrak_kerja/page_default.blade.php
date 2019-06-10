@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kontrak Kerja
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li @if(Session::get('menu_tes')=='kontrak_kerja')  class="active" @endif><a href="{{ url('Kontrak-Kerja') }}" ><i class="fa fa-book"></i> Daftar Kontrak Kerja </a></li>
                        <li class="@if(Session::get('menu_tes')=='jenis_kontrak') active  @endif pull-right" ><a href="{{ url('jenis-kontrak-kerja') }}" ><i class="fa fa-gear"></i> Jenis Kontrak kerja </a></li>
                    </ul>
                    <div class="tab-content">
                        @if(Session::get('menu_tes')=='kontrak_kerja')
                            @include('user.hrd.section.kontrak_kerja.kt_kerja.page_default')
                        @elseif(Session::get('menu_tes')=='jenis_kontrak')
                            @include('user.hrd.section.kontrak_kerja.kt_kerja.jenispsikotes.page_default')
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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            modalUnggahFile = function(id){
                $('input[name="idKontrak"]').val(id);
               $('#modal-tambah-file-kontrak-kerja').modal('show');
            }

            modalUnggahFileTdd = function(id){
                $('input[name="idKontrakTtd"]').val(id);
               $('#modal-ubah-file-kontrak-kerja').modal('show');
            }
        })
    </script>
@stop