@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Content Compansable Factors
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-sm-12" style="padding-bottom: 10px">
                    <div class="row">
                        <div class="col-sm-2" style="margin-right:10px ">
                            <a href="{{ url('Pokok-cf') }}" class="btn btn-primary">Pokok Compansable Factors</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ url('item-cf') }}" class="btn btn-success">Item Content CF</a>
                        </div>
                    </div>
                </div>
                @foreach($cf as $cf)
                    <div class="col-md-3">
                        <div class="box box-primary collapsed">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $cf->faktor }}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                               <ul>
                                @foreach($cf->sub_cf as $scf)
                                    <li><a href="{{ url('content-cf/'. $scf->id) }}">{{ $scf->sub_faktor }}</a> </li>
                                @endforeach
                               </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
        <!-- /.content -->
    </div>

    @include("user.penggajian.section.SubCompansableFactors.modal.modal")
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

        setIDCF= function(id){
            $('[name="id_cf"]').val(id);
            $('#modal-subcf').modal('show');
        }

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-sub-cf') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="sub_faktor"]').val(result.sub_faktor);
                  $('[name="definisi"]').val(result.definisi);
                  $('[name="bobot_subcf"]').val(result.bobot_subcf);
                  $('[name="id"]').val(result.id);
                  $('[name="id_cf"]').val(result.id_cf);
                  $('#formulir').attr('action', '{{ url('update-sub-cf') }}');
                  $('#modal-subcf').modal('show');
              }
          })
       }
    </script>
@stop