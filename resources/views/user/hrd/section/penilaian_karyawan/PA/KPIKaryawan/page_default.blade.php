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
                KPI Karyawan
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
                            <h3 class="box-title">Daftar KPI Karyawan</h3>
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
                                    <th>Tahun KPI</th>
                                    <th>Karyawan</th>
                                    <th>Area Kerja Utama</th>
                                    <th>KPI</th>
                                    <th>Bobot</th>
                                    <th>Realisasi KPI</th>
                                    <th>Skor KPI</th>
                                    <th>Skor Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($h_kpi as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->year }}</td>
                                        <td>{{ $value->karyawan->nama_ky }}</td>
                                        <td>{{ $value->aku->nm_aku }}</td>
                                        <td>{{ $value->kpi->nm_kpi }}</td>
                                        <td>{{ $value->kpi->bobot_kpi }}</td>
                                        <td>{{ $value->realisasi_kpi }}</td>
                                        <td>{{ $value->skor_kpi }}</td>
                                        <td>{{ $value->skor_akhir }}</td>

                                        <td>
                                            <form action="{{ url('hapus-kpi-ky/'.$value->id) }}" method="post">
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
    @include('user.hrd.section.penilaian_karyawan.PA.KPIKaryawan.modal.modal')
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