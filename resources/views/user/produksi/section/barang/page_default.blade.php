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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Barang </a></li>
                        <li ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Daftar Harga Barang </a></li>
                        <li ><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Koversi Satuan </a></li>
                        <li ><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Transfer Data Barang </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
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
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tabel Barang</h3>
                                                <div class="box-tools pull-right">

                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12">
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
                                                                                berdasarkan satu harga
                                                                            @else
                                                                                berdasarkan jumlah beli
                                                                            @endif
                                                                        </td>
                                                                        <th>
                                                                            <form action="{{ url('delete-barang/'.$data->id) }}" method="post">
                                                                                <a href="#" type="button" class="btn btn-primary" title="ubah jasa">Harga Jual</a>
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
                                                    <div class="col-md-12">
                                                        {{ $data_barang->links() }}
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
                        <div class="tab-pane active" id="tab_2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Harga Barang</h1>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab_3">
                           <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Barang</td>
                                        <td>Konversi</td>
                                    </tr>
                                </thead>
                               <tbody>
                               @php($i=1)
                               @foreach($data_barang as $data)
                                   <tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $data->nm_barang }}</td>
                                       <td><a href="{{ url('atur-konversi/'.$data->id) }}" class="btn btn-xs btn-danger">Atur Konversi</a> </td>
                                   </tr>
                               @endforeach
                               </tbody>
                           </table>
                        </div>
                        <div class="tab-pane active" id="tab_4">
                            <div class="row">
                                <h1>Transfer Data Barang</h1>
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
    @include('user.administrasi.section.arsip.jenis_arsip.modal.JS')
@stop