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
                            <li @if(Session::get('menu-jual-saham')=="saham-perusahaan") class="active" @endif ><a href="{{ url('saham-perusahaan') }}">Saham Perusahaan</a></li>
                            <li @if(Session::get('menu-jual-saham')=="saham-investor") class="active"  @endif><a href="{{ url('saham-investor') }}" >Saham Investor</a></li>
                             <li class="pull-left header"><i class="fa fa-th"></i>Jual Saham </li>
                        </ul>
                        <div class="tab-content">
                            @if(Session::get('menu-jual-saham')=="saham-investor")
                                <div class="tab-pane  @if(Session::get('menu-jual-saham')=="saham-investor") active @endif" id="tab_2-2">
                                   @include('user.investor.section.JualSaham.saham_investor.page')
                                </div>
                            @else
                                <div class="tab-pane active" id="tab_1-1">
                                    @include('user.investor.section.JualSaham.saham_perusahaan.page')
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
    @include('user.investor.section.JualSaham.saham_investor.modal_saham_investor')
    @include('user.investor.section.JualSaham.saham_perusahaan.modal_saham_perusahaan')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

        $(function () {
            $('.select2').select2()
        });

        edit_jual_saham_perusahaan=function (id) {
          $.ajax({
              url: "{{ url('edit-jual-saham-perusahaan') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                  $('[name="jumlah_persen_saham"]').val(result.jumlah_persen_saham);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-jual-saham-perusahaan') }}');
                  $('#modal-jual-saham-perusahaan').modal('show');
              }
          });
        }

        edit_saham_real=function (id) {
          $.ajax({
              url: "{{ url('edit-saham-real') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_periode_saham"]').val(result.id_periode_saham).trigger('change');
                  $('[name="jum_saham"]').val(result.jum_saham);
                  $('[name="id"]').val(result.id);
                  $('#formulirs').attr('action', '{{ url('update-saham-real') }}');
                  $('#modal-saham-real').modal('show');
              }
          });
       }
    </script>
@stop