@extends('kasir.master')
@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                @if(!empty(session('message_success')))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        {{ session('message_success')}}
                    </div>
                @elseif(!empty(session('message_fail')))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        *{{ session('message_fail') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ url('Kasir') }}" method="post" >
                            {{ csrf_field() }}
                            <div class="box">
                            <div class="box-header">
                                <h4 class="box-title"> No Faktur:{{ $kode }}</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="kode" value="{{ $kode }}">
                                                    <input class="form-control" name="code_barcode" id="input_code_barcode" placeholder="Masukan Code Barcode">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah Barang</button>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-danger pull-right" onclick="reset_barang()">Reset Barang</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 class="box-title"> Daftar Penjualan Barang:</h4>
                                        <hr>
                                        <table class="table table-striped" id="daftar_table_pesanan" style="overflow-y: scroll;">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Barang </th>
                                                <th>Jumlah Penjualan</th>
                                                <th>Harga Satuan</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="bayar" id="bayar" class="form-control" required>
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-info btn-flat">Bayar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <p></p>
                                        <input type="hidden" name="total_penjualan" id="total_penjualan" value="0">
                                        <button type="submit" id="btn_proses" class="btn btn-success">Proses</button> <small style="color: red;" id="notif_bayar"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <h1 id="total_akhir">Total Rp: 0</h1>
                                  </div>
                                  <div class="col-md-6">
                                      <h1 id="total_bayar">Bayar Rp: 0</h1>
                                  </div>
                                  <div class="col-md-12">
                                      <h1 id="total_kembalian">Kembalian Rp: 0</h1>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Daftar Penjualan Hari Ini</h4>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Transaksi</th>
                                            <th>Jumlah Item Penjualan</th>
                                            <th>Total Penjualan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="overflow-y: scroll;">

                                        @if(!empty($nota))
                                            @php($no=1)
                                            @foreach($nota as $data)
                                                <tr>
                                                    <th>{{ $no++ }}</th>
                                                    <th>{{ $data->no_sales }}</th>
                                                    <th>{{ $data->linkToDetailSales->count('id') }}</th>
                                                    <th>RP. {{ number_format($data->linkToDetailSales->sum('jumlah_harga'),2,',','.') }}</th>
                                                    <th>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-flat">Aksi</button>
                                                            <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="{{ url('cetak-nota/'.$data->id) }}" target="_blank">Print</a></li>
                                                                <li><a href="#" onclick="cek_barang({{ $data->id }})" id="cek_barang_nota">Cek Barang</a></li>
                                                                <li><a href="{{ url('hapus-nota-kasir/'.$data->id) }}" onclick="return confirm('Apakah anda akan menghapus nota ini ...? ')">hapus</a></li>
                                                            </ul>
                                                        </div>
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
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <form id="form-pesanan" method="post">
                {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal Pesanan Barang</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Barang</label>
                            <select class="form-control select2" name="id_barang" id="barang" required>
                                <option value="">Pilih Barang</option>
                                @if(!empty($barang))
                                    @foreach($barang as $data_item)
                                        <option value="{{ $data_item->id }}">{{ $data_item->nm_barang }},{{ $data_item->linkToSatuan->satuan }} ,{{ $data_item->spec }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input  type="number" class="form-control" name="jumlah" value="1" id="jumlah">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="hpp" value="0" id="hpp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="tombol_tambah">Simpan</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            </form>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-detail-barang">
            <form>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modal Detail Barang</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="detail_tabel_modal">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Jumlah Penjualan</th>
                                            <th>Harga Satuan</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p style="font-weight: bold" id="belanja_total"></p>
                                    </div>
                                    <div class="form-group">
                                        <p style="font-weight: bold" id="modal_total_bayar"></p>
                                        <p style="font-weight: bold" id="kembalian"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="tombol_tambah">Simpan</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </form>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
@stop

@include('user.global.rupiah_input')
@include('kasir.page.kasir.js')