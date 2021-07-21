@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                @include('user.produksi.section.laporan.menu')
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Pengaturan Laporan</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-pengecekan-barang-pembelian') }}" method="post">
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
                            <h4 class="box-title">Laporan Pengecekkan Barang</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Tgl Diterima</th>
                                                <th rowspan="2">Tgl Pengecekkan</th>
                                                <th rowspan="2">No Order</th>
                                                <th colspan="2">Jumlah Barang</th>
                                                <th colspan="2">Kondisi Barang</th>
                                                <th rowspan="2">Petugas</th>
                                                <th rowspan="2">Tgl complain</th>
                                                <th colspan="3">Respon Supplier</th>
                                             </tr>
                                            <tr>
                                                <th>Diterima</th>
                                                <th>Kurang</th>
                                                <th>Bagus</th>
                                                <th>Cacat</th>
                                                <th>Tgl Respon</th>
                                                <th>Diterima</th>
                                                <th>Ditolak</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $item)
                                                    <tr>
                                                        <td>{{ $item['no'] }}</td>
                                                        <td>{{ $item['tgl_terima'] }}</td>
                                                        <td>{{ $item['tgl_pengecekkan'] }}</td>
                                                        <td>{{ $item['no_order'] }}</td>
                                                        <td>{{ $item['jum_brg_terima'] }}</td>
                                                        <td>{{ $item['jum_brg_kurang'] }}</td>
                                                        <td>{{ $item['kon_brg_bagus'] }}</td>
                                                        <td>{{ $item['kon_brg_kurang'] }}</td>
                                                        <td>{{ $item['petugas'] }}</td>
                                                        <td>{{ $item['tgl_complain'] }}</td>
                                                        <td>{{ $item['suplier_tgl_respon'] }}</td>
                                                        <td>{{ $item['suplier_diterima'] }}</td>
                                                        <td>{{ $item['suplier_di_tolak'] }}</td>
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
