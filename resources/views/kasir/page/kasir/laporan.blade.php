@extends('kasir.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pengaturan Laporan</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="row">
                            <form action="{{ url('filter-nota') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tgl_awal">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="tgl_awal" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tgl_akhir">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="tgl_akhir" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: white">-</label>
                                        <button type="submit" name="proses" value="proses" class="btn btn-primary form-control">Proses</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: white">-</label>
                                        <button type="submit" name="cetak" value="cetak" class="btn btn-primary form-control">Cetak</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="box ">
                    <div class="box-header">
                        <h4 class="box-title">Laporan Penjualan</h4>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Item Penjualan</th>
                                <th>Jumlah Penjualan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($nota))
                                @php($no=1)
                                @foreach($nota as $item_data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item_data->created_at)) }}</td>
                                        <td>{{ $item_data->kode }}</td>
                                        <td>{{ $item_data->linkToMannyDetailNota->count('id') }}</td>
                                        <td>{{ number_format($item_data->linkToMannyDetailNota->sum('sub_total'),2,',','.') }}</td>
                                        <td>
                                            <button class="btn btn-primary" onclick="cek_barang({{ $item_data->id }})">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{ $nota->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-detail-barang">
            <form>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modal Detail Barang</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="detail_tabel_modal">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Jumlah Penjualan</th>
                                            <th>Harga Satuan</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p style="font-weight: bold" id="belanja_total"></p>
                                    </div>
                                    <div class="form-group">
                                        <p style="font-weight: bold" id="modal_total_bayar"></p>
                                        <p style="font-weight: bold" id="kembalian"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="tombol_tambah">Simpan</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </form>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
@stop

@include('kasir.page.kasir.js')