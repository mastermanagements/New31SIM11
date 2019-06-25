@extends('user.hrd.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop
@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Satuan KPI
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Satuan KPI</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-kpi">
                                    Tambah
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                               </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Area Kerja Utama</th>
                                    <th>Nama KPI</th>
                                    <th>Bobot KPI</th>
                                    <th>Target KPI</th>
                                    <th>Satuan KPI</th>
                                    <th>Jenis KPI</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->aku->nm_aku }}</td>
                                        <td>{{ $value->nm_kpi }}</td>
                                        <td>{{ $value->bobot_kpi }}</td>
                                        <td>{{ $value->targat_kpi }}</td>
                                        <td>{{ $value->satuan->satuan_kpi }}</td>
                                        <td>{{ $value->jenis->jenis_kpi }}</td>

                                        <td>
                                            <form action="{{ url('hapus-kpi/'.$value->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <button type="button" class="btn btn-warning"  onclick="update('{{ $value->id }}')" >Ubah</button>
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda akan menghapus data ini...?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.hrd.section.penilaian_karyawan.PA.KPI.modal.modal')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>


    <script>
        update = function (id) {
          $.ajax({
              url: "{{ url('edit-kpi') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_aku"]').val(result.id_aku).trigger('change');
                  $('[name="id_satuan"]').val(result.id_satuan_kpi).trigger('change');
                  $('[name="id_jenis_kpi"]').val(result.id_jenis_kpi).trigger('change');
                  $('[name="nm_kpi"]').val(result.nm_kpi);
                  $('[name="bobot_kpi"]').val(result.bobot_kpi);
                  $('[name="target_kpi"]').val(result.targat_kpi);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-kpi') }}');
                  $('#modal-kpi').modal('show');
              }
          })
       }
    </script>
@stop