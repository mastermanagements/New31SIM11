@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventory
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12">
                <div class="box box-primary">
                    @include('user.produksi.section.inventory.menu')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap;">
                                <h5 style="font-weight: bold">Item Masuk <a href="{{ url('itemIO/create') }}" class="btn btn-success pull-right" style="margin-bottom: 10px">Tambah Item Masuk Keluar</a></h5>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Tanggal Transaksi</td>
                                            <td>Keterangan</td>
                                            <td>Nama Barang</td>
                                            <td>Satuan </td>
                                            <td>Jumlah</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($no=1)
                                        @if(!empty($data_item_masuk))
                                            @foreach($data_item_masuk as $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($data->tgl)) }}</td>
                                                    <td>{{ $data->ket }}</td>
                                                    <td>@if(!empty($data->linkToBarang->nm_barang)){{ $data->linkToBarang->nm_barang }} @endif</td>
                                                    <td>@if(!empty($data->linkToBarang->linkToSatuan->satuan)){{ $data->linkToBarang->linkToSatuan->satuan }} @endif</td>
                                                    <td>{{ $data->jumlah_brg }}</td>
                                                    <td>
                                                        <form action="{{ url('itemIO/'.$data->id.'/destroy') }}" method="post">
                                                            {{ csrf_field() }}
                                                            <a href="{{ url('itemIO/'.$data->id.'/edit') }}" class="btn btn-warning">ubah</a>
                                                            {{--<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data stok ini ... ?')">ubah</button>--}}
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap;">
                                <h5 style="font-weight: bold">Item Keluar</h5>
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Tanggal Transaksi</td>
                                            <td>Keterangan</td>
                                            <td>Nama Barang</td>
                                            <td>Satuan </td>
                                            <td>Jumlah</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($no=1)
                                        @if(!empty($data_item_keluar))
                                            @foreach($data_item_keluar as $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($data->tgl)) }}</td>
                                                    <td>{{ $data->ket }}</td>
													<td>@if(!empty($data->linkToBarang->nm_barang)){{ $data->linkToBarang->nm_barang }} @endif</td>
                                                    <td>@if(!empty($data->linkToBarang->linkToSatuan->satuan)){{ $data->linkToBarang->linkToSatuan->satuan }} @endif</td>
		
                                                    <td>{{ $data->jumlah_brg }}</td>
                                                    <td>
                                                        <form action="{{ url('itemIO/'.$data->id.'/destroy') }}" method="post">
                                                            {{ csrf_field() }}
                                                            <a href="{{ url('itemIO/'.$data->id.'/edit') }}" class="btn btn-warning">ubah</a>
                                                            {{--<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data stok ini ... ?')">ubah</button>--}}
                                                        </form>
                                                    </td>
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
    </section>
    <!-- /.content -->
</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
@stop