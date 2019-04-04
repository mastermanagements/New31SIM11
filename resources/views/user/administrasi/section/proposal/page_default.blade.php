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
                        <li class="pull-right"><a href="#tab_2" data-toggle="tab"><i class="fa fa-reorder"></i> Jenis Surat</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="{{ url('tambah-surat-masuk') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah surat masuk </a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Surat</th>
                                    <th>Perihal</th>
                                    <th>Dari</th>
                                    <th>Ditujukan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)

                                </tbody>
                            </table>
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
{{--@include('user.administrasi.section.surat.jenis_surat.modal.modal_alamat')--}}
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.proposal.jenis_proposal.modal.JS')
@stop