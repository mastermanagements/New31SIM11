@extends('user.administrasi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Jadwal Proyek
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Jadwal Proyek</a></li>
                        <li class="pull-right"><a href="#tab_2" data-toggle="tab"><i class="fa fa-list"></i> Task Proyek</a></li>
                        <li class="pull-right"><a href="#tab_3" data-toggle="tab"><i class="fa fa-list"></i> Tincian Tugas</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <!-- THE CALENDAR -->
                            <div class="row">
                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <p></p>

                                <div class="col-md-12">
                                    <!-- Custom Tabs -->

                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    <div class="col-md-3" style="margin: 0">
                                                        <a href="{{ url('tambah-jadwal-proyek') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Jadwal Proyek </a>
                                                    </div>
                                                    <div class="col-md-9" >
                                                        <form action="{{ url('cari-tim-proyek') }}" method="post" style="width: 100%">
                                                            <div class="input-group input-group-md" >
                                                                {{ csrf_field() }}
                                                                <select class="form-control select2" style="width: 100%;" name="id_spk" required>
                                                                    {{--@if(empty($spk))--}}
                                                                        {{--<option>Spk masih kosong</option>--}}
                                                                    {{--@else--}}
                                                                        {{--@foreach($spk as $value)--}}
                                                                            {{--<option value="{{ $value->id }}">{{ $value->nm_spk }}</option>--}}
                                                                        {{--@endforeach--}}
                                                                    {{--@endif--}}
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
                                                    @if(empty($data_jadwal))
                                                        <div class="col-md-12"> <h4 align="center">Anda belum menambahkan data jadwal proyek </h4></div>
                                                    @else
                                                        @foreach($data_jadwal as $value)
                                                            <div class="col-md-12">
                                                                <div class="box box-success box-solid">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <form action="{{ url('delete-proyek/'.$value->id) }}" method="post">
                                                                                <a href="{{ url('ubah-proyek/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah proyek"><i class="fa fa-pencil"></i>
                                                                                </a>
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="_method" value="put">
                                                                                <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="btn btn-box-tool" title="hapus proyek"><i class="fa fa-eraser"></i>
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
                                                                                <h3 style="color: #0b93d5; margin-top: 0px"><u>{{ $value->spk->getKlien->nm_klien }}</u> </h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <h4 style="font-weight: bold">Rincian Klien</h4>
                                                                                        <p>Perusahaan : {{ $value->spk->getKlien->nm_perusahaan }}</p>
                                                                                        <p>Alamat : {{ $value->spk->getKlien->alamat }}</p>
                                                                                        <p>No. Handphone : {{ $value->spk->getKlien->hp}}</p>
                                                                                        <p style="font-weight: bold">No. SPK : {{ $value->spk->no_spk }} </p>
                                                                                        <p>Nama SP K: {{ $value->spk->nm_spk }} </p>
                                                                                        <p>Jangka Waktu : {{ $value->jangka_waktu }} Hari</p>
                                                                                    </div>
                                                                                    <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                                        <p><h5 style="font-weight: bold">Tim Produksi :  <button class="btn btn-xs btn-primary pull-right btnAddTim" value="{{ $value->id }}"><i class="fa fa-plus"></i> Tambah Tim</button> </h5>
                                                                                        <table class="table table-striped example2">
                                                                                            <tbody><tr>
                                                                                                <th style="width: 10px">#</th>
                                                                                                <th>Nama Karyawan</th>
                                                                                                <th>Jabatan</th>
                                                                                                <th style="width: 40px">Aksi</th>
                                                                                            </tr>
                                                                                            @php($i=1)
                                                                                            @if(!empty($value->timProyek))
                                                                                                @foreach($value->timProyek as $value)
                                                                                                    <tr>
                                                                                                        <td>{{ $i++ }}</td>
                                                                                                        <td>{{ $value->karyawan->nama_ky }}</td>
                                                                                                        <td>
                                                                                                            {{ $value->jabatan_proyek }}
                                                                                                        </td>
                                                                                                        <td>

                                                                                                            <form action="{{ url('delete-tim-proyek/'.$value->id) }}" method="post">
                                                                                                                {{ csrf_field() }}
                                                                                                                <input type="hidden" name="_method" value="put">
                                                                                                                <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="badge bg-red" title="hapus tim proyek"><i class="fa fa-eraser"></i>
                                                                                                                </button>
                                                                                                            </form>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            @else
                                                                                                <tr>
                                                                                                    <td colspan="2">Tim Belum dimasukan</td>
                                                                                                </tr>
                                                                                            @endif
                                                                                            </tbody>
                                                                                        </table>
                                                                                        </p>
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
                                                        {{ $data_jadwal->links() }}
                                                    @endif
                                                </div>
                                            </div>


                                    <!-- nav-tabs-custom -->
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab_2">
                            <a href="{{ url('tambah-taskproyek') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Task Proyek</a>
                            <p></p>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tugas</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_taks_proyek as $value)
                                <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->nama_tugas }}</td>

                                <td>
                                    <form action="{{ url('hapus-taksproyek/'.$value->id) }}" method="post">
                                    <a href="{{ url('ubah-taksproyek/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus penjualan ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_3">
                            <a href="{{ url('tambah-rincian-tugas') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Rincian Tugas</a>
                            <p></p>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tugas Proyek</th>
                                    <th>Rincian Tugas</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_rincian_proyek as $value)
                                <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->tugasProyek->nama_tugas }}</td>
                                <td>{{ $value->rincian_tugas }}</td>
                                <td>
                                    <form action="{{ url('hapus-rincian-tugas/'.$value->id) }}" method="post">
                                    <a href="{{ url('ubah-rincian-tugas/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus penjualan ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
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

</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@stop