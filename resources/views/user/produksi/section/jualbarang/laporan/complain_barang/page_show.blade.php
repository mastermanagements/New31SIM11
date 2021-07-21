@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                @include('user.produksi.section.jualbarang.laporan.menu')
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Pengaturan Laporan</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-complain-penjualan') }}" method="post">
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
                                            <label>Customer</label>
                                            <select class="form-control" name="id_klien">
                                                <option value="">Pilih Customer</option>
                                                @if(!empty($customer))
                                                    @foreach($customer as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nm_klien }}</option>
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
                            <h4 class="box-title">Laporan Complain Penjualan</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">No Transaksi</th>
                                                <th rowspan="2">Tgl Penjualan</th>
                                                <th rowspan="2">Customer</th>
                                                <th colspan="2">Jumlah Barang</th>
                                                <th rowspan="2">Nilai Uang</th>
                                                <th rowspan="2">Tgl Complain</th>
                                                <th rowspan="2">Status Complain</th>
                                                <th rowspan="2">Alasan Status</th>
                                                <th rowspan="2">Keterangan</th>
                                             </tr>
                                            <tr>
                                                <th>Barang Kurang</th>
                                                <th>Barang Rusak</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $data_item)
                                                    <tr>
                                                        <td>{{ $data_item['no'] }}</td>
                                                        <td>{{ $data_item['no_transaksi'] }}</td>
                                                        <td>{{ $data_item['tgl_penjualan'] }}</td>
                                                        <td>{{ $data_item['klien'] }}</td>
                                                        <td>{{ $data_item['bbk'] }}</td>
                                                        <td>{{ $data_item['bbr'] }}</td>
                                                        <td>{{ $data_item['nilai_uang'] }}</td>
                                                        <td>{{ $data_item['tgl_complain'] }}</td>
                                                        <td>{{ $data_item['status_complain'] }}</td>
                                                        <td>{{ $data_item['asalan_status'] }}</td>
                                                        <td>{{ $data_item['keterangan'] }}</td>
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
