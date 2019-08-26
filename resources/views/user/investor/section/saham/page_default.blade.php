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
                            <li @if(Session::get('menu-saham')=="saham-perdana") class="active" @endif ><a href="{{ url('Saham') }}">Saham Perdana</a></li>
                            <li @if(Session::get('menu-saham')=="saham-real") class="active"  @endif><a href="{{ url('Saham-real') }}" >Saham Real</a></li>
                             <li class="pull-left header"><i class="fa fa-th"></i> Saham </li>
                        </ul>
                        <div class="tab-content">
                            @if(Session::get('menu-saham')=="saham-perdana")
                                <div class="tab-pane  @if(Session::get('menu-saham')=="saham-perdana") active @endif" id="tab_2-2">
                                   @include('user.investor.section.saham.saham_perdana.page')
                                </div>
                            @else
                                <div class="tab-pane active" id="tab_1-1">
                                    @include('user.investor.section.saham.saham_real.page')
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
    @include('user.investor.section.saham.saham_perdana.modal_saham_perdana')
    @include('user.investor.section.saham.saham_real.modal_saham_real')
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

        $(function () {
            $('.select2').select2()
        });

        edit_saham_perdana=function (id) {
          $.ajax({
              url: "{{ url('edit-saham-perdana') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                  $('[name="lembar_saham_perdana"]').val(result.lembar_saham_perdana);
                  $('[name="nilai_saham"]').val(result.nilai_saham);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-saham-perdana') }}');
                  $('#modal-saham-perdana').modal('show');
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