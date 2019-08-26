@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Potongan Tetap
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
                            <h3 class="box-title">Formulir Potongan Tetap</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-potongan-tetap') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label>Nama Potongan</label>
                                        <input type="text" class="form-control" name="nm_potongan" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan Potongan</label>
                                        <input type="text" class="form-control" name="satuan_potongan" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Status Potongan</label><p></p>
                                        <p>
                                        <input type="radio" name="status_potongan" id="s_0" value="0" required>  Sebagai Pengurang Slip Gaji<br>
                                        <input type="radio" name="status_potongan" id="s_1" value="1"> Tidak masuk sbg pengurang perhitungan slip gaji
                                        </p>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Besar Potongan</label>
                                        <input type="number" class="form-control" name="besar_potongan" required>
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
                            <h3 class="box-title">Daftar Potongan Tetap</h3>
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
                                    <th>Nama Potongan </th>
                                    <th>Saatuan Potongan</th>
                                    <th>Status Potongan</th>
                                    <th>Besar Potongan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nm_potongan }}</td>
                                        <td>{{ $value->satuan_potongan }}</td>
                                        <td>{{ $value->status_potongan }}</td>
                                        <td>{{ number_format($value->besar_potongan, 2, ',','.') }}</td>
                                        <td>
                                            <form action="{{ url('hapus-potongan-tetap/'.$value->id) }}" method="post">
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


       update=function (id) {
          $.ajax({
              url: "{{ url('edit-potongan-tetap') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="nm_potongan"]').val(result.nm_potongan);
                  $('[name="satuan_potongan"]').val(result.satuan_potongan);
                  if(result.status_potongan == "0"){
                      $('#s_0').prop('checked', true);
                  }else{
                      $('#s_1').prop('checked', true);
                  }
                  $('[name="besar_potongan"]').val(result.besar_potongan);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-potongan-tetap') }}');
              }
          })
       }
    </script>
@stop