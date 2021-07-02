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
                            <h4 class="box-title">Pengaturan laporan barang keluar masuk</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-masuk-keluar-barang') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Barang</label>
                                            <select class="form-control" name="jenis_item">
                                                @if(!empty($jenis_item))
                                                    <option value="">Pilih Jenis Barang</option>
                                                    @foreach($jenis_item as $key=>$item_jenis_barang)
                                                        <option value="{{ $key }}">{{ $item_jenis_barang }}</option>
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
                            <h4 class="box-title">Tabel laporan barang keluar masuk</h4>
                        </div>
                        <div class="box-body">
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Merek</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @php($no=1)
                                    @foreach($data as $item)
                                        <tr>
                                            <th>{{ $no++ }}</th>
                                            <th>{{ $item['tgl'] }}</th>
                                            <th>{{ $item['barang'] }}</th>
                                            <th>{{ $item['spek'] }}</th>
                                            <th>{{ $item['merk'] }}</th>
                                            <th>{{ $item['satuan'] }}</th>
                                            <th>{{ $item['jumlah'] }}</th>
                                            <th>{{ $item['ket'] }}</th>
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
