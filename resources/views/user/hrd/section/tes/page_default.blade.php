@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Tes
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
                        <li @if(Session::get('menu_tes')=='psikotes')  class="active" @endif><a href="{{ url('Tes') }}" ><i class="fa fa-book"></i> Psikotes </a></li>
                        <li @if(Session::get('menu_tes')=='keahlian')  class="active" @endif><a href="{{ url('Keahlian') }}" ><i class="fa fa-book"></i> Keahlian </a></li>
                        <li @if(Session::get('menu_tes')=='wawancara')  class="active" @endif><a href="{{ url('Wawancara') }}" ><i class="fa fa-book"></i> Wawancara </a></li>
                    </ul>
                    <div class="tab-content">
                        @if(Session::get('menu_tes')=='psikotes')
                            @include('user.hrd.section.tes.psikotes.page_default')
                        @elseif(Session::get('menu_tes')=='keahlian')
                            @include('user.hrd.section.tes.keahlian.page_default')
                        @elseif(Session::get('menu_tes')=='wawancara')
                            @include('user.hrd.section.tes.wawancara.page_default')
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

@stop