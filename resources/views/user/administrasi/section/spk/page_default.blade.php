@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SPK(Surat Perintah Kerja)
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar SPK</a></li>
                  </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-spk') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah SKP </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-spk') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="nm_spk" class="form-control" placeholder="cari berdasarkan nama spk" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_spk))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan SPK</h4></div>
                                @else
                                    @foreach($data_spk as $value)
                                        <div class="col-md-12">
                                            <div class="box box-success box-solid">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">{{ $value->no_spk }}-{{ $value->nm_spk }}</h3>

                                                    <div class="box-tools pull-right">
                                                        <form action="{{ url('hapus-spk/'.$value->id) }}" method="post">
                                                            <a href="{{ url('ubah-spk/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah proposal"><i class="fa fa-pencil"></i>
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
                                                        <div class="col-md-2">
                                                            @if(empty($value->file_kotrak))
                                                               <a href="#" onclick="uploadFileContrak('{{ $value->id }}')"><img src="{{ asset('coverDirectori/default.png') }}" style="width: 150px;height: 180px"></a>
                                                                <small style="color: red">*anda belum unggah file dokumen yang belum bertanda tangan, <label style="color: #0b93d5">Klik, Icon zip di atas</label></small>
                                                            @else
                                                                <a href="{{ asset('fileSpk/'.$value->file_kotrak) }}"><img src="{{ asset('fileArsip/default.png') }}" style="width: 150px;height: 180px"></a>
                                                                <small style="color: green">*Anda Sudah meng-unggah file Spk anda, <label style="color: #0b93d5">Klik <a href="#" onclick="uploadFileContrak('{{ $value->id }}')"><label style="color: red">upload ulang</label></a>, Icon zip di atas untuk unggah ulang file SPK anda</label></small>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if(empty($value->file_scan))
                                                                <a href="#"  onclick="uploadFilescan('{{ $value->id }}')"> <img src="{{ asset('coverDirectori/default.png') }}" style="width: 150px;height: 180px"></a>
                                                                <small style="color: red">*anda belum unggah file dokumen yang sudah bertanda tangan, <label style="color: #0b93d5">Klik, Icon zip di atas</label></small>
                                                            @else
                                                                <a href="{{ asset('fileScanSpk/'.$value->file_scan) }}"><img src="{{ asset('fileArsip/default.png') }}" style="width: 150px;height: 180px"></a>
                                                                <small style="color: green">*Anda Sudah meng-unggah file Scan Spk anda, <label style="color: #0b93d5">Klik <a href="#" onclick="uploadFilescan('{{ $value->id }}')"><label style="color: red">upload ulang</label></a>, Icon zip di atas untuk unggah ulang file scan SPK anda</label></small>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h4 style="font-weight: bold"> {{ $value->nm_spk }}</h4>
                                                            <h6 style="font-weight: bold">No. Spk: {{ $value->no_spk }}, Tanggal : {{ date('d M Y', strtotime($value->tgl_spk)) }}</h6>
                                                            <p>Nama Klien: {{ $value->getKlien->nm_klien }}</p>
                                                            <p>Alamat: {{ $value->alamat }}, Provinsi {{ $value->getProvinsi->nama_provinsi }}, Kabupaten {{ $value->getKabupaten->nama_kabupaten }}</p>
                                                            <p>Tanggal Mulai Kontrak : {{ date('d M Y', strtotime($value->tgl_mulai)) }}</p>
                                                            <p>Tanggal Selesai Kontrak : {{ date('d M Y', strtotime($value->tgl_selesai)) }}</p>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <form action="{{ url('Ba-Pemeriksaan') }}" method="get">
                                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                                        {{ csrf_field() }}
                                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Ba. Pemeriksaan </button>
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <form action="{{ url('BA-Kemajuan') }}" method="get">
                                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                                        {{ csrf_field() }}
                                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Ba. Kemajuan </button>
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
                                    {{ $data_spk->links() }}
                                @endif
                        </div>
                        <div class="tab-pane" id="tab_2">

                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@include('user.administrasi.section.spk.Modal.modal_upload_file_spk')
@stop

@section('plugins')
    @include('user.administrasi.section.spk.Modal.JS')
@stop
