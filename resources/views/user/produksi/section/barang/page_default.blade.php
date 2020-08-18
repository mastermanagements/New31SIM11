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
                        <li ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Koversi Satuan </a></li>
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
                                    @foreach($data_barang as $value)
                                        <div class="col-md-12">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                <div class="box-tools pull-right">
                                                    <form action="{{ url('delete-barang/'.$value->id) }}" method="post">
                                                        <a href="{{ url('ubah-barang/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah jasa"><i class="fa fa-pencil"></i>
                                                        </a>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="btn btn-box-tool" title="hapus proposal"><i class="fa fa-eraser"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3 style="color: #0b93d5; margin-top: 0px"><u>{{ $value->nm_barang }}</u> @if(!empty($value->expired_date) and $value->expired_date != '1970-01-01')<small> {{ date('d-m-Y', strtotime($value->expired_date)) }}</small>@endif</h3>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                            <h4 style="font-weight: bold">Rincian Barang :</h4>
                                                            <p>Harga Jasa :Rp. {{ $value->harga_jual }}</p>
                                                                <p> <b>Diskon :</b> <br>
                                                                <ul>{{ $value->diskon }}%</ul>
                                                                </p>
                                                            <p>
                                                                <b>Kategori :</b>
                                                                <ul>
                                                                     {{ $value->getkategori->nm_kategori_p }}
                                                                    @if(!empty($value->getsubkategori->nm_subkategori_produk))
                                                                        <i class="fa fa-level-down"></i>
                                                                    <ul>
                                                                       {{ $value->getsubkategori->nm_subkategori_produk }}
                                                                        @if(!empty($value->getsubsubkategori->nm_subsub_kategori_produk))
                                                                            <i class="fa fa-level-down"></i>
                                                                        <ul>
                                                                            {{ $value->getsubsubkategori->nm_subsub_kategori_produk }} <i class="fa fa-level-down"></i>
                                                                        </ul>
                                                                        @endif
                                                                    </ul>
                                                                    @endif
                                                                </ul>
                                                            </p>

                                                            </div>
                                                            <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                <p><h5 style="font-weight: bold">Spesifikasi :</h5> {!!  $value->spec_barang  !!} </p>
                                                                <p><h5 style="font-weight: bold">Deskripsi Barang :</h5> {!!  $value->desc_barang  !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    @endforeach
                                    {{ $data_barang->links() }}
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane " id="tab_2">
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