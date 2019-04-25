@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    {{--<link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">--}}

    {{--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">--}}

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Jasa
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Jasa </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-jasa') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Jasa </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-jasa') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="nm_jasa" class="form-control" placeholder="cari berdasarkan Nama Jasa" required>
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
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan Jasa </h4></div>
                                @else
                                    @foreach($data_jasa as $value)
                                        <div class="col-md-12">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>

                                                <div class="box-tools pull-right">
                                                    <form action="{{ url('delete-jasa/'.$value->id) }}" method="post">
                                                        <a href="{{ url('ubah-jasa/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah jasa"><i class="fa fa-pencil"></i>
                                                        </a>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data jasa ini ... ?')" class="btn btn-box-tool" title="hapus proposal"><i class="fa fa-eraser"></i>
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
                                                        <h3 style="color: #0b93d5; margin-top: 0px"><u>{{ $value->nm_jasa }}</u></h3>
                                                        <div class="row">
                                                            <div class="col-md-3">

                                                            <h4 >Rincian Jasa :</h4>
                                                            <p>Harga Jasa :Rp. {{ $value->harga_jasa }}</p>
                                                            <p>
                                                                <b>Kategori</b>
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
                                                                <p>{!!  $value->rincian_jasa  !!}</p>
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
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    {{--<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>--}}
    {{--@include('user.administrasi.section.proposal.jenis_proposal.modal.JS')--}}
    @include('user.administrasi.section.arsip.jenis_arsip.modal.JS')
@stop