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
                            <h4 class="box-title">Pengaturan Laporan Stok Gudang</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('laporan-stok-gudang') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Gudang</label>
                                            <select class="form-control" name="gudang" required>
                                                @if(!empty($gudang))
                                                    @foreach($gudang as $data_gudang)
                                                        <option value="{{ $data_gudang->id }}">{{ $data_gudang->gudang }}</option>
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
                            <h4 class="box-title">Laporan Stok Barang</h4>
                        </div>
                        <div class="box-body">
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Speksifikasi</th>
                                    <th>Merk</th>
                                    <th>Stok Barang</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @php($no=1)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nm_barang }}</td>
                                            <td>{{ $item->satuan }}</td>
                                            <td>{{ $item->spec_barang }}</td>
                                            <td>{{ $item->merk_barang }}</td>
                                            <td>{{ $item->jumlah }}</td>
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
