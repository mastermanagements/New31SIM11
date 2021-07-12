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
                                <h5 style="font-weight: bold">Stok Akhir Barang
                                    {{--<a href="{{ url('inventory/create') }}" class="btn btn-success pull-right" style="margin-bottom: 10px">Tambah Stok Barang</a>--}}
                                </h5><p></p>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Nama Barang</td>
                                            <td>Satuan Barang</td>
                                            <td>Sisa Barang</td>
                                            <td>Keterangan</td>

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
                                                        @if($data->stok_akhir <= 5)
                                                            <label style="color:red">Segera memesan Barang</label>
                                                        @else
                                                            <label style="color:green">Stok aman</label>
                                                        @endif
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
