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
                            <form action="{{ url('laporan-stok-barang') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Jenis Barang</label>
                                            <select class="form-control" name="jenis_barang" required>
                                                @if(!empty($jenis_barang))
                                                    @foreach($jenis_barang as $key=> $item_jenis_barang)
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
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item[0] }}</td>
                                            <td>{{ $item[1] }}</td>
                                            <td>{{ $item[2] }}</td>
                                            <td>{{ $item[3] }}</td>
                                            <td>{{ $item[4] }}</td>
                                            <td>{{ $item[5] }}</td>
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
