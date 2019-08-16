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
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li @if(Session::get('menu-pelaku-saham')=="pelaksana") class="active" @endif ><a href="{{ url('Dividen') }}">Pelaksana</a></li>
                            <li @if(Session::get('menu-pelaku-saham')=="pemodal") class="active"  @endif><a href="{{ url('Dividen-Investor') }}" >Pemodal</a></li>
                             <li class="pull-left header"><i class="fa fa-th"></i> Pelaku Investasi </li>
                        </ul>
                        <div class="tab-content">
                            @if(Session::get('menu-pelaku-saham')=="pemodal")
                                <div class="tab-pane  @if(Session::get('menu-pelaku-saham')=="pemodal") active @endif" id="tab_2-2">
                                   @include('user.investor.section.PelakuInvestasi.pemodal.page')
                                </div>
                            @else
                                <div class="tab-pane active" id="tab_1-1">
                                    @include('user.investor.section.PelakuInvestasi.pelaksana.page')
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
    @include('user.investor.section.PelakuInvestasi.pelaksana.modal_pelaksana')
    {{--@include('user.investor.section.dividen.dividen_investor.modal_saham_real')--}}
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });
        $('#datepicker3').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

        $(function () {
            $('.select2').select2()
        });

        edit_pelaksana = function (id) {
            $.ajax({
                url: "{{ url('edit-pelaksana') }}/"+id,
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    $('[name="id_ky"]').val(result.id_ky).trigger('change');
                    $('[name="id_periode_invest"] option:selected').siblings().removeAttr('disabled');;
                    $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                    $('[name="id_bentuk_invest"]').val(result.id_bentuk_invest).trigger('change');
                    $('[name="persen_saham"]').val(result.persen_saham);
                    $('[name="id"]').val(result.id);
                    $('#formulir').attr('action','update-pelaksana');
                    $('#modal-pelaksana').modal('show');
                }
            })
        }

    </script>
@stop