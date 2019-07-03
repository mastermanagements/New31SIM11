@extends('user.hrd.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop
@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tes Kemanajerialan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                <div class="col-md-12" >
                    <form action="{{ url('cari-arsip') }}" method="post" style="width: 100%">
                        <div class="input-group input-group-md" >
                            {{ csrf_field() }}
                            <input type="text" name="ket" class="form-control" placeholder="cari karyawan" required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <p> </p>
            <div class="row">
                @foreach($ky as $value)
                    <div class="col-md-6">
                        <div class="box box-primary collapsed">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $value->nama_ky }}</h3>
                                <div class="box-tools pull-right">
                                    <a href="#" onclick="create('{{ $value->id }}')" class="btn btn-success" ><i class="fa fa-plus"></i> Penilaian</a>
                                   </button><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                   </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                @endforeach
                {{ $ky->links() }}
            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.hrd.section.penilaian_karyawan.PA.TesKemanajerialan.modal.modal')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


    <script>


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });


        create = function(id){
            $('[name="id_ky"]').val(id);
            $('#modal-tesKemanajerial').modal('show');
        }

        update = function (id) {
          $.ajax({
              url: "{{ url('edit-kpi-ky') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_aku"]').val(result.id_aku).trigger('change');
                  $('[name="id_ky"]').val(result.id_ky).trigger('change');
                  $('[name="id_kpi"]').val(result.id_kpi).trigger('change');
                  $('[name="realisasi_kpi"]').val(result.realisasi_kpi);
                  $('[name="thn_kpi"]').val(result.year);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-kpi-ky') }}');
                  $('#modal-kpi').modal('show');
              }
          })
       }
    </script>
@stop