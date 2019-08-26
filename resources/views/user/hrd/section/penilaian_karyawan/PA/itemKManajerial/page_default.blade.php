@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Item Kompetensi Manajerial
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
                            <h3 class="box-title">Formulir Item Kompetensi Manajerial</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-item-kompetensi-majerial') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Item Kompetensi Manajerial</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_kompetesi_m" required>
                                        @if(empty($Hkm))
                                            <option>Kompetensi Manajerial Masih Kosong</option>
                                        @else
                                            @foreach($Hkm as $value)
                                                <option value="{{ $value->id }}">{{ $value->nm_kompetensi_m }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                    <div class="input-group">
                                        <label>Nama Item Kompetensi Majerial</label>
                                        <input type="text" class="form-control" name="item_kompetensi_m" required>
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
                            <h3 class="box-title">Daftar Kompetensi Manajerial</h3>
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
                                    <th>Jenis Kompetensi</th>
                                    <th>Nama Kompetensi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->kompetensi_m->nm_kompetensi_m }}</td>
                                        <td>{{ $value->item_kompetensi_m }}</td>
                                        <td>
                                            <form action="{{ url('hapus-item-kmanajerial/'.$value->id) }}" method="post">
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
              url: "{{ url('edit-item-kmanajerial') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_kompetesi_m"]').val(result.id_kompetensi_m).trigger('change');
                  $('[name="item_kompetensi_m"]').val(result.item_kompetensi_m);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-item-kmanajerial') }}');
              }
          })
       }
    </script>
@stop