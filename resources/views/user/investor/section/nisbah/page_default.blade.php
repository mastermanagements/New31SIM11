@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

       <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                @if(!empty(Session::get('yearInput')))
                    @php($thn_proses =Session::get('yearInput'))
                @else
                    @php($thn_proses = $ymd->year)
                @endif
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li @if(Session::get('menu-nisbah')=="besar_nisbah") class="active" @endif ><a href="{{ url('Besar-nisbah') }}">Besar Nisbah</a></li>
                            <li @if(Session::get('menu-nisbah')=="nisbah_pelaksana") class="active"  @endif><a href="{{ url('Nisbah-pelaksana') }}" >Nisbah Pelaksana</a></li>
                             <li class="pull-left header"><i class="fa fa-th"></i> Nisbah </li>
                        </ul>
                        <div class="tab-content">


                            @if(Session::get('menu-nisbah')=="pemodal")
                                <div class="tab-pane  @if(Session::get('menu-pelaku-saham')=="pemodal") active @endif" id="tab_2-2">
                                   @include('user.investor.section.PelakuInvestasi.pemodal.page')
                                </div>
                            @else
                                <div class="tab-pane active" id="tab_1-1">
                                    @include('user.investor.section.nisbah.besar_nisbah.page')
                                </div>
                        @endif

                        <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    @if(Session::get('menu-nisbah')=="pemodal")
        @include('user.investor.section.PelakuInvestasi.pemodal.modal_pemodal')
    @else
        @include('user.investor.section.nisbah.besar_nisbah.modal_pelaksana')
        @include('user.investor.section.nisbah.modal_nisbah.modal_nisbah')
    @endif
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });
        $('#datepicker3').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });
        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'mm',
            viewMode: "month",
            minViewMode: "month"
        });

        $(function () {
            $('.select2').select2()
        });
    </script>

    @include('user.investor.section.nisbah.besar_nisbah.Js')
@stop