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
                Potongan Absen
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
                            <h3 class="box-title">Formulir Potongan Absen</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-potongan-absen') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                <div class="form-group">
                                    <label>Periode </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker"  name="periode" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Absensi</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_absensi" required>
                                        @if(empty($absensi))
                                            <option>Absensi Masih Kosong</option>
                                        @else
                                            @foreach($absensi as $value)
                                                <option value="{{ $value->id }}">{{ $value->karyawan->nama_ky }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Potongan</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_potongan_tetap" required>
                                        @if(empty($pt))
                                            <option>Potongan Tetap Masih Kosong</option>
                                        @else
                                            @foreach($pt as $value)
                                                <option value="{{ $value->id }}">{{ $value->nm_potongan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                    <div class="form-group">
                                        <label>Jumlah Potongan</label>
                                        <input type="number" class="form-control" name="jumlah_item_p" required>
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
                            <h3 class="box-title">Daftar Potongan Absen</h3>
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
                                    <th>Periode</th>
                                    <th>Nama Karyawan</th>
                                    <th>Potongan Tetap</th>
                                    <th>Besaran Potongan</th>
                                    <th>Jumlah Item Potongan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($PA as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('M', strtotime($value->periode)) }}</td>
                                        <td>{{ $value->absensi->karyawan->nama_ky }}</td>
                                        <td>{{ $value->potongan->nm_potongan }}</td>
                                        <td>{{ $value->potongan->besar_potongan }}</td>
                                        <td>{{ number_format($value->jumlah_item_p, 2, ',','.') }}</td>
                                        <td>
                                            <form action="{{ url('hapus-potongan-absen/'.$value->id) }}" method="post">
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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            viewMode: "months",
            minViewMode: "months"
        });

        $(function () {
            $('.select2').select2();
        })

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-potongan-absen') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_absensi"]').val(result.id_absensi).trigger('selected');
                  $('[name="id_potongan_tetap"]').val(result.id_potongan_tetap).trigger('selected');
                  $('[name="jumlah_item_p"]').val(result.jumlah_item_p);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-potongan-absen') }}');
              }
          })
       }
    </script>
@stop