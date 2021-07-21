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
                            <form action="{{ url('laporan-return-penjualan') }}" method="post">
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
                                            <label>Klien</label>
                                            <select class="form-control" name="id_klien">
                                                <option value="">Pilih klien</option>
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
                            <h4 class="box-title">Laporan Return Penjualan</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Klien</th>
                                                    <th rowspan="2">Tgl Penjualan</th>
                                                    <th rowspan="2">Tgl Return</th>
                                                    <th rowspan="2">Jenis Return</th>
                                                    <th rowspan="2">Ongkir Return</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $data_item)
                                                    <tr>
                                                        <td>{{ $data_item['no'] }}</td>
                                                        <td>{{ $data_item['customer'] }}</td>
                                                        <td>{{ $data_item['tgl_penjualan'] }}</td>
                                                        <td>{{ $data_item['tgl_return'] }}</td>
                                                        <td>{{ $data_item['jenis_return'] }}</td>
                                                        <td>{{ $data_item['ongkir_return'] }}</td>
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
