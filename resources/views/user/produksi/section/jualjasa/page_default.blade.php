@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Jual Jasa
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Jual Jasa </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-jual-jasa') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Jual Jasa </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-jual-jasa') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                                @if(empty($data_klien))
                                                    <option>Klien masih kosong</option>
                                                @else
                                                    @foreach($data_klien as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nm_klien }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_jasa))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan jual jasa </h4></div>
                                @else
                                    @foreach($data_jasa as $value)
                                        <div class="col-md-12">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                <div class="box-tools pull-right">
                                                    <form action="{{ url('delete-jual-jasa/'.$value->id) }}" method="post">
                                                        <a href="{{ url('ubah-jual-jasa/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah jasa"><i class="fa fa-pencil"></i>
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
                                                        <h3 style="color: #0b93d5; margin-top: 0px"><u>{{ $value->getKlien->nm_klien }}</u> </h3>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                            <h4 style="font-weight: bold">Rincian Permintaan Jasa :</h4>
                                                            <p>Perusahaan : {{ $value->getKlien->nm_perusahaan }}</p>
                                                            <p>Alamat : {{ $value->getKlien->alamat }}</p>
                                                            <p>No. Handphone : {{ $value->getKlien->hp}}</p>
                                                            <p>Harga Jasa :Rp. {{ $value->harga_jual }}</p>
                                                            </div>
                                                            <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                <p><h5 style="font-weight: bold">Detail Pesanan :</h5> {!!  $value->detail_pesanan  !!} </p>
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
                                    {{ $data_jasa->links() }}
                                @endif
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
    {{--<script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>--}}
    {{--@include('user.administrasi.section.arsip.jenis_arsip.modal.JS')--}}
@stop