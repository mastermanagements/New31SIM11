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
                      <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Surat Masuk </a></li>
                      <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Surat Keluar</a></li>
                      <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Proposal </a></li>
                      <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Arsip </a></li>
					 
					  <!--right tab-->
					  <li class="pull-right"><a href="#jenis_arsip" data-toggle="tab"><i class="fa fa-reorder"></i> Jenis Arsip</a></li>
					  <li class="pull-right"><a href="#jenis_proposal" data-toggle="tab"><i class="fa fa-reorder"></i> Jenis Proposal</a></li>
					   <li class="pull-right"><a href="#jenis_surat" data-toggle="tab"><i class="fa fa-reorder"></i>&nbsp;Jenis Surat</a></li>
					   			   
					</ul>
                    <div class="tab-content">
                       <div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
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
                        <div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
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
                        <div class="tab-pane" id="jenis_surat">
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
						<div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
							 <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-proposal') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Proposal </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-proposal') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="judul_proposal" class="form-control" placeholder="cari berdasarkan judul proposal" required>
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
                                                        <input type="checkbox" name="status_proposal" onchange="ubahStatusProposal({{ $value->id }})" @if($value->status_prop==1) checked value="1" @else value="0" @endif data-toggle="toggle" data-size="mini" data-width="100" data-on="Sudah Dikirim" data-off="Belum Dikirm">
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
						<div class="tab-pane" id="jenis_proposal">
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
						<div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
							<div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-arsip') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Arsip </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-arsip') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="ket" class="form-control" placeholder="cari berdasarkan ketarangan arsip" required>
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
						<div class="tab-pane" id="jenis_arsip">
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
@include('user.administrasi.section.surat.modal.modal_upload_file_surat_keluar')
@include('user.administrasi.section.surat.jenis_surat.modal.modal_jenis_surat')
@include('user.administrasi.section.proposal.jenis_proposal.modal.modal_jenis_proposal')
@include('user.administrasi.section.proposal.Modal.modal_upload_file_cover_proposal')
@include('user.administrasi.section.arsip.jenis_arsip.modal.modal_jenis_arsip')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
	 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    @include('user.administrasi.section.surat.jenis_surat.modal.JS')
    @include('user.administrasi.section.surat.modal.JS')
    @include('user.administrasi.section.proposal.jenis_proposal.modal.JS')
    @include('user.administrasi.section.proposal.Modal.JS')
	@include('user.administrasi.section.arsip.jenis_arsip.modal.JS')
@stop
