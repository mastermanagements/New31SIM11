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
                        <!--<li class="active"><a href="#tab_1" data-toggle="tab">Penawaran penjualan</a></li>-->
                        <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Pesanan penjualan</a></li>
                        <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Diskon</a></li>
                        <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Penjualan</a></li>
                        <li class="@if(Session::get('tab5') == 'tab5') active @else '' @endif"><a href="#tab_5" data-toggle="tab"><i class="fa fa-book"></i> Pembayaran</a></li>
                        <li class="@if(Session::get('tab6') == 'tab6') active @else '' @endif"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i> Return Pembayaran</a></li>
                        <li class="@if(Session::get('tab6') == 'tab7') active @else '' @endif"><a href="#tab_7" data-toggle="tab"><i class="fa fa-book"></i> History Harga Penjualan</a></li>
                        <li class="@if(Session::get('tab6') == 'tab8') active @else '' @endif"><a href="#tab_8" data-toggle="tab"><i class="fa fa-book"></i> Jurnal Otomatis Penjualan</a></li>
                    </ul>
                    <div class="tab-content">
                        <!--<div class="tab-pane active" id="tab_1">
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
                        </div>-->
                        <div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">

                            <p style="margin-bottom: 10px;"><b>Daftar Pesanan Penjualan </b> <a href="{{ url('pesanan-penjualan/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Pesanan Penjualan</a>
                            </p><br>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Nomor Pesanan Penjualan</th>
                                        <th>Nomor Pesanan Pembelian</th>
                                        <th>Klien</th>
                                        <th>Tanggal Dikirim</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @if(!empty($p_so))
                                    @php($no=1)
                                    <tbody>
                                        @foreach($p_so as $data)

                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($data->tgl_so)) }}</td>
                                                <td>{{ $data->no_so }}</td>
                                                <td>{{ $data->no_po }}</td>
                                                <td>{{ $data->linkToKlien->nm_klien }}</td>
                                                <td>{{ tanggalView($data->tgl_dikirim) }}</td>
                                                <td>{{ rupiahView($data->total) }}</td>
                                                <td>
                                                    <form action="{{ url('pesanan-penjualan/'.$data->id) }}" method="post" >
                                                        {{ csrf_field() }}
                                                        @method('delete')
                                                        <a href="{{ url('detail-pSo/'.$data->id) }}" class="btn btn-primary">Rincian</a>
                                                        <a href="{{ url('pesanan-penjualan/'.$data->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data nota pesanan ini...?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
                            <a href="{{ url('p-diskon/create') }}" class="btn btn-primary">Tambah Diskon</a>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Group Klien</td>
                                    <td>Jenis Diskon</td>
                                    <td>Jumlah maksimal beli</td>
                                    <td>Diskon (%)</td>
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
                                            <td>{{ rupiahView($data->diskon_nominal) }}</td>
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
                        <div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
                            <a href="{{ url('penjualan-barang/create') }}" class="btn btn-primary pull-left">Penjualan Barang</a>
                            <a href="{{ url('komisi-sales') }}" class="btn btn-primary pull-right">Komisi Sales</a>
                            <table class="table table-bordered table-striped" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Tgl Jual</td>
                                        <td>Nomor Order</td>
                                        <td>Nomor Pesanan Penjualan</td>
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
                                            @if(!empty($item_Psales->linkToSo->no_so))
                                            <td>{{ $item_Psales->linkToSo->no_so }}</td>
                                            @else
                                            <td></td>
                                            @endif

                                            <td>{{ $item_Psales->linkToKlien->nm_klien }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item_Psales->tgl_kirim)) }}</td>
                                            <td>{{ $item_Psales->bayar }}</td>
                                            <td>
                                                <form action="{{ url('penjualan-barang/'. $item_Psales->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('penjualan-barang/'. $item_Psales->id) }}" class="btn btn-primary">Rincian Barang</a>
                                                    <a href="{{ url('penjualan-barang/'. $item_Psales->id.'/complain') }}" class="btn btn-primary">Complain</a>
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
                            <p>Pembayaran Pesanan Penjualan</p>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor. Pesanan</th>
                                        <th>Klien</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Jumlah DP</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Bukti</th>
                                        <th>Konfirmasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @if(!empty($p_so))
                                    @php($no=1)
                                    <tbody>
                                        @foreach($p_so as $data_so)

                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <th>{{ $data_so->no_so }}</th>
                                                <th>{{ $data_so->linkToKlien->nm_klien }}</th>

                                                <th>{{ date('d-m-Y', strtotime($data_so->tgl_so)) }}</th>
                                                <th>@if(!empty($data_so->linkToTerimaBayar)) {{ date('d-m-Y', strtotime($data_so->linkToTerimaBayar->tgl_bayar)) }} @endif  </th>
                                                <th>{{  $data_so->dp_so }}</th>
                                                <th>@if(!empty($data_so->linkToTerimaBayar)) {{ $data_so->linkToTerimaBayar->jumlah_bayar }} @endif</th>
                                                <th><a href="#">Preview</a></th>
                                                <th><a href="#">konfirm</a></th>
                                                <th>
                                                    <a href="{{ url('terima-bayar/0/'. $data_so->id) }}">Terima Pembayaran</a> <br>
                                                    <a href="{{ url('terima-bayar/0/'. $data_so->id.'/rincian') }}">Rincian Pembayaran</a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                            <p>Pembayaran Penjualan</p>
                            <table class="table table-bordered table-striped" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Order</th>
                                        <th>Tgl Jual</th>
                                        <th>Klien</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Tgl Bayar</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Sisa</th>
                                        <th>Penjualan</th>
                                        <th>Bukti Bayar</th>
                                        <th>Konfirm</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($PSales))
                                        @php($no_p_sales=1)
                                        @foreach($PSales as $item_Psales_)
                                        <tr>
                                            <th>{{ $no_p_sales }}</th>
                                            <th>{{ $item_Psales_->no_sales }}</th>
                                            <th>{{ date('d-m-Y', strtotime($item_Psales_->tgl_sales)) }}</th>
                                            <th>{{ $item_Psales_->linkToKlien->nm_klien }}</th>
                                            <th>{{ date('d-m-Y', strtotime($item_Psales_->tgl_kirim)) }}</th>
                                            <th>@if(!empty($item_Psales_->linkToTerimaBayar)) {{ date('d-m-Y', strtotime($item_Psales_->linkToTerimaBayar->tgl_bayar)) }} @endif</th>
                                            <th>{{ $item_Psales_->bayar+$item_Psales_->kurang_bayar }}</th>
                                            <th>@if(!empty($item_Psales_->linkToTerimaBayar)) {{ $item_Psales_->linkToTerimaBayar->jumlah_bayar }} @endif</th>
                                            <th>{{ $item_Psales_->kurang_bayar }}</th>
                                            <th>@if($item_Psales_->status == '0') Tunai @else Kredit @endif</th>
                                            <th><a href="#">Preview</a> </th>
                                            <th><a href="#">Yes</a> </th>
                                            <th>
                                                @if($item_Psales_->bayar+$item_Psales_->kurang_bayar>=$item_Psales_->bayar)
                                                    Lunas
                                                @else
                                                    Belum Lunas
                                                @endif
                                            </th>
                                            <th>
                                                <a href="{{ url('terima-bayar/1/'. $item_Psales_->id) }}" >Terima Bayar</a>
                                                <a href="{{ url('terima-bayar/1/'. $item_Psales_->id.'/rincian') }}" >Rincian Bayar</a>
                                            </th>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="tab_6">
                            <h1>Return Pembayaran</h1>
                            <table  class="table table-bordered table-striped"  style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Faktur</th>
                                        <th>Klien</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Return</th>
                                        <th>Konfirm</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($PSales))
                                        @php($no_complain=1)
                                        @foreach($PSales as $data_barang_complain)
                                            <tr>
                                                <th>{{ $no_complain++ }}</th>
                                                <th>{{ $data_barang_complain->no_sales }}</th>
                                                <th>{{ $data_barang_complain->linkToKlien->nm_klien }}</th>
                                                <th>{{ $data_barang_complain->tgl_sales }}</th>
                                                <th>{{ $data_barang_complain->linkToMannyComplainJual->where('status_complain','1')->count('id') }}</th>
                                                <th>{{ $data_barang_complain->linkToMannyComplainJual->where('status_complain','1')->sum('total_return') }}</th>
                                                <th>Yes</th>
                                                <th>
                                                    <a href="{{ url('return-barang-jual/'. $data_barang_complain->id) }}">Return</a>
                                                    <a href="{{ url('cetak-return-barang-jual/'. $data_barang_complain->id) }}">Print</a>
                                                    <a href="">Konfirm</a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane " id="tab_7">
                            <a href="{{ url('pengaturan-akun-penjualan/create') }}">Tamba Akun Penjualan</a>
                            <table class="table table-bordered " style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Keterangan transaksi</th>
                                    <th>Kode & Nama Akun</th>
                                    <th>Posisi</th>
                                </tr>
                                </thead>
                                @if(!empty($akun_penjualan))
                                    @php($no=1)
                                    @foreach($akun_penjualan as $data)
                                        @php($rowspan = 0)
                                        @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                                            @if($rows=$data->linkToOneKetTransaksi->dataAkun->count())
                                                @php($rowspan=$rows+1)
                                            @endif
                                        @endif
                                        <tr>
                                            <th rowspan="{{ $rowspan }}">{{ $no++ }}</th>
                                            <th rowspan="{{ $rowspan }}">{{ $jenis_jurnal[$data->jenis_jurnal] }}<br><a href="{{ url('pengaturan-akun-penjualan/'.$data->id.'/edit') }}">ubah</a> <a href="{{ url('pengaturan-akun-penjualan/'.$data->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus akun penjualan ini.');">hapus</a> </th>
                                            <th rowspan="{{ $rowspan }}">{{ $data->linkToOneKetTransaksi->nm_transaksi }}</th>
                                        </tr>
                                        @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                                            @if($data_ket=$data->linkToOneKetTransaksi->dataAkun)
                                                @foreach($data_ket as $data)
                                                    <tr>
                                                        <td>{{ $data->transaksi->kode_akun_aktif }} {{ $data->transaksi->nm_akun_aktif }}</td>
                                                        <td>@if($data->posisi_akun=='0') D @else K @endif</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane " id="tab_8">
                           <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Klien</label>
                                        <select class="form-control select2" name="id_klien" style="width: 100%">
                                            <option disabled>Pilih Klien</option>
                                            @if(!empty($klien))
                                                @foreach($klien as $data_klien)
                                                    <option>{{ $data_klien->nm_klien }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                   <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <input type="date" class="form-control" name="tgl_awal">
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Nama Barang</label>
                                       <select class="form-control select2" name="id_barang" id="barang_id" style="width: 100%">
                                           <option disabled>Pilih barang</option>
                                           @if(!empty($barang))
                                               @foreach($barang as $data_barang)
                                                   <option>{{ $data_barang->nm_barang }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Sampai Tanggal</label>
                                       <input type="date" class="form-control" name="tgl_akhir" id="akhir_tgl">
                                   </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <button type="button" class="btn btn-primary pull-left" onclick="load_data_history()">Tampilkan</button>
                                   </div>
                               </div>
                               <div class="col-md-12" style="margin-top: 10px">
                                   <table class="table table-bordered table-striped" id="table_history" style="width: 100%;margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tgl Transaksi</th>
                                                <th>No. Faktur</th>
                                                <th>Nama Barang</th>
                                                <th>Spek</th>
                                                <th>Klien</th>
                                                <th>Jumlah Barang</th>
                                                <th>Satuan</th>
                                                <th>Harga Jual</th>
                                            </tr>
                                        </thead>
                                   </table>
                               </div>
                           </div>
                        </div>
                        <div class="tab-pane " id="tab_9">
                            <h3>Setting kasir</h3>
                            <a href="{{ url('setting-kasir/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Tambah Setting Kas Kasir</a>
                            <table class="table table-bordered " style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Shift</th>
                                        <th>AKun Kas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($SettingKasir)
                                        @php($n_sk=1)
                                        @foreach($SettingKasir as $dsk)
                                            <tr>
                                                <th>{{ $n_sk++ }}</th>
                                                <th>{{ $dsk->linkToKaryawan->nama_ky }}</th>
                                                <th>{{ $dsk->shift }}</th>
                                                <th>
                                                    @if(!empty($dsk->linkToSettingAkunKasir))
                                                        @foreach($dsk->linkToSettingAkunKasir as $data)
                                                            <label>{{ $data->linkToAkunAktif->kode_akun_aktif }} : {{ $data->linkToAkunAktif->nm_akun_aktif }}</label><br>
                                                        @endforeach
                                                    @endif
                                                </th>
                                                <th>
                                                    <form action="{{ url('setting-kasir/'.$dsk->id) }}" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                        <a href="{{ url('setting-akun-kasir/'.$dsk->id) }}" class="btn btn-primary">Detail Akun</a>
                                                        <a href="{{ url('setting-kasir/'.$dsk->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                                                        <button class="btn btn-danger" typeof="submit">hapus</button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_10">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="kerja-kasir/masuk-kerja" method="post">
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label>Shift Kasir</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_shift_karyawan">
                                                <option>Pilih Sift</option>
                                                @if(!empty($SettingKasir))
                                                    @foreach($SettingKasir as $dsk)
                                                        <option value="{{$dsk->id}}">{{ $dsk->linkToKaryawan->nama_ky }} Shift ke:{{ $dsk->shift }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <table  class="table table-bordered table-striped"  style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tgl</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Karyawan</th>
                                            <th>Shift</th>
                                            <th>Total pemasukan</th>
                                            <th>Total Pengeluaran</th>
                                            <th>Disetor</th>
                                            <th>Penerima</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($KerjaKasir))
                                            @php($no_kerja = 1)
                                            @foreach($KerjaKasir as $dkk)
                                                    <tr>
                                                        <th>{{ $no_kerja++ }}</th>
                                                        <th>{{ date('d-m-Y', strtotime($dkk->tgl_mulai)) }}</th>
                                                        <th>{{ $dkk->jam_mulai }}</th>
                                                        <th>{{ $dkk->jam_selesai }}</th>
                                                        <th>{{ $dkk->linkToKasir->linkToKaryawan->nama_ky }}</th>
                                                        <th>{{ $dkk->linkToKasir->shift }}</th>
                                                        <th>0</th>
                                                        <th>0</th>
                                                        <th>0</th>
                                                        <th>{{ $dkk->linkToKaryawan->nama_ky }}</th>
                                                        <th>
                                                            <button class="btn btn-primary">Rincian</button>
                                                            <button class="btn btn-primary">Edit</button>
                                                            <button class="btn btn-primary">Tutup Shift</button>
                                                        </th>
                                                    </tr>
                                           @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
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
    <script>
        var tabel_history = $('#table_history').DataTable({
            data :[],
            column:[
                {'data':'0'},
                {'data':'1'},
                {'data':'2'},
                {'data':'3'},
                {'data':'4'},
            ],
            {{--drawCallback: buttonBuild("{{ $thn_proses }}"),--}}
            filter: false,
            pagging : true,
            searching: false,
            info : true,
            ordering : false,
            processing : true,
            retrieve: true
        })
        load_data_history=function(){
            $.ajax({
                url:"{{ url('riwayat-harga-penjualan') }}",
                type: "post",
                data: {
                    '_token':"{{ csrf_token() }}",
                    '_method':"post",
                    'id_klien': $('[name="id_klien"]').val(),
                    'tgl_awal': $('[name="tgl_awal"]').val(),
                    'barang_id': $('[name="id_barang"]').val(),
                    'tgl_akhir': $('[name="tgl_akhir"]').val(),
                },
                success: function (result) {
                    console.log(result);
                    tabel_history.clear().draw();
                    tabel_history.rows.add(result).draw();
                }
            })
        }
    </script>
@stop
