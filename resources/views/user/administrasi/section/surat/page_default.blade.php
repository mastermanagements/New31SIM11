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
            Surat
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Surat Masuk</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Surat Keluar</a></li>
                        <li class="pull-right"><a href="#tab_3" data-toggle="tab">Jenis Surat</a></li>
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
                                @foreach($surat_masuk as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->tgl_surat_masuk)) }}</td>
                                        <td>
                                            {{ $value->hal }}
                                        </td>
                                        <td>
                                            {{ $value->dari }}
                                        </td>
                                        <td>
                                            {{ $value->getJabatan->nm_jabatan }}
                                        </td>
                                       <td>
                                            <form action="{{ url('hapus-surat-masuk/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-surat-masuk/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus surat masuk ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                                <a href="{{ url('fileSuratMasuk/'. $value->file_surat) }}" class="btn btn-primary" title="Lihar Surat"><i class="fa fa-file-picture-o"></i></a>
                                            </form>
                                        </td>
                                        </tr>
                                       @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <a href="{{ url('tambah-surat-keluar') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah surat keluar </a>
                            <p></p>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Surat</th>
                                    <th>No Surat</th>
									<th>Perihal</th>
									<th>Ditujukan Kepada</th>
                                    <th>Status Surat</th>
									<th>Tanggal Dikirim</th>
                                    <th>Nama File </th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
								@php($a=1)
                                @foreach($surat_keluar as $value)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>{{ $value->getJenisSurat->jenis_surat_keluar }}</td>
                                        <td>{{ $value->no_surat_keluar }}</td>
										<td>{{ $value->hal }}</td>
										<td>{{ $value->ditujukan }}</td>
                                        <td>
                                            <a href="#" onclick="ubahStatusSurat('{{ $value->id }}')">
                                                @if($value->status_surat==0)
                                                <span class="badge bg-red">Belum Terkirim</span>
                                                @else
                                                    <span class="badge bg-green">Sudah Terkirim</span>
                                                @endif
                                            </a>
                                        </td>
										<td>{{ date('d-m-Y', strtotime($value->tgl_dikirim))}} </td>
                                        <td style="width: 5%;">
                                            @if(empty($value->scan_file))
                                                <button class="btn btn-primary" onclick="uploadSurat('{{ $value->id }}');"><i class="fa fa-upload"></i> file belum tersedia</button>
                                            @else
                                                <p >
                                                    <a href="{{ asset('fileSuratKeluar/'.$value->scan_file) }}"><img src="{{ asset('fileSuratKeluar/'.$value->scan_file) }}" style="width: 20%"></a>
                                                </p>
                                                <button class="btn btn-primary" onclick="uploadSurat('{{ $value->id }}');"><i class="fa fa-upload"></i> Ganti file surat keluar</button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('hapus-surat-keluar/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-surat-keluar/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus surat masuk ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-jenis-surat"><i class="fa fa-plus"></i> Tambah jenis surat</button>
                            <p></p>
                            <table id="example4" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Surat</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i2=1)

                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@include('user.administrasi.section.surat.modal.modal_upload_file_surat_keluar')
@include('user.administrasi.section.surat.jenis_surat.modal.modal_jenis_surat')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.surat.jenis_surat.modal.JS')
    @include('user.administrasi.section.surat.modal.JS')
@stop