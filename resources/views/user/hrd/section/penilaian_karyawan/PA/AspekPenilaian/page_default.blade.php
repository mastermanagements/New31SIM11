@extends('user.hrd.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Aspek Penilaian
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
                            <h3 class="box-title">Formulir Aspek Penilaian</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-aspek-penilaian') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                    <div class="input-group">
                                        <label>Nama Aspek</label>
                                        <input type="text" class="form-control" name="nm_aspek">
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="input-group">
                                        <label>Bobot</label>
                                        <input type="number" class="form-control" name="bobot">
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
                            <h3 class="box-title">Daftar Aspek Penilian</h3>
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
                                    <th>Nama Aspek</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nm_aspek }}</td>
                                        <td>{{ $value->bobot }}</td>
                                        <td>
                                            <form action="{{ url('hapus-PA/'.$value->id) }}" method="post">
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
              url: "{{ url('edit-Pa') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="nm_aspek"]').val(result.nm_aspek);
                  $('[name="bobot"]').val(result.bobot);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-aspek-penilaian') }}');
              }
          })
       }
    </script>
@stop