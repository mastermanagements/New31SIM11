@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profil
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if(!empty($data_karyawan->pas_foto))
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('filePFoto/'.$data_karyawan->pas_foto) }}" alt="User profile picture">
                        @else
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('image_superadmin_ukm/default.png') }}" alt="User profile picture">
                        @endif
                        <h3 class="profile-username text-center">{{ $data_karyawan->nama_ky }}</h3>

                        <p class="text-muted text-center">{{ $data_karyawan->nik }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Tempat/Tanggal Lahir</b> <a class="pull-right"> {{ $data_karyawan->tmp_lahir.', '.date('d-M-Y', strtotime($data_karyawan->tgl_lahir)) }} </a>
                            </li>
                            <li class="list-group-item">
                                <b>Jenis Kelamin</b> <a class="pull-right">
                                    @if($data_karyawan->jenis_kel == 0)
                                        Pria
                                    @else
                                        Wanita
                                    @endif
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Agama</b> <a class="pull-right">
                                    {{ $data_karyawan->agama }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Gol. Darah</b> <a class="pull-right">
                                    @if($data_karyawan->gol_darah=='-')
                                        -
                                    @elseif($data_karyawan->gol_darah=='A')
                                        A
                                    @elseif($data_karyawan->gol_darah=='B')
                                        B
                                    @elseif($data_karyawan->gol_darah=='O')
                                        O
                                    @elseif($data_karyawan->gol_darah=='AB')
                                        AB
                                    @endif
                                </a>
                            </li><li class="list-group-item">
                                <b>No. KTP</b> <a class="pull-right">
                                    {{ $data_karyawan->no_ktp }}
                                </a>
                            </li>
                        </ul>
                        <p class="text-muted text-center">Data Bank</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Nama Bank</b> <a class="pull-right">
                                        {{ $data_karyawan->nm_bank }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>No. Rek</b> <a class="pull-right">
                                        {{ $data_karyawan->no_rek }}
                                    </a>
                                </li>
                        </ul>
                        <p class="text-muted text-center">Data Perusahaan</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Tanggal Masuk</b> <a class="pull-right">
                                        {{ date('d-M-Y', strtotime($data_karyawan->tgl_masuk)) }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status Kerja</b> <a class="pull-right">
                                        @if($data_karyawan->status_kerja == '0')
                                            Aktif
                                        @else
                                            Tidak aktif
                                        @endif
                                    </a>
                                </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tentang Saya</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Pendidikan </strong>

                        <p class="text-muted">
                            @if(empty($data_karyawan->pend_akhir))
                                data pendidikan anda masih kosong <button id="buttonEditPendidikan" class="btn btn-xs btn-primary pull-right"><i class="fa fa-edit"></i></button>
                            @else
                            <p><button id="buttonEditPendidikan" class="btn btn-xs btn-primary pull-right"><i class="fa fa-edit"></i></button></p>
                              Pendidikan Terakhir:  {{ $data_karyawan->pend_akhir  }}<br>
                              Program Studi:  {{ $data_karyawan->program_studi }} <br>
                              Perguruan Tinggi  {{ $data_karyawan->pt }} <br>
                            @endif
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>

                        <p class="text-muted">
                            @if(empty($data_karyawan->getAlamatAsal))
                                Alamat asal masih kosong <button id="buttonEditAlamat" class="btn btn-xs btn-primary pull-right"><i class="fa fa-edit"></i></button>
                            @else
                                <p> <button id="buttonEditAlamat" class="btn btn-xs btn-primary pull-right"><i class="fa fa-edit"></i></button></p>

                                Alamat Asal:  {{ $data_karyawan->getAlamatAsal->alamat_asal }} <br>
                                Kabupaten :{{ $data_karyawan->getAlamatAsal->getKabupaten->nama_kabupaten }}
                                Provinsi :{{ $data_karyawan->getAlamatAsal->getProvinsi->nama_provinsi }}
                            @endif
                            <br>
                            @if(empty($data_karyawan->getAlamatSek))
                                Alamat sekarang masih kosong  <button id="buttonEditAlamatSek" class="btn btn-xs btn-primary pull-right"><i class="fa fa-edit"></i></button>
                            @else
                                <p> <button id="buttonEditAlamatSek" class="btn btn-xs btn-primary pull-right"><i class="fa fa-edit"></i></button></p>
                                Alamat Sekarang:  {{ $data_karyawan->getAlamatSek->alamat_sek}} <br>
                                Kabupaten :{{ $data_karyawan->getAlamatSek->getKabupaten->nama_kabupaten }}
                                Provinsi :{{ $data_karyawan->getAlamatSek->getProvinsi->nama_provinsi }}
                            @endif
                        </p>

                        <hr>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@include('user.karyawan.section.Profil.include.modal_alamat')
@include('user.karyawan.section.Profil.include.modal_alamat_sek')
@include('user.karyawan.section.Profil.include.modal_pendidikan')
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    @include('user.karyawan.section.Profil.include.JS')
@stop

