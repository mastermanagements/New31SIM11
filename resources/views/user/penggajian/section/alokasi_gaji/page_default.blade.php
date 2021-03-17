@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Alokasi Gaji
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
                            <h3 class="box-title">Formulir Alokasi Gaji</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-aloasi-gaji') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                <div class="form-group">
                                    <label>Tahun </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="thn" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                    <div class="form-group">
                                        <label>Percent</label>
                                        <input type="number" class="form-control" name="persen" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah" required>
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
                            <h3 class="box-title">Daftar Alokasi Gaji</h3>
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
                                    <th>Tahun </th>
                                    <th>Persen</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->thn }}</td>
                                        <td>{{ $value->persen }}</td>
                                        <td>{{ number_format($value->jumlah, 2, ',','.') }}</td>
                                        <td>
                                            <form action="{{ url('hapus-alokasi-gaji/'.$value->id) }}" method="post">
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

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-alokasi-gaji') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="thn"]').val(result.thn);
                  $('[name="persen"]').val(result.persen);
                  $('[name="jumlah"]').val(result.jumlah);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-alokasi-gaji') }}');
              }
          })
       }
    </script>
@stop
