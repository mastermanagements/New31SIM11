@extends('user.administrasi.master_user')


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
          Arsip
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Arsip </a></li>
                        <li class="pull-right"><a href="#tab_2" data-toggle="tab"><i class="fa fa-reorder"></i> Jenis Arsip</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-arsip') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Arsip </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-proposal') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="judul_proposal" class="form-control" placeholder="cari berdasarkan ketarangan arsip" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_arsip))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan arsip</h4></div>
                                @else
                                    @foreach($data_arsip as $value)
                                        <div class="col-md-12">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>

                                                <div class="box-tools pull-right">
                                                    <form action="{{ url('delete-proposal/'.$value->id) }}" method="post">
                                                        <a href="{{ url('ubah-proposal/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah proposal"><i class="fa fa-pencil"></i>
                                                        </a>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini ... ?')" class="btn btn-box-tool" title="hapus proposal"><i class="fa fa-eraser"></i>
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
                                                    <div class="col-md-3">
                                                        @if(empty($value->file_arsip))
                                                             <img src="{{ asset('coverDirectori/default.png') }}" style="width: 200px; height: 300px;">
                                                        @else
                                                            <a href="{{ asset('fileArsip/'.$value->file_arsip) }}" ><img src="{{ asset('fileArsip/default.png') }}" style="width: 250px; height: 300px;"></a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <h4 style="font-weight: bold">Keterangan :</h4>
                                                            <p>{{ $value->ket }}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <form action="{{ url('hapus-arsip/'. $value->id) }}" method="post">
                                                                    <a href="{{ url('ubah-arsip/'. $value->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> ubah</a>
                                                                    <input type="hidden" name="_method" value="put">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini ... ?')"><i class="fa fa-eraser"></i> hapus</button>
                                                                </form>
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
                                @endif
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-jenis-arsip"><i class="fa fa-plus"></i> Tambah jenis arsip</button>
                            <p></p>
                            <table id="example4" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Proposal</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($jenis_arsip as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->jenis_arsip }}</td>
                                        <td>
                                             <button type="button" class="btn btn-warning" onclick="UbahJenisArsip({{ $value->id }})"><i class="fa fa-pencil"></i> Ubah</button>
                                             <button type="button" class="btn btn-danger" onclick="HapusJenisArsip({{ $value->id }})"><i class="fa fa-eraser"></i> Hapus</button>
                                        </td>
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

@include('user.administrasi.section.arsip.jenis_arsip.modal.modal_jenis_arsip')


@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    {{--<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>--}}
    {{--@include('user.administrasi.section.proposal.jenis_proposal.modal.JS')--}}
    @include('user.administrasi.section.arsip.jenis_arsip.modal.JS')
@stop