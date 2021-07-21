@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                @include('user.manufaktur.pages.laporan.menu')
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Pengaturan Laporan</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-keluar-masuk-gudang') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gudang</label>
                                            <select class="form-control" name="id_gudang">
                                                <option value="">Pilih Gudang</option>
                                                @if(!empty($gudang))
                                                    @foreach($gudang as $gudang)
                                                        <option value="{{ $gudang->id }}">{{ $gudang->gudang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Transaksi Gudang</label>
                                            <select class="form-control" name="transaksi_gudang">
                                                <option value="">Pilih Transaksi</option>
                                                @if(!empty($transaksi_gudang))
                                                    @foreach($transaksi_gudang as $key=> $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
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
                            <h4 class="box-title">Laporan Keluar Masuk Gudang</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        @if($default_transaksi == 0)
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Transaksi</th>
                                                    <th>Faktur pembelian</th>
                                                    <th>Supplier</th>
                                                    <th>Pengirim</th>
                                                    <th>Penerima</th>
                                                    <th>Jumlah Barang</th>
                                                </tr>
                                                @if(!empty($data))
                                                    @foreach($data as $data_item)
                                                        <tr>
                                                            <td>{{ $data_item['no'] }}</td>
                                                            <td>{{ $data_item['tgl_transaksi'] }}</td>
                                                            <td>{{ $data_item['faktur_pembelian'] }}</td>
                                                            <td>{{ $data_item['supplier'] }}</td>
                                                            <td>{{ $data_item['pengirim'] }}</td>
                                                            <td>{{ $data_item['penerima'] }}</td>
                                                            <td>{{ $data_item['jumlah'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                            @elseif($default_transaksi == 1)
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Transaksi</th>
                                                        <th>Gudang Asal</th>
                                                        <th>Gudang Tujuan</th>
                                                        <th>Pengirim</th>
                                                        <th>Penerima</th>
                                                        <th>Jumlah Barang</th>
                                                    </tr>
                                                    @if(!empty($data))
                                                        @foreach($data as $data_item)
                                                            <tr>
                                                                <td>{{ $data_item['no'] }}</td>
                                                                <td>{{ $data_item['tgl_transaksi'] }}</td>
                                                                <td>{{ $data_item['gudang_asal'] }}</td>
                                                                <td>{{ $data_item['gudang_tujuan'] }}</td>
                                                                <td>{{ $data_item['pengirim'] }}</td>
                                                                <td>{{ $data_item['penerima'] }}</td>
                                                                <td>{{ $data_item['jumlah'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                        @endif
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
