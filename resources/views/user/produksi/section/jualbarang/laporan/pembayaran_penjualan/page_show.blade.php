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
                            <form action="{{ url('laporan-pembayaran-penjualan') }}" method="post">
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
                            <h4 class="box-title">Laporan Pembayaran Penjualan</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Transaksi</th>
                                                <th>Jenis Pembayaran</th>
                                                <th>Klien</th>
                                                <th>Tgl Bayar</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Bank Asal</th>
                                                <th>Bank Tujuan</th>
                                                <th>Metode Bayar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $data_item)
                                                    <tr>
                                                        <td>{{ $data_item['no'] }}</td>
                                                        <td>{{ $data_item['no_transaksi'] }}</td>
                                                        <td>{{ $data_item['jenis_pembayaran'] }}</td>
                                                        <td>{{ $data_item['klien'] }}</td>
                                                        <td>{{ $data_item['tgl_bayar'] }}</td>
                                                        <td>{{ $data_item['jumlah_bayar'] }}</td>
                                                        <td>{{ $data_item['bank_asal'] }}</td>
                                                        <td>{{ $data_item['bank_tujuan'] }}</td>
                                                        <td>{{ $data_item['metode_bayar'] }}</td>
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
