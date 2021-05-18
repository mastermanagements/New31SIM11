@extends('kasir.master')
@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Pesanan</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah Barang</button>
                                        <button class="btn btn-danger pull-right" onclick="alert('Coming Soon')">Reset Barang</button>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 class="box-title"> Daftar Barang Pesanan </h4>
                                        <hr>
                                        <table class="table table-striped" id="daftar_table_pesanan" style="overflow-y: scroll;">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Barang </th>
                                                <th>Jumlah Penjualan</th>
                                                <th>Harga Satuan</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-body">
                                <h1>RP. 50.000.000</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Daftar Penjualan Hari Ini</h4>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Klien</th>
                                            <th>Jumlah Item Penjualan</th>
                                            <th>Total Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody style="overflow-y: scroll;">
                                        <tr>
                                            <th>1</th>
                                            <th>asads</th>
                                            <th>10</th>
                                            <th>RP. 50.000.000</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>asads</th>
                                            <th>10</th>
                                            <th>RP. 50.000.000</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>asads</th>
                                            <th>10</th>
                                            <th>RP. 50.000.000</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>asads</th>
                                            <th>10</th>
                                            <th>RP. 50.000.000</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>asads</th>
                                            <th>10</th>
                                            <th>RP. 50.000.000</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Default Modal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Barang</label>
                            <select class="form-control select2" id="barang" required>
                                <option value="">Pilih Barang</option>
                                @if(!empty($barang))
                                    @foreach($barang as $data_item)
                                        <option value="{{ $data_item->id }}">{{ $data_item->nm_barang }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input class="form-control" name="hpp" id="hpp">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input class="form-control" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="tombol_tambah">Simpan</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
@stop

@section('js')
    <script>
        var container=[];

        render_table = function(){
            var html ="";
            var no=1;
            $.each(container,function (index, value) {
                html+="<tr>";
                html+="<td>"+(no++)+"</td>";
                html+="<td>"+value[1]+"</td>";
                html+="<td>"+value[2]+"</td>";
                html+="<td>"+value[3]+"</td>";
                html+="<td>"+(value[2]*value[3])+"</td>";
                html+="<td><button class='btn btn-warning'>ubah</button><button class='btn btn-danger'>hapus</button></td>";
                html+="</tr>";
            });
            $('#daftar_table_pesanan').html(html);
        }

        $('#tombol_tambah').click(function(){
            var id_barang = $('#barang').val();
            var nama_barang = $( "#barang option:selected" ).text();;
            var hpp = $('#hpp').val();
            var jumlah = $('#jumlah').val();

            var item = [id_barang,nama_barang, hpp, jumlah];
            container.push(item);
            render_table();
        });


    </script>
@stop