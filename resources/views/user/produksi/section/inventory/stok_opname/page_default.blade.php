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
                                <h5 style="font-weight: bold">Stok Opname
                                    <a target="_blank" href="{{ url('stok-opname-print') }}" class="btn btn-success pull-right" style="margin-bottom: 10px">Print Stok Opname</a>
                                    <a href="{{ url('history-barang') }}" class="btn btn-primary pull-right" style="margin-bottom: 10px">History Stok Opname</a>
                                </h5>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Nama Barang</td>
                                            <td>Satuan Barang</td>
                                            <td>Sisa Barang</td>
                                            <td>Aksi</td>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($no=1)
                                        @if(!empty($data_barang))
                                            @foreach($data_barang as $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $data->nm_barang }}</td>
                                                     <td>@if(!empty($data->linkToSatuan->satuan)){{ $data->linkToSatuan->satuan }} @endif</td>
                                                    <td>{{ $data->stok_akhir }}</td>
                                                    <td>
                                                        <a href="{{ url('perbaikan-stok/'.$data->id) }}" class="btn btn-warning"><font color="#070808">Perbaiki Stok</font></a>
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