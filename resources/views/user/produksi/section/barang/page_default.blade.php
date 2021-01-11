@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Barang
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
                        <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Barang  </a></li>
                        <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Daftar Harga Barang </a></li>
                        <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Koversi Satuan </a></li>
                        <li class="@if(Session::get('tab6') == 'tab6') active @else '' @endif"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i> Promosi Barang </a></li>
                        <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Daftar Konversi Barang </a></li>
                        <li class="@if(Session::get('tab5') == 'tab5') active @else '' @endif"><a href="#tab_5" data-toggle="tab"><i class="fa fa-book"></i> Transfer Data Barang </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-barang') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Barang </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-barang') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="nm_barang" class="form-control" placeholder="cari berdasarkan nama barang" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_barang))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan Barang </h4></div>
                                @else
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tabel Barang</h3>
                                                <div class="box-tools pull-right">

                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Barcode</th>
                                                                <th>Kode-Nama Barang</th>
                                                                <th>Satuan</th>
                                                                <th>Kategori Barang</th>
                                                                <th>Spesifikasi</th>
                                                                <th>Deskripsi</th>
                                                                <th>No Rak</th>
                                                                <th>Stok Minimum</th>
                                                                <th>HPP</th>
                                                                <th>Metode jual</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php($no = 1)
                                                                @foreach($data_barang as $data)
                                                                    <tr>
                                                                        <td>{{ $no++ }}</td>
                                                                        <td>{{ $data->barcode }}</td>
                                                                        <td>{{ $data->kd_barang }} {{ $data->nm_barang }}</td>
                                                                        <td>{{ $data->linkToSatuan->satuan_brg }}</td>
                                                                        <td>{{ $data->getkategori->nm_kategori_p }}</td>
                                                                        <td>{!!  substr($data->spec_barang,0,100) !!}</td>
                                                                        <td>{!! substr($data->desc_barang,0,100) !!}</td>
                                                                        <td>{{ $data->no_rak }}</td>
                                                                        <td>{{ $data->stok_minimum }}</td>
                                                                        <td>{{ $data->hpp }}</td>
                                                                        <td>

                                                                                @if($data->metode_jual == '0')
                                                                                   <a href="#" onclick='window.location.href="{{ url('harga-jual-satuan/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> berdasarkan satu harga</a>
                                                                                @else
                                                                                    <a href="#" onclick='window.location.href="{{ url('harga-jual-baseon-jumlah/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> berdasarkan jumlah barang</a>
                                                                                @endif
                                                                        </td>
                                                                        <th>
                                                                            <form action="{{ url('delete-barang/'.$data->id) }}" method="post">
                                                                                <a href="{{ url('ubah-barang/'.$data->id) }}" type="button" class="btn btn-warning" title="ubah jasa">ubah</a>
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="_method" value="put">
                                                                                <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="btn btn-danger" title="hapus proposal">hapus</button>
                                                                            </form>
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    {{--<div class="col-md-12">--}}
                                                        {{--{{ $data_barang->links() }}--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>

                                @endif
                            </div>
                        </div>
                        <div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="font-weight: bold">Daftar Harga Barang Satuan</h4>
                                        <table id="example3" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Nama Barang</td>
                                                <td>Harga HPP</td>
                                                <td>Harga Jual</td>
                                                <td>Aksi</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($no=1)
                                            @if(!empty($data_barang))
                                                @foreach($data_barang as $data_barangs )
                                                    @foreach($data_barangs->linkToHargaJualSatuan as $data_satuan)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $data_satuan->linkToBarang->nm_barang }}</td>
                                                            <td>{{ $data_satuan->linkToBarang->hpp }}</td>
                                                            <td>{{ $data_satuan->harga_jual }}</td>
                                                            <td>
                                                                <form action="{{ url('harga-jual-satuan/'.$data_satuan->id.'/delete') }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method" value="put">
                                                                    <a href="{{ url('harga-jual-satuan/'.$data_satuan->id.'/edit') }}" class="btn btn-sm btn-warning">ubah</a>
                                                                    {{--<button type="submit" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')" class="btn btn-sm btn-danger">hapus</button>--}}
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>


                                </div>
                                <div class="col-md-12">
                                    <h4 style="font-weight: bold">Daftar Harga Barang Berdsarkan Jumlah</h4>
                                @if(!empty($data_barang))
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Nama Barang</td>
                                                <td>Harga HPP</td>
                                                <td>Harga Jumlah Maks</td>
                                                <td>Harga Jual</td>
                                                <td>Aksi</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($no=1)
                                            @foreach($data_barang as $data_barang_jumlah)
                                                @if(!empty($data_barang_jumlah->linkToHargaBaseOnJumlah))
                                                    @foreach($data_barang_jumlah->linkToHargaBaseOnJumlah as $data_bJumlah)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $data_bJumlah->linkToBarang->nm_barang }}</td>
                                                            <td>{{ $data_bJumlah->linkToBarang->hpp }}</td>
                                                            <td>{{ $data_bJumlah->jumlah_maks_brg }}</td>
                                                            <td>{{ $data_bJumlah->harga_jual }}</td>
                                                            <td>
                                                                <form action="{{ url('harga-jual-baseon-jumlah/'.$data_bJumlah->id.'/delete') }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method" value="put">
                                                                    <a href="{{ url('harga_jual_base_on_jumlah/'.$data_bJumlah->id) }}" onclick="ubah_barang_jumlah('{{ $data->id }}')" class="btn btn-sm btn-warning">ubah</a>
                                                                    {{--<button type="submit" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')" class="btn btn-sm btn-danger">hapus</button>--}}
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
                           <a href="{{ url('atur-konversi/create') }}" class="btn btn-flat btn-primary">Tambah Konversi</a>
                           <a href="{{ url('atur-konversi/history') }}" class="btn btn-flat btn-warning pull-right">History</a>
                            <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Barang Asal</td>
                                        <td>Satuan Asal</td>
                                        <td>Barang</td>
                                        <td>Barang Tujuan</td>
                                        <td>Satuan Tujuan</td>
                                        <td>Jumlah Konversi</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                               <tbody>
                               @php($i=1)
                               @foreach($konvesi_barang as $data_barang_konversi)
                                       <tr>
                                           <td>{{ $i++ }}</td>
                                           <td>{{ $data_barang_konversi->linkToBarangAsal->nm_barang }}</td>
                                           <td>{{ $data_barang_konversi->linkToBarangAsal->linkToSatuan->satuan_brg }}</td>
                                           <td>{{ $data_barang_konversi->linkToBarangAsal->stok_akhir }}</td>
                                           <td>{{ $data_barang_konversi->linkToBarangTujuan->nm_barang }}</td>
                                           <td>{{ $data_barang_konversi->linkToBarangTujuan->linkToSatuan->satuan_brg }}</td>
                                           <td>{{ $data_barang_konversi->jumlah_konversi_satuan }}</td>
                                           <td>
                                               <form action="{{ url('atur-konversi/'.$data_barang_konversi->id.'/delete') }}" method="post">
                                                    {{ csrf_field() }}
                                                   <input type="hidden" name="_method" value="put">
                                                   <a href="{{ url('atur-konversi/'.$data_barang_konversi->id.'/edit') }}" class="btn btn-xs btn-warning">ubah</a>
                                                   <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini .. ?')">hapus</button>
                                                   <a href="{{ url('atur-konversi/'.$data_barang_konversi->id) }}" class="btn btn-xs btn-primary" onclick="return confirm('Apakah anda akan mengkonversi barang ini..?')">Konversi</a>
                                               </form>
                                           </td>
                                       </tr>
                               @endforeach
                               </tbody>
                           </table>
                        </div>
                        <div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
                            <div class="row">
                               <div class="col-md-12">
                                   <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                       <thead>
                                       <tr>
                                           <td>No</td>
                                           <td>Tanggal Konversi</td>
                                           <td>Nama Barang Asal</td>
                                           <td>Satuan Barang Asal</td>
                                           <td>Nama Barang Tujuan</td>
                                           <td>Satuan Barang Tujuan</td>
                                           <td>Jumlah Konversi</td>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @php($i=1)
                                       @foreach($history_konversi_barang as $data_barang_konvesi)
                                           <tr>
                                               <td>{{ $i++ }}</td>
                                               <td>{{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->nm_barang }}</td>
                                               <td>{{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->linkToSatuan->satuan_brg }}</td>
                                               <td>{{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->stok_akhir }}</td>
                                               <td>{{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangTujuan->nm_barang }}</td>
                                               <td>{{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangTujuan->linkToSatuan->satuan_brg }}</td>
                                               <td>{{ $data_barang_konvesi->jum_brg_dikonversi }}</td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                            </div>
                        </div>
                        <div class="tab-pane @if(Session::get('tab5') == 'tab5') active @else '' @endif" id="tab_5">
                            <div class="row">
                                <form action="{{ url('transfer_barang') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Form Transfer Data Barang dari Perusahaan</label><br>
                                            <select class="form-control select2" name="p_awal" style="width: 100%" required>
                                                @if(!empty($data_perusahaan))
                                                    @foreach($data_perusahaan as $data)
                                                        <option value="{{ $data->id }}"  @if($data->id != Session::get('id_perusahaan_karyawan')) disabled="disabled" @endif>{{ $data->nm_usaha }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ke Perusahaan</label><br>
                                            <select class="form-control select2" name="p_tujuan" style="width: 100%" required>
                                                @if(!empty($data_perusahaan))
                                                    {{--<option>Pilih Perusahaan Tujuan</option>--}}
                                                    @foreach($data_perusahaan as $data)
                                                        <option value="{{ $data->id }}" @if($data->id == Session::get('id_perusahaan_karyawan')) disabled="disabled" @endif>{{ $data->nm_usaha }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Proses</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane @if(Session::get('tab6') == 'tab6') active @else '' @endif" id="tab_6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Event Promo <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default"> Buat Event </a> </h3>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Promo</td>
                                            <td>Mulai</td>
                                            <td>Selesai</td>
                                            <td>Syarat</td>
                                            <td>Fasilitas</td>
                                            <td>Aksi</td>
                                        </tr>
                                        </thead>
                                        <tbody>

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
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Form Promo</h4>
                            </div>
                            <form action="#" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Promo</label>
                                                <input type="text" class="form-control" name="nm_promo" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Promo</label>
                                                <select name="jenis_promo" class="form-control">
                                                    <option>Promo 1</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Dibuat</label>
                                                <input type="date" class="form-control" name="tgl_awal_promo" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Berlaku s/d</label>
                                                <input type="date" class="form-control" name="tgl_akhir_promo" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Syarat</label>
                                                <textarea class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Fasilitas Promo</label>
                                                <textarea class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
        </div>
    </section>
    <!-- /.content -->


    <!-- /.modal -->

</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.arsip.jenis_arsip.modal.JS')

@stop