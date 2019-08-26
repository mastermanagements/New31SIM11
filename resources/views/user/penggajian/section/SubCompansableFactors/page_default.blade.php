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
              Sub  Compansable Factors
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                <div class="col-md-12">
                    <div class="row">
                        @foreach($jabatan as $data_jabatan)
                            <div class="col-md-12">
                                <div class="box box-primary collapsed">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ $data_jabatan->nm_jabatan }}</h3>
                                        <div class="box-tools pull-right">
                                           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th colspan="2">Faktor</th>
                                                <th>Bobot</th>
                                                <th>Bobot Equivalent</th>
                                                <th style="width: 40px">Aksi</th>
                                            </tr>
                                            @foreach($data_jabatan->Cf as $cf)
                                                <tr>
                                                    <td>#</td>
                                                    <td colspan="2">{{ $cf->faktor }}</td>
                                                    <td>
                                                        @if(!empty($cf->sub_cf))
                                                            {{ $cf->sub_cf->sum('bobot_subcf') }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!empty($cf->sub_cf))
                                                            {{ $cf->sub_cf->sum('bobot_subcf') * 10}}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                      <button type="button" class="btn btn-danger" onclick="setIDCF('{{ $cf->id }}')"><i class="fa fa-reorder"></i> Tambah Sub </button>
                                                    </td>
                                                </tr>
                                                @if(!empty($cf->sub_cf))
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th >Sub Faktor</th>
                                                        <th colspan="4">Definisi</th>
                                                    </tr>
                                                    @foreach($cf->sub_cf as $values)
                                                        <tr>
                                                            <td style="width: 10px">#</td>
                                                            <td >{{ $values->sub_faktor }}</td>
                                                            <td>{{ $values->definisi }}</td>
                                                            <td>{{ $values->bobot_subcf }}</td>
                                                            <td>{{ $values->bobot_subcf * 10 }}</td>
                                                            <td >
                                                                <form action="{{ url('delete-sub-cf/'. $values->id) }}" method="post">
                                                                    <a href="#" onclick="update('{{ $values->id}}')"><span class="btn btn-warning"><i class="fa fa-pencil"></i> Ubah</span> </a>
                                                                    <input type="hidden" name="_method" value="put">
                                                                    {{ csrf_field() }}
                                                                    <p></p>
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ...?')"><i class="fa fa-eraser"></i> Hapus</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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