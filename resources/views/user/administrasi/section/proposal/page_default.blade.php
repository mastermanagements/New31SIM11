@extends('user.administrasi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
                                                       Tanggal Proposal: <label style="font-weight: bold">{{ date('d-m-Y', strtotime($value->tgl_prop)) }}</label>
                                                   </div>
                                                   <div class="col-md-12">
                                                       Ditujukan : <label style="font-weight: bold">{{ $value->ditujukan }}</label>
                                                   </div>
                                                    {{--@if(!empty($value->file_prop))--}}
                                                    {{--<div class="col-md-12">--}}
                                                       {{--Nama dokumen proposal : <br> <label style="font-weight: bold">{{ $value->file_prop }}</label>--}}
                                                    {{--</div>--}}
                                                    {{--@endif--}}
                                                    <div class="col-md-12">
                                                        Status Proposal :
                                                        <input type="checkbox"  @if($value->status_prop==1) checked value="1" @else value="0" @endif data-toggle="toggle" data-size="mini" data-width="100" data-on="Sudah Dikirim" data-off="Belum Dikirm">
                                                        <p></p>
                                                    </div>

                                                    <div class="col-md-12">
                                                        @if(empty($value->cover_prop))
                                                            <a href="{{ asset('coverDirectori/default.png') }}"> <img src="{{ asset('coverDirectori/default.png') }}" style="width: 200px; height: 300px;"> </a>
                                                            <p></p>
                                                            <button class="btn btn-primary"  style="margin-left: 5px" onclick="uploadCoverProposal('{{ $value->id }}')"><i class="fa fa-upload"></i> Unggah sampul proposal</button>
                                                        @else
                                                            <a href="{{ asset('coverDirectori/'.$value->cover_prop) }}" ><img src="{{ asset('coverDirectori/'.$value->cover_prop) }}" style="width: 200px; height: 300px;"></a>
                                                            <p></p>
                                                            <button class="btn btn-primary" style="margin-left: 5px" onclick="uploadCoverProposal('{{ $value->id }}')"><i class="fa fa-upload"></i> Ganti sampul proposal</button>
                                                         @endif

                                                    </div>
                                                    <div class="col-md-12">
                                                        @if(empty($value->file_prop))
                                                            <p></p>
                                                            <button class="btn btn-primary" onclick="uploadDocProposal('{{ $value->id }}')"><i class="fa fa-upload"></i> Unggah dokumen proposal</button>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p></p>
                                                                    <a href="{{ asset('documentDirectori/'. $value->file_prop) }}" class="btn btn-danger" ><i class="fa fa-download"></i> Download</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p></p>
                                                                    <button class="btn btn-success" onclick="uploadDocProposal('{{ $value->id }}')"><i class="fa fa-upload"></i> Unggah</button>
                                                                </div>
                                                            </div>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    @include('user.administrasi.section.proposal.jenis_proposal.modal.JS')
    @include('user.administrasi.section.proposal.Modal.JS')
@stop