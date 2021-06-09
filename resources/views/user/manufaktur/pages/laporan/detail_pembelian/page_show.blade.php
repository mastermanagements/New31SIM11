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
                            <form action="{{ url('laporan-detail-pembelian') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            <input type="date" class="form-control" name="tgl_awal" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="form-control" name="supplier">
                                                <option value="">Pilih Supplier</option>
                                                @if(!empty($supplier))
                                                    @foreach($supplier as $item_supplier)
                                                        <option value="{{ $item_supplier->id }}">{{ $item_supplier->nama_suplier }}</option>
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
                @if(!empty($data))
                    @php($sum_harga_beli = 0)
                    @php($sum_sub_total = 0)
                    @foreach($data as $item)
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p style="font-weight: bold">No. Transaksi : {{ $item[0] }}</p>
                                            <p style="font-weight: bold">Supplier : {{ $item[1] }}</p>
                                            <p style="font-weight: bold">Jenis Pembelian : {{ $item[2] }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="font-weight: bold">Diskon : {{ $item[3] }}</p>
                                            <p style="font-weight: bold">Ongkir : {{ $item[4] }}</p>
                                            <p style="font-weight: bold">Pajak : {{ $item[5] }}%</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Satuan</th>
                                                        <th>Spec</th>
                                                        <th>Merk</th>
                                                        <th>Harga Beli</th>
                                                        <th>Jumlah Beli</th>
                                                        <th>Diskon Per Item</th>
                                                        <th>Sub Total</th>
                                                        <th>Expired Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(!empty($item[6]))
                                                        @foreach($item[6] as $item_data)
                                                            <tr>
                                                                <td>{{ $item_data[0] }}</td>
                                                                <td>{{ $item_data[1] }}</td>
                                                                <td>{{ $item_data[2] }}</td>
                                                                <td>{{ $item_data[3] }}</td>
                                                                <td>{{ $item_data[4] }}</td>
                                                                <td>{{ $item_data[5] }}</td>
                                                                <td>{{ $item_data[6] }} @php($sum_harga_beli+=$item_data[6])</td>
                                                                <td>{{ $item_data[7] }}</td>
                                                                <td>{{ $item_data[8] }}</td>
                                                                <td>{{ $item_data[9] }} @php($sum_sub_total+=$item_data[9])</td>
                                                                <td>{{ $item_data[10] }}</td>
                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                                <td colspan="6">Total</td>
                                                                <td>{{ $sum_harga_beli }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>{{ $sum_sub_total }}</td>
                                                                <td></td>
                                                        </tr>
                                                        <tr>
                                                                <td colspan="9">Total  Akhir</td>
                                                                <td>{{ $item[7] }}</td>
                                                                <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@stop
