@extends('user.hrd.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop
@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Area Pelatihan Kerja
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
                            <h3 class="box-title">Formulir Area Pelatihan</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-area-kerja-utama') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jabatan</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_jabatan" required>
                                            @if(empty($data_jabatan))
                                                <option>Data Karyawan Masih Kosong</option>
                                            @else
                                                @foreach($data_jabatan as $value)
                                                    <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Area Pelatihan</label>
                                        <input name="nm_aku" class="form-control" type="text" required>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
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
                            <h3 class="box-title">Daftar Area Kerja Utama</h3>
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
                                    <th>Jabatan</th>
                                    <th>Nama Area Kerja Utama</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->jabatan->nm_jabatan }}</td>
                                        <td>{{ $value->nm_aku }}</td>
                                        <td>
                                            <form action="{{ url('hapus-area-kerja-utama/'.$value->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update('{{ $value->id }}')">Ubah</button>
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
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        update=function (id) {
          $.ajax({
              url: "{{ url('edit-Aku') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_jabatan"]').val(result.id_jabatan).trigger('change');
                  $('[name="nm_aku"]').val(result.nm_aku);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-area-kerja-utama') }}');
              }
          })
       }
    </script>
@stop