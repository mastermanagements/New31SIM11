@extends('user.produksi.master_user')


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
                      <ul class="nav nav-tabs">
                          <!--<li class="active"><a href="#tab_1" data-toggle="tab">Penawaran penjualan</a></li>-->
                          <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Pesanan penjualan</a></li>
                          <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Diskon</a></li>
                          <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Penjualan</a></li>
                          <li class="@if(Session::get('tab5') == 'tab5') active @else '' @endif"><a href="#tab_5" data-toggle="tab"><i class="fa fa-book"></i> Pembayaran</a></li>
                          <li class="@if(Session::get('tab6') == 'tab6') active @else '' @endif"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i> Return Penjualan</a></li>
                          <li class="@if(Session::get('tab7') == 'tab7') active @else '' @endif"><a href="#tab_7" data-toggle="tab"><i class="fa fa-book"></i> History Harga Penjualan</a></li>
                          <li class="@if(Session::get('tab8') == 'tab8') active @else '' @endif"><a href="#tab_8" data-toggle="tab"><i class="fa fa-book"></i> Pengaturan Akun Penjualan</a></li>
                      </ul>
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
                                            <th>
                                                @if(!empty($data->linkktoKlien))
                                                    {{ $data->linkktoKlien->nm_klien }}
                                                @else
                                                    Klien Umum
                                                @endif
                                             </th>
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
                                                <td>{{ $no++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($data->tgl_so)) }}</td>
                                                <td>{{ $data->no_so }}</td>
                                                <td>
                                                    @if(!empty($data->linkToKlien))
                                                        {{ $data->linkToKlien->nm_klien }}
                                                    @else
                                                        Klien Umum
                                                    @endif
                                                </td>
                                                <td>{{ $data->total }}</td>
                                                <td>
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
                        <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
                            <a href="{{ url('p-diskon/create') }}" class="btn btn-primary">Tambah Diskon</a>
                          <div class="row">
                            <div class="col-md-12">
                                <h4 style="font-weight: bold">Diskon Member</h4>
                              <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Jenis Member</td>
                                    <td>Diskon Persen</td>
                                    <td>Diskon Nominal</td>
                                    <td>Aksi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($pDiskon))
                                    @php($no=1)
                                    @foreach($pDiskon as $data)
                                      @if($data->id_group !=0)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td width="200">
                                              @if(!empty($data->linkToDiskon->nama_group))
                                                {{ $data->linkToDiskon->nama_group }}
                                              @endif

                                            </td>
                                            <td width="100">{{ $data->diskon_persen }} %</td>
                                            <td width="150">{{ rupiahView($data->diskon_nominal) }}</td>
                                            <td>
                                                <form action="{{ url('p-diskon/'.$data->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('p-diskon/'.$data->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                       @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                          </div>
                          <!--div./col-12-->
                          <div class="col-md-12">
                              <h4 style="font-weight: bold">Diskon Berdasarkan Jumlah Pembelian</h4>
                            <table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <td>No.</td>
                                  <td>Jumlah Maksimal Pembelian</td>
                                  <td>Diskon Persen</td>
                                  <td>Diskon Nominal</td>
                                  <td>Aksi</td>
                              </tr>
                              </thead>
                              <tbody>
                              @if(!empty($pDiskon))
                                  @php($no=1)
                                  @foreach($pDiskon as $data)
                                    @if($data->id_group ==0)
                                      <tr>
                                          <td>{{$no++}}</td>
                                          <td width="200">
                                            {{ $data->jumlah_maks_beli}}
                                          </td>
                                          <td width="100">{{ $data->diskon_persen }} %</td>
                                          <td width="150">{{ rupiahView($data->diskon_nominal) }}</td>
                                          <td>
                                              <form action="{{ url('p-diskon/'.$data->id) }}" method="post">
                                                  {{ csrf_field() }}
                                                  @method('delete')
                                                  <a href="{{ url('p-diskon/'.$data->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')">Hapus</button>
                                              </form>
                                          </td>
                                      </tr>
                                     @endif
                                  @endforeach
                              @endif
                              </tbody>
                          </table>
                        </div>
                        <!--div./col-12-->
                      </div>
                    <!--div./row-->
                    </div>
                        <div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
                            <a href="{{ url('penjualan-barang/create') }}" class="btn btn-primary pull-left">Tambah</a>
                            <a href="{{ url('komisi-sales') }}" class="btn btn-primary pull-right">Komisi Sales</a>
                            <table class="table table-bordered table-striped" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Jual</th>
                                        <th>Nomor Order</th>
                                        <th>Klien</th>
                                        <th>Tgl Kirim</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
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
                                            <td>
                                                @if(!empty($item_Psales->linkToKlien))
                                                    {{ $item_Psales->linkToKlien->nm_klien }}
                                                @else
                                                    Klien Umum
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($item_Psales->tgl_kirim)) }}</td>
                                            <td>{{ rupiahView($item_Psales->total) }}</td>
                                            <td>
                                                <form action="{{ url('penjualan-barang/'. $item_Psales->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('penjualan-barang/'. $item_Psales->id) }}" class="btn btn-primary">Detail barang</a>
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
                      <div class="tab-pane @if(Session::get('tab5') == 'tab5') active @else '' @endif" id="tab_5">
                            <p><b>Pembayaran Pesanan Penjualan</b></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Pesanan</th>
                                        <th>Klien</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Jumlah DP</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Bukti</th>
                                        <!--<th>Konfirmasi</th>-->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @if(!empty($p_so))
                                    @php($no=1)
                                    <tbody>
                                        @foreach($p_so as $data_so)

                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data_so->no_so }}</td>
                                                <td>
                                                    @if(!empty($data_so->linkToKlien))
                                                        {{ $data_so->linkToKlien->nm_klien }}
                                                    @else
                                                        Klien Umum
                                                    @endif
                                                </td>

                                                <td>{{ date('d-m-Y', strtotime($data_so->tgl_so)) }}</td>
                                                <td>@if(!empty($data_so->linkToTerimaBayar)) {{ date('d-m-Y', strtotime($data_so->linkToTerimaBayar->tgl_bayar)) }} @endif  </td>
                                                <td>{{  rupiahView($data_so->dp_so) }}</td>
                                                <td>@if(!empty($data_so->linkToTerimaBayar)) {{ rupiahView($data_so->linkToTerimaBayar->jumlah_bayar) }} @endif</td>
                                                <td><a href="#">Preview</a></td>
                                                <!--<td><a href="#">konfirm</a></td>-->
                                                <td>
                                                    <a href="{{ url('terima-bayar/0/'. $data_so->id) }}">Terima </a> &nbsp; &nbsp;
                                                    <a href="{{ url('terima-bayar/0/'. $data_so->id.'/rincian') }}">Rincian </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                            <p><b>Pembayaran Penjualan</b></p>
                            <table id="example3" class="table table-bordered table-striped" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Transaksi</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Klien</th>

                                        <th>Penjualan</th>
                                        <th>Jumlah Belanja</th>
                                          <th>Tgl Jatuh Tempo</th>
                                        <th>Jumlah Terbayar</th>
                                        <th>Sisa Hutang</th>
                                        <!--<th>Bukti Bayar</th>-->
                                        <!--<th>Konfirm</th>
                                        <th>Status</th>-->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($PSales))
                                        @php($no_p_sales=1)
                                        @php($sisa_hutang=0)
                                        @php($total_bayar=0)
                                          @php($jumlah_terbayar=0)
                                        @foreach($PSales->sortBy('metode_bayar',0) as $item_Psales_)
                                        <tr>
                                            <td>{{ $no_p_sales++ }}</td>
                                            <td>{{ $item_Psales_->no_sales }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item_Psales_->tgl_sales)) }}</td>
                                            <td>
                                                @if(!empty($item_Psales_->linkToKlien))
                                                   {{ $item_Psales_->linkToKlien->nm_klien }}
                                                @else
                                                    Klien Umum
                                                @endif
                                            </td>
                                            <td>@if($item_Psales_->metode_bayar == '0') Tunai @else Kredit @endif</td>
                                            <td>{{ rupiahView($item_Psales_->total) }}</td>
                                            <td>@if(!empty($item_Psales_->tgl_jatuh_tempo)) {{  tanggalView($item_Psales_->tgl_jatuh_tempo)}} @endif </td>
                                            @if($item_Psales_->metode_bayar =='0')
                                                <!--jumlah_bayar = p_sales.bayar-->
                                                @php($jumlah_terbayar= $item_Psales_->bayar)
                                              @else
                                                <!--jumlah terbayar = p_sales.bayar + sum(p_terima_bayar.jumlah_bayar)-->

                                                    @php($total_bayar = $item_Psales_->linkToMannyTerimaBayar->sum('jumlah_bayar'))
                                                    @php($jumlah_terbayar= $item_Psales_->bayar + $total_bayar)

                                            @endif
                                            <td>{{ rupiahView($jumlah_terbayar) }}</td>


                                            <!--sisa hutang = p_sales.krg_bayar - sum(p_terima_bayar.jumlah_bayar)-->

                                              @php($total_bayar = $item_Psales_->linkToMannyTerimaBayar->sum('jumlah_bayar'))
                                              @php($sisa_hutang = $item_Psales_->kurang_bayar - $total_bayar)

                                              <td>{{ rupiahView($sisa_hutang ) }}</td>
                                            <!--<td><a href="#">Preview</a></td>
                                            <td><a href="#">Yes</a> </td>
                                            <td>
                                                @if($item_Psales_->bayar+$item_Psales_->kurang_bayar>=$item_Psales_->bayar)
                                                    Lunas
                                                @else
                                                    Belum Lunas
                                                @endif
                                            </td>-->
                                            <td>
                                                <a href="{{ url('terima-bayar/1/'. $item_Psales_->id) }}" >Terima </a>
                                                <a href="{{ url('terima-bayar/1/'. $item_Psales_->id.'/rincian') }}" >Rincian </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                          <div class="tab-pane @if(Session::get('tab6') == 'tab6') active @else '' @endif" id="tab_6">
                            <h4>Return Penjualan</h4>
                            <table  class="table table-bordered table-striped"  style="width: 100%">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Klien</th>
                                      <th>No. Faktur</th>
                                      <th>Tgl Transaksi</th>
                                      <th>Nama Barang</th>
                                      <th>Harga Jual</th>
                                      <th>Barang Kurang</th>
                                      <th>Barang Rusak</th>
                                      <th>Keterangan</th>
                                      <th>Total Return</th>
                                      <!--<th>Konfirm</th>-->
                                      <th>Aksi</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      @if(!empty($PSales))
                                      @php($no_complain=1)
                                      @foreach($complain_jual as $barang_complain)
                                        @if($barang_complain->status_complain =='0' )
                                          @if( $barang_complain->complain_jumlah !=0 OR $barang_complain->complain_kualitas !=0)

                                            @if($barang_complain->status_return =='0')
                                          <tr>
                                              <td>{{ $no_complain++ }}</td>
                                              <td>
                                                  @if(!empty($barang_complain->linkToSales))
                                                    {{ $barang_complain->linkToSales->linkToKlien->nm_klien}}
                                                  @else
                                                      Klien Umum
                                                  @endif
                                              </td>
                                              <td>@if(!empty($barang_complain->linkToSales->no_sales)){{ $barang_complain->linkToSales->no_sales }} @endif</td>
                                              <td>@if(!empty($barang_complain->linkToSales->tgl_sales)){{ tanggalView($barang_complain->linkToSales->tgl_sales) }} @endif</td>
                                              <td>@if(!empty($barang_complain->linkToBarang->nm_barang)){{ $barang_complain->linkToBarang->nm_barang }} @endif</td>
                                              <td>{{ rupiahView($barang_complain->hpp) }}</td>
                                              <td> {{ $barang_complain->complain_jumlah }}</td>
                                              <td> {{ $barang_complain->complain_kualitas }}</td>
                                              <td> {{ $barang_complain->ket }}</td>
                                             <td>{{ rupiahView($barang_complain->total_return) }}</td>
                                              <td>
                                                  <a href="{{ url('return-barang-jual/'. $barang_complain->id) }}">Return &nbsp;</a>
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="_method" value="put"/>
                                                  <a href="{{ url('status-return-barang-jual/'.$barang_complain->id) }}" onclick="return confirm('Apakah proses return penjualan barang ini telah selesai?');">Selesai</a>
                                                  <!--<a href="{{ url('cetak-return-barang-jual/'. $barang_complain->id) }}">Print &nbsp;&nbsp;</a>-->
                                                  <!--<a href="">Konfirm</a>-->
                                                </th>
                                            </tr>

                                             @endif
                                            @endif
                                          @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane @if(Session::get('tab7') == 'tab7') active @else '' @endif" id="tab_7">
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Klien</label>
                                     <select class="form-control select2" name="id_klien" style="width: 100%" required>
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
                                     <input type="date" class="form-control" name="tgl_awal" required>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-control select2" name="id_barang" id="barang_id" style="width: 100%" required>
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
                                    <input type="date" class="form-control" name="tgl_akhir" id="akhir_tgl" required>
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
                      <!-- /.tab-pane -->
                          <div class="tab-pane @if(Session::get('tab8') == 'tab8') active @else '' @endif" id="tab_8">
                          <a href="{{ url('pengaturan-akun-penjualan/create') }}">Tambah Akun Penjualan</a>
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
                                          <th rowspan="{{ $rowspan }}">{{ $jenis_jurnal[$data->jenis_jurnal] }}<br><a href="{{ url('pengaturan-akun-penjualan/'.$data->id.'/edit') }}">ubah &nbsp;&nbsp;</a> <a href="{{ url('pengaturan-akun-penjualan/'.$data->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus akun penjualan ini.');">hapus</a> </th>
                                          <th rowspan="{{ $rowspan }}">{{ $data->linkToOneKetTransaksi->nm_transaksi }}</th>
                                      </tr>
                                      @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                                          @if($data_ket=$data->linkToOneKetTransaksi->dataAkun)
                                              @foreach($data_ket as $data)
                                                  <tr>
                                                      <td>
													  
														@if(!empty($data->transaksi->kode_akun_aktif) AND !empty($data->transaksi->nm_akun_aktif) )	{{ $data->transaksi->kode_akun_aktif }} {{ $data->transaksi->nm_akun_aktif }} @endif
														
													  </td>
                                                      <td>@if($data->posisi_akun=='0') D @else K @endif</td>
                                                  </tr>
                                              @endforeach
                                          @endif
                                      @endif
                                  @endforeach
                              @endif
                          </table>
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
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
