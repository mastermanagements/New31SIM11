@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Jabatan Perusahaan
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
                            <h3 class="box-title">Formulir Jabatan Perusahaan</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-jabatan') }}" method="post" id="jabatan">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">

                                    <div class="form-group">
                                        <label>Nama Jabatan</label>
                                        <input type="text" class="form-control" name="nm_jabatan" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                  <div class="form-group">
                                        <label>Level Jabatan</label>
                                          <div class="form-group">
                                        @foreach($level_jabatan as $key => $level)
                                            <label>
                                                <input type="radio"  name="level_jabatan" class="minimal" value="{{ $key }}" required>
                                                {{ $level }} &nbsp;
                                            </label>
                                        @endforeach
                                        <p></p>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
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
                            <h3 class="box-title">Daftar Jabatan Perusahaan</h3>
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
                                    <th>Nama Jabatan </th>
                                    <th>Level </th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($jabatan as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nm_jabatan }}</td>
                                        <td>
                                            @if($value->level_jabatan==0)
                                                Direksi
                                            @elseif ($value->level_jabatan==1)
                                                Manager
                                            @elseif ($value->level_jabatan==2)
                                                Supervisor
                                            @else
                                                Staf
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('hapus-jabatan/'.$value->id) }}" method="post">
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
              url: "{{ url('edit-jabatan') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="nm_jabatan"]').val(result.nm_jabatan);
                  $('[name="level_jabatan"]').val(result.level_jabatan);

                  $('[name="id"]').val(result.id);
                  $('#jabatan').attr('action', '{{ url('update-jabatan') }}');
              }
          })
       }
    </script>
@stop
