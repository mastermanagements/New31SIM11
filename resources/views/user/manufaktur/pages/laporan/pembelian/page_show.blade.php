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
                            <form action="{{ url('laporan-pembelian') }}" method="post">
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
                                            <label>Jenis Bayar</label>
                                            <select class="form-control" name="jenis_bayar">
                                                <option value="">Pilih Jenis Bayar</option>
                                                @if(!empty($metode_bayar))
                                                    @foreach($metode_bayar as $key=> $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Laporan Produksi</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>NO PO</th>
                                                <th>Uang Muka</th>
                                                <th>No. Transaksi</th>
                                                <th>Supplier</th>
                                                <th>Jumlah Barang</th>
                                                <th>Total Pembelian</th>
                                                <th>Diskon</th>
                                                <th>Ongkos Kirim</th>
                                                <th>Tanggal Tiba</th>
                                                <th>Jenis Pembelian</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Kurang Bayar</th>
                                                <th>Jatuh Tempo</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $item)
                                                    <tr>
                                                        <td>{{ $item[0] }}</td>
                                                        <td>{{ $item[1] }}</td>
                                                        <td>{{ $item[2] }}</td>
                                                        <td>{{ $item[3] }}</td>
                                                        <td>{{ $item[4] }}</td>
                                                        <td>{{ $item[5] }}</td>
                                                        <td>{{ $item[6] }}</td>
                                                        <td>{{ $item[7] }}</td>
                                                        <td>{{ $item[8] }}</td>
                                                        <td>{{ $item[9] }}</td>
                                                        <td>{{ $item[10]}}</td>
                                                        <td>{{ $item[11] }}</td>
                                                        <td>{{ $item[12] }}</td>
                                                        <td>{{ $item[13] }}</td>
                                                        <td>{{ $item[14] }}</td>
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
