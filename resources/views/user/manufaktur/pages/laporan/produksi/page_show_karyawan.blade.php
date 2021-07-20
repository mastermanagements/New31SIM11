@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop


@section('master_content')
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                @include('user.manufaktur.menu')
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Pengaturan Laporan</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-produksi-per-ky') }}" method="post">
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
                                            <label>Karyawan</label>
                                            <select class="form-control" name="id_karyawan">
                                                @if(!empty($supervisor))
                                                    <option value="">Pilih Karyawan</option>
                                                    @foreach($supervisor as $item_supervisor)
                                                        <option value="{{ $item_supervisor->id }}">{{ $item_supervisor->nama_ky }}</option>
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
                            <h4 class="box-title">Laporan Produksi Karyawan</h4>
                        </div>
                        <div class="box-body">
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th colspan="2">Tanggal</th>
                                    <th rowspan="2">Lama Produksi</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th colspan="2">Barang Jadi</th>
                                    <th colspan="2">Barang Dalam Proses</th>
                                    <th colspan="3">Biaya Produksi</th>                                   
                                    <th rowspan="2">Supervisor</th>
                                </tr>
                                <tr>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Bagus</th>
                                    <th>Rusak</th>
                                    <th>Bagus</th>
                                    <th>Rusak</th>
                                    <th>Bahan Mentah</th>
                                    <th>Tenaga Kerja</th>
                                    <th>Overhead</th>
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
                                            <td>{{ $item[9][0] }}</td>
                                            <td>{{ rupiahView($item[10][0]) }}</td>
                                            <td>{{ $item[11][0] }}</td>
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
        </section>
        <!-- /.content -->
    </div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@stop
