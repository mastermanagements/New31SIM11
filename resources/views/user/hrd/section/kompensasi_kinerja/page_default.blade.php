@extends('user.hrd.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kompensasi Kinerja
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Kompensasi Kinerja</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-kompensasi-kinerja') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                    <div class="input-group">
                                        <label>Nilai total Kinerja</label>
                                        <input type="number" class="form-control" name="nilai_total_kinerja" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                <div class="input-group">
                                        <label>Kenaikan Gaji</label>
                                        <input type="number" class="form-control" placeholder="Besar Kenaikan gaji 15%" name="kenaikan_gaji" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                </div>
                            </div>
                            <div class="box-footer">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Kompensasi</h3>
                            <div class="box-tools pull-right">
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
                                    <th>Nilai Total Kinerja</th>
                                    <th>Kenaikan Gaji</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nilai_total_kinerja }}</td>
                                        <td>{{ $value->kenaikan_gaji }}</td>
                                        <td>
                                            <form action="{{ url('hapus-kompensasi-kinerja/'.$value->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update('{{ $value->id }}')" >Ubah</button>
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
    @include('user.hrd.section.loker.include.modal')
@stop

@section('plugins')
    <script>
       update=function (id) {
          $.ajax({
              url: "{{ url('edit-kompensasi-kinerja') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="nilai_total_kinerja"]').val(result.nilai_total_kinerja);
                  $('[name="kenaikan_gaji"]').val(result.kenaikan_gaji);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-kompensasi-kinerja') }}');
              }
          })
       }
    </script>
@stop