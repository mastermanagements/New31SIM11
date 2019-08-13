@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        @if(!empty(Session::get('yearInput')))
            @php($thn_proses =Session::get('yearInput'))
        @else
            @php($thn_proses = $ymd->year)
        @endif
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
                            <li @if(Session::get('menu-dividen')=="perbulan") class="active" @endif ><a href="{{ url('Dividen') }}">Dividen Per Bulan</a></li>
                            <li @if(Session::get('menu-dividen')=="investor") class="active"  @endif><a href="{{ url('Dividen-Investor') }}" >Divide Investor</a></li>
                             <li class="pull-left header"><i class="fa fa-th"></i> Dividen </li>
                        </ul>
                        <div class="tab-content">
                            @if(Session::get('menu-dividen')=="investor")
                                <div class="tab-pane  @if(Session::get('menu-dividen')=="investor") active @endif" id="tab_2-2">
                                   @include('user.investor.section.dividen.dividen_investor.page')
                                </div>
                            @else
                                <div class="tab-pane active" id="tab_1-1">
                                    @include('user.investor.section.dividen.dividen_per_bulan.page')
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
    @include('user.investor.section.dividen.dividen_per_bulan.modal_divide_per_bulan')
    {{--@include('user.investor.section.saham.saham_real.modal_saham_real')--}}
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

        $('#datepicker').change(function () {
            call_data($(this).val());
        });

        table_divince_perBulan= $('.tbdividenPerusahaan').DataTable({
            "ajax": '{{ url('getDataDividen') }}/'+"{{ $thn_proses }}",
            column:[
                {'data' :'0'},
                {'data' :'1'},
                {'data' :'2'},
                {'data' :'3'},
                {'data' :'4'},
                {'data' :'5'},
            ],
            rowCallback : function(row, data){

            },
            filter: false,
            pagging : true,
            searching: true,
            info : true,
            ordering : true,
            processing : true,
            retrieve: true
        });

        call_data = function (data) {
            $.ajax({
                url: '{{ url('getDataDividen') }}/'+data,
                dataType : 'json',
                data :{
                    '_token' : '{{ csrf_token() }}'
                }
            }).done(function (result) {
                table_divince_perBulan.clear().draw();
                table_divince_perBulan.rows.add(result.data).draw();
            }).fail(function(jqXHR, textStatus,errorThrown){

            })
        }


        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'M',
            viewMode: "month",
            minViewMode: "month"
        });

        $(function () {
            $('.select2').select2()
        });



        edit_divide_per_bulan=function (id) {
          $.ajax({
              url: "{{ url('edit-divide-bulanan') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="thn"]').val(result.thn_dividen);
                  $('[name="bln_dividen"]').val(result.bln_dividen);
                  $('[name="laba_rugi"]').val(result.laba_rugi);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-divine-bulanan') }}');
                  $('#modal-divide-perbulan').modal('show');
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