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
                            <form action="{{ url('laporan-pembayaran-pembelian') }}" method="post">
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
                                            <label>Status Pembayaran</label>
                                            <select class="form-control" name="status_bayar">
                                                <option value="">Pilih Supplier</option>
                                                @if(!empty($status_bayar))
                                                    @foreach($status_bayar as $keys=> $value)
                                                        <option value="{{ $keys }}">{{ $value }}</option>
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
                            <h4 class="box-title">Laporan Pembayaran Pembelian</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No transaksi</th>
                                                <th>Supplier</th>
                                                <th>Tgl Bayar</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Bank Asal</th>
                                                <th>Bank Tujuan</th>
                                                <th>Metode Bayar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $data)
                                                    <tr>
                                                        <td>{{ $data['no'] }}</td>
                                                        <td>{{ $data['no_transaksi'] }}</td>
                                                        <td>{{ $data['suppliers'] }}</td>
                                                        <td>{{ $data['tgl_bayar'] }}</td>
                                                        <td>{{ $data['jumlah_bayar'] }}</td>
                                                        <td>{{ $data['bank_asal'] }}</td>
                                                        <td>{{ $data['bank_tujuan'] }}</td>
                                                        <td>{{ $data['metode_bayar'] }}</td>
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
