@extends('user.administrasi.master_user')
@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manufaktur
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
                            <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> SOP Produksi </a></li>
                            <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif"><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Produksi Baru</a></li>
                            <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i>Monitoring</a></li>
                            <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Selesai Produksi </a></li>
                            <li class="@if(Session::get('tab5') == 'tab5') active @else '' @endif"><a href="#tab_5" data-toggle="tab"><i class="fa fa-book"></i> Setting Akun </a></li>
                        </ul>
                        <div class="tab-content">
                           @include('user.manufaktur.tab.SOP_produksi')
                           @include('user.manufaktur.tab.produksi_baru')
                           @include('user.manufaktur.tab.monitoring')
                            @include('user.manufaktur.tab.selesai_produksi')
                           @include('user.manufaktur.tab.setting_akun')
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
    <script>

    </script>
@stop
