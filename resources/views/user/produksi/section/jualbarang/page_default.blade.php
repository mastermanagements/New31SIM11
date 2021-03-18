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
                        <li ><a href="#tab_3" data-toggle="tab">Diskon</a></li>
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
                        <div class="tab-pane " id="tab_2">
                            <a href="{{ url('pesanan-penjualan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Nomor. Pesanan</th>
                                        <th>Klien</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @if(!empty($p_so))
                                    @php($no=1)
                                    <tbody>
                                        @foreach($p_so as $data)

                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <th>{{ date('d-m-Y', strtotime($data->tgl_so)) }}</th>
                                                <th>{{ $data->no_so }}</th>
                                                <th>{{ $data->linkToKlien->nm_klien }}</th>
                                                <th>{{ $data->total }}</th>
                                                <th>
                                                    <form action="{{ url('pesanan-penjualan/'.$data->id) }}" method="post" >
                                                        {{ csrf_field() }}
                                                        @method('delete')
                                                        <a href="{{ url('detail-pSo/'.$data->id) }}" class="btn btn-primary">detail barang</a>
                                                        <a href="{{ url('pesanan-penjualan/'.$data->id.'/edit') }}" class="btn btn-warning">ubah</a>
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data nota pesanan ini...?')">hapus</button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="tab-pane " id="tab_3">
                            <a href="{{ url('p-diskon/create') }}" class="btn btn-primary">Tambah Diskon</a>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Group Klien</td>
                                    <td>Jenis Diskon</td>
                                    <td>Jumlah maksimal beli</td>
                                    <td>Diskon Persen</td>
                                    <td>Diskon Nominal</td>
                                    <td>Aksi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($pDiskon))
                                    @php($no++)
                                    @foreach($pDiskon as $data)
                                        <tr>
                                            <td>No.</td>
                                            <td>{{ $data->linkToDiskon->nama_group }}</td>
                                            <td>
                                                @if($data->jenis_diskon=='0')
                                                    Berdasarkan jumlah pembelian
                                                @else
                                                    Diskon member
                                                @endif
                                            </td>
                                            <td>{{ $data->jumlah_maks_beli }}</td>
                                            <td>{{ $data->diskon_persen }}</td>
                                            <td>{{ $data->diskon_nominal }}</td>
                                            <td>
                                                <form action="{{ url('p-diskon/'.$data->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('p-diskon/'.$data->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="tab_4">
                            <a href="{{ url('penjualan-barang/create') }}" class="btn btn-primary pull-left">Penjualan Barang</a>
                            <a href="{{ url('komisi-sales') }}" class="btn btn-primary pull-right">Komisi Sales</a>
                            <table class="table table-bordered table-striped" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Tgl Jual</td>
                                        <td>Nomor Order</td>
                                        <td>Klien</td>
                                        <td>Tgl Kirim</td>
                                        <td>Total</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($PSales))
                                        @php($no_p_sales=1)
                                        @foreach($PSales as $item_Psales)
                                        <tr>
                                            <td>{{ $no_p_sales }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item_Psales->tgl_sales)) }}</td>
                                            <td>{{ $item_Psales->no_sales }}</td>
                                            <td>{{ $item_Psales->linkToKlien->nm_klien }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item_Psales->tgl_kirim)) }}</td>
                                            <td>{{ $item_Psales->bayar }}</td>
                                            <td>
                                                <form action="{{ url('penjualan-barang/'. $item_Psales->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('penjualan-barang/'. $item_Psales->id) }}" class="btn btn-primary">Detail barang</a>
                                                    <a href="{{ url('penjualan-barang/'. $item_Psales->id.'/edit') }}" class="btn btn-warning">ubah</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini...?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="tab_5">
                            <h1>Pembayaran</h1>
                        </div>
                        <div class="tab-pane " id="tab_6">
                            <h1>Return Pembayaran</h1>
                        </div>
                        <div class="tab-pane " id="tab_7">
                            <h1>History Harga penjualan</h1>
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