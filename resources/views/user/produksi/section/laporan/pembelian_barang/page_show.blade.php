@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Pengaturan Laporan</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-pembelian-barang') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal awal</label>
                                            <input type="date" class="form-control" name="tgl_awal" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Akhir</label>
                                            <input type="date" class="form-control" name="tgl_akhir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="form-control" name="supplier">
                                                <option value="">Pilih Supplier</option>
                                                @if(!empty($supplier))
                                                    @foreach($supplier as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nama_suplier }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label></label>
                                            <button type="submit" name="action" value="preview" class="btn btn-primary"
                                                    style="margin-top: 25px">Tampilkan
                                            </button>
                                            <button type="submit" name="action" value="print" class="btn btn-success"
                                                    style="margin-top: 25px">Cetak
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Laporan Pesanan pembelian</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>No. Transaksi</th>
                                                <th>Supplier</th>
                                                <th>Tgl tiba</th>
                                                <th>No. Pesanan Pembelian</th>
                                                <th>Total belanja</th>
                                                <th>Diskon</th>
                                                <th>PPN</th>
                                                <th>Ongkir</th>
                                                <th>Metode Pembelian</th>
                                             </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $item)
                                                    <tr>
                                                        <td>{{ $item['no'] }}</td>
                                                        <th>{{ $item['transaksi'] }}</th>
                                                        <th>{{ $item['no_transaksi'] }}</th>
                                                        <th>{{ $item['supplier'] }}</th>
                                                        <th>{{ $item['tgl_tiba'] }}</th>
                                                        <th>{{ $item['no_pesananan'] }}</th>
                                                        <th>{{ $item['total_belajan'] }}</th>
                                                        <th>{{ $item['diskon_tambahan'] }}</th>
                                                        <th>{{ $item['ppn'] }}</th>
                                                        <th>{{ $item['ongkir'] }}</th>
                                                        <th>{{ $item['metode_bayar'] }}</th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@stop
