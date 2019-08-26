@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kompetensi Teknis
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
                            <h3 class="box-title">Kompetensi Teknis</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-kompetensi-teknis') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Kompetensi</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_jenis_kompetisi" required>
                                        @if(empty($jenis_kompetensi))
                                            <option>Jenis Kompetensi Masih Kosong</option>
                                        @else
                                            @foreach($jenis_kompetensi as $value)
                                                <option value="{{ $value->id }}">{{ $value->nm_kompetensi }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_jabatan_p" required>
                                        @if(empty($jabatan))
                                            <option>Jabatan Masih Kosong</option>
                                        @else
                                            @foreach($jabatan as $value)
                                                <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                    <div class="input-group">
                                        <label>Nama Kompetensi Teknis</label>
                                        <input type="text" class="form-control" name="nm_kompetensi_t" required>
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
                            <h3 class="box-title">Daftar Kompetensi Teknis</h3>
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
                                    <th>Nama Kompetensi Teknis</th>
                                    <th>Jenis Kompetensi</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nm_kompetensi_t }}</td>
                                        <td>{{ $value->jenis_kompetensi->nm_kompetensi }}</td>
                                        <td>{{ $value->jabatan->nm_jabatan }}</td>
                                        <td>
                                            <form action="{{ url('hapus-kompetensi-teknis/'.$value->id) }}" method="post">
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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
       update=function (id) {
          $.ajax({
              url: "{{ url('edit-kompetensi-teknis') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_jenis_kompetisi"]').val(result.id_jenis_kompetensi).trigger('change');
                  $('[name="id_jabatan_p"]').val(result.id_jabatan).trigger('change');
                  $('[name="nm_kompetensi_t"]').val(result.nm_kompetensi_t);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-kompetensi-teknis') }}');
              }
          })
       }
    </script>
@stop