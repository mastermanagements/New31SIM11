@extends('user.administrasi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proposal
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Proposal</a></li>
                        <li class="pull-right"><a href="#tab_2" data-toggle="tab"><i class="fa fa-reorder"></i> Jenis Proposal</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-proposal') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Proposal </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-klien') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="nm_klien" class="form-control" placeholder="cari berdasarkan judul proposal" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_proposal))
                                    <h4>Anda belum menambahkan proposal</h4>
                                @else
                                    @foreach($data_proposal as $value)
                                        <div class="col-md-3">
                                            <div class="box box-warning box-solid">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title" title="{{ $value->judul_prop }}">{{ str_limit($value->judul_prop,10,"...") }}</h3>

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
                                                   <div class="col-md-12">
                                                       Tanggal Proposal: {{ date('d-m-Y', strtotime($value->tgl_prop)) }}
                                                   </div>
                                                   <div class="col-md-12">
                                                       Ditujukan : {{ $value->ditujukan }}
                                                   </div>
                                                    <div class="col-md-12">
                                                        @if(empty($value->cover_prop))
                                                            <a href="{{ asset('coverDirectori/default.png') }}"> <img src="{{ asset('coverDirectori/default.png') }}" style="width: 200px; height: 200px;"> </a>
                                                            <button class="btn btn-primary"  style="margin-left: 5px" onclick="uploadCoverProposal('{{ $value->id }}')"><i class="fa fa-upload"></i> Unggah sampul proposal</button>
                                                        <p></p>
                                                            <button class="btn btn-primary" onclick="uploadDocProposal('{{ $value->id }}')"><i class="fa fa-upload"></i> Unggah dokumen proposal</button>
                                                        @else
                                                            <a href="{{ asset('coverDirectori/'.$value->cover_prop) }}"><img src="{{ asset('coverDirectori/'.$value->cover_prop) }}" style="width: 200px; height: 200px;"></a>
                                                            <button class="btn btn-primary"><i class="fa fa-upload"></i> Ganti sampul proposal</button>
                                                        @endif
                                                   </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                    @endforeach
                                    {{ $data_proposal->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-jenis-proposal"><i class="fa fa-plus"></i> Tambah jenis proposal</button>
                            <p></p>
                            <table id="example4" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Proposal</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
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

@include('user.administrasi.section.proposal.jenis_proposal.modal.modal_jenis_proposal')
@include('user.administrasi.section.proposal.Modal.modal_upload_file_cover_proposal')

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.proposal.jenis_proposal.modal.JS')
    @include('user.administrasi.section.proposal.Modal.JS')
@stop