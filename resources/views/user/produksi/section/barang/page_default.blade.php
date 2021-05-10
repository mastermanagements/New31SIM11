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
                        <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Barang Jadi </a></li>
                        <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Barang Mentah </a></li>
                        <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Barang Dalam Proses</a></li>
                        <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Harga Barang </a></li>
                        <li class="@if(Session::get('tab5') == 'tab5') active @else '' @endif"><a href="#tab_5" data-toggle="tab"><i class="fa fa-book"></i> Konversi Satuan </a></li>
                        <li class="@if(Session::get('tab6') == 'tab6') active @else '' @endif"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i> Daftar Konversi Barang</a></li>
                        <li class="@if(Session::get('tab7') == 'tab4') active @else '' @endif"><a href="#tab_7" data-toggle="tab"><i class="fa fa-book"></i> Transfer Data Barang </a></li>

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
                                                <h3 class="box-title">Tabel Barang Jadi</h3>
                                                <div class="box-tools pull-right">
                                                    <a href="{{ url('import-barang') }}"  class="btn btn-primary" data-toggle="modal" data-target="#modal-import"> Import Barang </a>
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
                                                                <th>Kode</th>
                                                                <th>Nama Barang</th>
                                                                <th>Satuan</th>
                                                                <th>Kategori</th>
                                                                <th>Spesifikasi</th>
                                                                <th>Merk</th>
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
                                                                @if($data->jenis_barang =='0')
                                                                    <tr>
                                                                        <td>{{ $no++ }}</td>
                                                                        <td>{{ $data->kd_barang }}</td>
                                                                        <td>{{ $data->nm_barang }}</td>
                                                                        <td>{{ $data->linkToSatuan->satuan }}</td>
                                                                        <td>{{ $data->getkategori->nm_kategori_p }}</td>
                                                                        <td>{{ $data->spec_barang }}</td>
                                                                        <td>{{ $data->merk_barang }}</td>
                                                                        <td>{!! substr($data->desc_barang,0,100) !!}</td>
                                                                        <td>{{ $data->no_rak }}</td>
                                                                        <td>{{ $data->stok_minimum }}</td>
                                                                        <td>{{ rupiahView($data->hpp) }}</td>
                                                                        <td>
                                                                                @if($data->metode_jual == '0')
                                                                                   <a href="#" onclick='window.location.href="{{ url('harga-jual-satuan/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> Satu harga</a>
                                                                                @else
                                                                                    <a href="#" onclick='window.location.href="{{ url('harga-jual-baseon-jumlah/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> Jumlah Beli</a>
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
                                                                  @endif
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
                        <!--tab-pane-1-->

                    <!--tab-pane-2-->
                      <div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
                        <div class="row">
                            @if(empty($data_barang))
                                <div class="col-md-12"> <h4 align="center">Anda belum menambahkan Barang </h4></div>
                            @else
                                <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Tabel Barang Mentah</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Kode</th>
                                                            <th>Nama Barang</th>
                                                            <th>Satuan</th>
                                                            <th>Kategori</th>
                                                            <th>Spesifikasi</th>
                                                            <th>Merk</th>
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
                                                            @if($data->jenis_barang =='1')
                                                                <tr>
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>{{ $data->kd_barang }}</td>
                                                                    <td>{{ $data->nm_barang }}</td>
                                                                    <td>{{ $data->linkToSatuan->satuan }}</td>
                                                                    <td>{{ $data->getkategori->nm_kategori_p }}</td>
                                                                    <td>{{ $data->spec_barang }}</td>
                                                                    <td>{{ $data->merk_barang }}</td>
                                                                    <td>{!! substr($data->desc_barang,0,100) !!}</td>
                                                                    <td>{{ $data->no_rak }}</td>
                                                                    <td>{{ $data->stok_minimum }}</td>
                                                                    <td>{{ rupiahView($data->hpp) }}</td>
                                                                    <td>
                                                                            @if($data->metode_jual == '0')
                                                                               <a href="#" onclick='window.location.href="{{ url('harga-jual-satuan/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> Satu harga</a>
                                                                            @else
                                                                                <a href="#" onclick='window.location.href="{{ url('harga-jual-baseon-jumlah/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> Jumlah Beli</a>
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
                                                              @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            @endif
                        </div>
                      </div>
                     <!--tab-pane-2-->
                      <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
                        <div class="row">
                            @if(empty($data_barang))
                                <div class="col-md-12"> <h4 align="center">Anda belum menambahkan Barang </h4></div>
                            @else
                                <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Tabel Barang Dalam Proses</h3>                                          
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Kode</th>
                                                            <th>Nama Barang</th>
                                                            <th>Satuan</th>
                                                            <th>Kategori</th>
                                                            <th>Spesifikasi</th>
                                                            <th>Merk</th>
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
                                                            @if($data->jenis_barang =='2')
                                                                <tr>
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>{{ $data->kd_barang }}</td>
                                                                    <td>{{ $data->nm_barang }}</td>
                                                                    <td>{{ $data->linkToSatuan->satuan }}</td>
                                                                    <td>{{ $data->getkategori->nm_kategori_p }}</td>
                                                                    <td>{{ $data->spec_barang }}</td>
                                                                    <td>{{ $data->merk_barang }}</td>
                                                                    <td>{!! substr($data->desc_barang,0,100) !!}</td>
                                                                    <td>{{ $data->no_rak }}</td>
                                                                    <td>{{ $data->stok_minimum }}</td>
                                                                    <td>{{ rupiahView($data->hpp) }}</td>
                                                                    <td>
                                                                            @if($data->metode_jual == '0')
                                                                               <a href="#" onclick='window.location.href="{{ url('harga-jual-satuan/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> Satu harga</a>
                                                                            @else
                                                                                <a href="#" onclick='window.location.href="{{ url('harga-jual-baseon-jumlah/'. $data->id) }}"' type="button" class="btn btn-primary" title="ubah jasa"> Jumlah Beli</a>
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
                                                              @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            @endif
                        </div>
                      </div>
                     <!--tab-pane-3-->
                     <div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
                       <div class="row">
                           <div class="col-md-12">
                               <h4 style="font-weight: bold">Daftar Harga Barang Satuan</h4>
                                   <table id="example3" class="table table-bordered table-striped" style="width: 100%">
                                       <thead>
                                       <tr>
                                           <td>#</td>
                                           <td>Nama Barang</td>
                                           <td>Satuan</td>
                                           <td>HPP</td>
                                           <td>Harga Jual</td>
                                           <td>Keuntungan</td>
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
                                                       <td>{{ $data_satuan->linkToBarang->linkToSatuan->satuan }}</td>
                                                       <td>{{ rupiahView($data_satuan->linkToBarang->hpp) }}</td>
                                                       <td>{{ rupiahView($data_satuan->harga_jual) }}</td>
                                                       <td>{{ rupiahView($data_satuan->harga_jual - $data_satuan->linkToBarang->hpp)  }}</td>
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
                               <h4 style="font-weight: bold">Daftar Harga Barang Berdasarkan Jumlah Pembelian</h4>
                           @if(!empty($data_barang))
                                   <table id="example1" class="table table-bordered table-striped">
                                       <thead>
                                       <tr>
                                           <td>#</td>
                                           <td>Nama Barang</td>
                                           <td>Satuan</td>
                                           <td>Harga HPP</td>
                                           <td>Jumlah Maks Pembelian</td>
                                           <td>Harga Jual</td>
                                           <td>Keuntungan</td>
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
                                                       <td>{{ $data_bJumlah->linkToBarang->linkToSatuan->satuan }}</td>
                                                       <td>{{ rupiahView($data_bJumlah->linkToBarang->hpp) }}</td>
                                                       <td>{{ $data_bJumlah->jumlah_maks_brg }}</td>
                                                       <td>{{ rupiahView($data_bJumlah->harga_jual) }}</td>
                                                       <td>{{ rupiahView($data_bJumlah->harga_jual - $data_bJumlah->linkToBarang->hpp) }}</td>
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
                     <!--tab-4-->
                      <div class="tab-pane @if(Session::get('tab4') == 'tab5') active @else '' @endif" id="tab_5">
                          <div class="alert alert-warning alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              Konversi barang digunakan untuk memisahkan pembelian barang dengan satuan yang sama tapi dijual dengan satuan yang berbeda.
                              Misalnya: Pembelian Barang dari supplier berupa satuan Dos, kemudian dijual dalam satuan Dos dan Pcs. Setiap kali membuka
                              Barang dalam satuan Dos untuk dijual eceran, maka dilakukan konversi barang terlebih dahulu.
                          </div>
                           <a href="{{ url('atur-konversi/create') }}" class="btn btn-flat btn-primary">Tambah Konversi Satuan Barang</a>
                           <!--<a href="{{ url('atur-konversi/history') }}" class="btn btn-flat btn-warning pull-right">History</a>-->
                            <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Barang Asal</td>
                                        <td>Satuan Asal</td>
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
                                           <td>@if(!empty($data_barang_konversi)){{ $data_barang_konversi->linkToBarangAsal->nm_barang }}@endif</td>
                                           <td>@if(!empty($data_barang_konversi)){{ $data_barang_konversi->linkToBarangAsal->linkToSatuan->satuan }}@endif</td>

                                           <td>{{ $data_barang_konversi->linkToBarangTujuan->nm_barang }}</td>
                                           <td>{{ $data_barang_konversi->linkToBarangTujuan->linkToSatuan->satuan }}</td>
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
                        <!--tab-5-->
                        <div class="tab-pane @if(Session::get('tab6') == 'tab6') active @else '' @endif" id="tab_6">
                          <div class="row">
                             <div class="box-body">
                                 <table id="example2" class="table table-bordered table-striped" style="width: 100%">
                                     <thead>
                                     <tr>
                                         <td>No</td>
                                         <td>Tanggal Konversi</td>
                                         <td>Nama Barang Asal</td>
                                         <td>Satuan Barang Asal</td>
                                         <td>Nama Barang Tujuan</td>
                                         <td>Satuan Barang Tujuan</td>
                                         <td>Jumlah Konversi</td>
                                         <td>Petugas</td>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @php($i=1)
                                     @foreach($history_konversi_barang as $data_barang_konvesi)
                                         <tr>
                                             <td>{{ $i++ }}</td>
                                             <td>{{ tanggalView($data_barang_konvesi->tgl_konversi)}}</td>
                                             <td>@if(!empty($data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->nm_barang)){{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->nm_barang }}@endif</td>
                                             <td>@if(!empty($data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->linkToSatuan->satuan)){{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->linkToSatuan->satuan }}@endif</td>

                                             <td>@if(!empty($data_barang_konvesi->linkToKonversiBarang->linkToBarangTujuan->nm_barang)){{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangTujuan->nm_barang }}@endif</td>
                                             <td>@if(!empty($data_barang_konvesi->linkToKonversiBarang->linkToBarangTujuan->linkToSatuan->satuan)){{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangTujuan->linkToSatuan->satuan }}@endif</td>
                                             <td>{{ $data_barang_konvesi->jum_brg_dikonversi }} {{ $data_barang_konvesi->linkToKonversiBarang->linkToBarangAsal->linkToSatuan->satuan }}</td>
                                             <td>{{ $data_barang_konvesi->linkToKaryawan->nama_ky}} </td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
                             </div>
                          </div>
                        </div>
                        <div class="tab-pane @if(Session::get('tab7') == 'tab7') active @else '' @endif" id="tab_7">
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

                        </div>
                        <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

                <div class="modal fade" id="modal-import">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Form Import Barang</h4>
                            </div>
                            <form action="{{ url('import-barang') }}" method="post" id="form_promo" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File Barang</label>
                                                <input type="file" class="form-control" name="file" id="file" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
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
    <script>
        onPromoEdit =function(kode){
            $.ajax({
                'url':'{{ url('promo-crud') }}/'+kode+'/edit',
                'type':'get',
                success:function(result){
                    console.log(result.nama_promo);
                    $('#nama_promo').val(result.nama_promo);
                    $('[name="tgl_awal_promo"]').val(result.tgl_dibuat);
                    $('[name="tgl_akhir_promo"]').val(result.tgl_berlaku);
                    $('[name="syarat"]').text(result.syarat);
                    $('[name="fasilitas"]').val(result.fasilitas_promo);
                    $('[name="_method"]').val('put');
                    $('#form_promo').attr('action','{{ url('promo-crud') }}/'+result.id);
                    $('#modal-default').modal('show')
                }
            })
        }
    </script>
@stop
