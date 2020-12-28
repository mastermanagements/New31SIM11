@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Daftar Harga Berdasarkan Jumlah Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tabel Harga Berdasarkan Jumlah Barang</h3>
                    </div>

                    <div class="box-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <a href="#" onclick="modalShow({{$data->id}})" type="button" class="btn btn-primary" title="ubah jasa"> berdasarkan jumlah beli</a>
                             </div>
                             <div class="col-md-12" style="margin-top: 10px">
                                @if(!empty($data->linkToHargaBaseOnJumlah))
                                     <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Nama Barang</td>
                                                <td>Harga HPP</td>
                                                <td>Harga Jumlah Maks</td>
                                                <td>Harga Jual</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @php($no=1)
                                            @foreach($data->linkToHargaBaseOnJumlah as $data)
                                                 <tr>
                                                     <td>{{ $no++ }}</td>
                                                     <td>{{ $data->linkToBarang->nm_barang }}</td>
                                                     <td>{{ $data->linkToBarang->hpp }}</td>
                                                     <td>{{ $data->jumlah_maks_brg }}</td>
                                                     <td>{{ $data->harga_jual }}</td>
                                                     <td>
                                                         <form action="{{ url('harga-jual-baseon-jumlah/'.$data->id.'/delete') }}" method="post">
                                                             {{ csrf_field() }}
                                                             <input type="hidden" name="_method" value="put">
                                                             <a href="{{ url('harga_jual_base_on_jumlah/'.$data->id) }}" onclick="ubah_barang_jumlah('{{ $data->id }}')" class="btn btn-sm btn-warning">ubah</a>
                                                             <button type="submit" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')" class="btn btn-sm btn-danger">hapus</button>
                                                         </form>
                                                     </td>
                                                 </tr>
                                            @endforeach
                                         </tbody>
                                     </table>
                                 @endif
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Jumlah Barang</h4>
                </div>
                <form action="{{ url('banyak-barang') }}" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Banyak Barang</label>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_barang" required>
                                    <input type="number" minlength="0" maxlength="100" name="jumlah_barang" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-default-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Ubah Harga Satuan Barang Berdasarkan Jumlah</h4>
                </div>
                <form action="#" id="form-ubah" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="_method" value="put">
                                    <label for="exampleInputEmail1">Jumlah Masimal penjualan</label>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_HBJ" required>
                                    <input type="number" minlength="0" maxlength="100" name="jumlah_maks_brg" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Jual</label>
                                    {{ csrf_field() }}
                                    <input type="number" minlength="0" maxlength="100" name="harga_jual" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        modalShow = function (kode) {
            $('[name="id_barang"]').val(kode);
            $('#modal-default').modal('show');
        }



    </script>
@stop