@extends('user.administrasi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Cuti
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-gear"></i> Pengaturan Cuti</a></li>
                        <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-list"></i> Daftar Cuti</a></li>
                        <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-list"></i> Permintaan Cuti</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <!-- THE CALENDAR -->
                            <div class="row">

                                <div class="col-md-12">
                                    <!-- Custom Tabs -->

                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    <div class="col-md-3" style="margin: 0">
                                                        <a href="{{ url('tambah-pengaturan-cuti') }}" class="btn btn-primary" style="width: 100%" ><i class="fa fa-plus"></i> Tambah Pengaturan Cuti </a>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <div class="row">
                                                    <div class="col-md-12" style="margin: 0">
                                                    <table id="example2" class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Jenis Proyek</th>
                                                            <th>Pengurangan Cuti</th>
                                                            <th>Akumulasi Cuti</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($i=1)
                                                        @foreach($pengaturan_Cuti as $value)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $value->nm_cuti }}</td>
                                                            <td>{{ $pengurangan_cuti[$value->pengurang_cuti] }}</td>
                                                            <td>{{ $akumulasi_cuti[$value->akumulasi_cuti] }}</td>

                                                            <td>
                                                            <form action="{{ url('hapus-pengaturan-cuti/'.$value->id) }}" method="post">
                                                            <a href="{{ url('ubah-pengaturan-cuti/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
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
                                                </div>
                                            </div>

                                    <!-- nav-tabs-custom -->
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab_2">
                            <a href="{{ url('tambah-cuti') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Cuti</a>
                            <p></p>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Karyawan</th>
                                    <th>Periode</th>
                                    <th>Nama Cuti</th>
                                    <th>Maksimal cuti</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_cuti as $value)
                                <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->karyawan->nama_ky }}</td>
                                <td>{{ $value->periode }}</td>
                                <td>{{ $value->pengaturan_cuti->nm_cuti }}</td>
                                <td>{{ $value->max_suci }}</td>

                                <td>
                                    <form action="{{ url('hapus-cuti/'.$value->id) }}" method="post">
                                    <a href="{{ url('ubah-cuti/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
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
                            <a href="{{ url('tambah-permintaan-cuti') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Permintaan Cuti</a>
                            <p></p>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Karyawan</th>
                                    <th>Jenis Izin</th>
                                    <th>Nama Cuti</th>
                                    <th>Lama Cuti</th>
                                    <th>Upprove</th>
                                    <th>Atasan</th>
                                    <th>Surat Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_request as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->tgl_req)) }}</td>
                                        <td>{{ $value->karyawan->nama_ky }}</td>
                                        <td>{{ $jenis_izin[$value->jenis_izin] }}</td>
                                        <td>@if(!empty($value->cuti->nm_cuti)) {{ $value->cuti->nm_cuti }} @else Izin/Sakit @endif</td>
                                        <td>{{ $value->lama_request }}</td>
                                        <td> {{ $upprove[$value->upprove] }} </td>
                                        <td> {{ $value->atasans->nama_ky }} </td>
                                        <td><a> Cooming Soon </a></td>

                                        <td>
                                            <form action="{{ url('hapus-permintaan-cuti/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-permintaan-cuti/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
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