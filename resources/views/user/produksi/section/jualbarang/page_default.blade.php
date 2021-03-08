@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penjualan
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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Penawaran penjualan</a></li>
                        <li ><a href="#tab_2" data-toggle="tab">Pesanan penjualan</a></li>
                        <li ><a href="#tab_3" data-toggle="tab">Penjualan</a></li>
                        <li ><a href="#tab_4" data-toggle="tab">Penjualan</a></li>
                        <li ><a href="#tab_5" data-toggle="tab">Pembayaran</a></li>
                        <li ><a href="#tab_6" data-toggle="tab">Return Pembayaran</a></li>
                        <li ><a href="#tab_7" data-toggle="tab">History Harga Penjualan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="{{ url('penawaran-penjualan') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Tawar</th>
                                    <th>Promo</th>
                                    <th>Klien</th>
                                    <th>Tanggal tawar</th>
                                    <th>Tanggal berlaku</th>
                                    <th>Tanggal kirim</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($tawar_jual))
                                @php($i=1)
                                    @foreach($tawar_jual as $data)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <th>{{ $data->no_invoice }}</th>
                                            <th>{{ $data->no_tawar }}</th>
                                            <th>{{ $data->linkktoKlien->nm_klien }}</th>
                                            <th>{{ $data->tgl_tawar }}</th>
                                            <th>{{ $data->tgl_berlaku }}</th>
                                            <th>{{ $data->tgl_krm }}</th>
                                            <th>{{ $data->ket }}</th>
                                            <th>
                                                <form action="{{ url('penawaran-penjualan/'.$data->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('detail-barang-Tpenjualan/'.$data->id) }}" class="btn btn-primary">Tambahkan detail barang</a>
                                                    <a href="{{ url('penawaran-penjualan/'. $data->id.'/edit') }}" class="btn btn-warning">Ubah Penawaran</a>
                                                    <button type="submt" href="#" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus nota penawaran penjualan barang ini...?')">Hapus Penawaran</button>
                                                </form>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
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