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
                            <form action="{{ url('laporan-produksi-tahunan') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" class="form-control" name="year" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Karyawan</label>
                                            <select class="form-control" name="id_karyawan">
                                                @if(!empty($karyawan))
                                                    <option value="">Pilih Karyawan</option>
                                                    @foreach($karyawan as $item_karyawan)
                                                        <option value="{{ $item_karyawan->id }}">{{ $item_karyawan->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Barang</label>
                                            <select class="form-control" name="id_barang">
                                                @if(!empty($barang))
                                                    <option value="">Pilih nama barang</option>
                                                    @foreach($barang as $item_barang)
                                                        <option value="{{ $item_barang->id }}">{{ $item_barang->nm_barang }}</option>
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
                            <table class="table table-responsive table-striped">
                                <thead>

                                <tr>
                                    <td rowspan="2">No</td>
                                    <td rowspan="2">Bulan</td>
                                    <td rowspan="2">Tgl produksi</td>
                                    <td rowspan="2">Nama Barang</td>
                                    <td colspan="2">Barang Jadi</td>
                                    <td colspan="2">Barang Dalam Proses</td>
                                    <td rowspan="2">Supervisor</td>
                                </tr>
                                <tr>
                                    <th>Bagus</th>
                                    <th>Rusak</th>
                                    <th>Bagus</th>
                                    <th>Rusak</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @php($no=1)
                                    @foreach($bulan as $keys=> $item_bulan)
                                        @if(!empty($data[$keys]))
                                            <tr>
                                                <td rowspan="{{ count($data[$keys])+1 }}">{{ $no++ }} </td>
                                                <td rowspan="{{ count($data[$keys])+1 }}">{{ $item_bulan }} </td>
                                            </tr>
                                            @foreach($data[$keys] as $item_data)
                                                <tr>
                                                    <td>{{ $item_data['tgl_produksi'] }}</td>
                                                    <td>{{ $item_data['barang'] }}</td>
                                                    <td>{{ $item_data['bjb'] }}</td>
                                                    <td>{{ $item_data['bjr'] }}</td>
                                                    <td>{{ $item_data['bdp_b'] }}</td>
                                                    <td>{{ $item_data['bdp_r'] }}</td>
                                                    <td>{{ $item_data['supervisor'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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
