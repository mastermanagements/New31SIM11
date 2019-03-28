@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
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
                        <a href="#" onclick="alert('masih dibuat')" class="btn btn-primary btn-block"><b>Ubah</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>

            <div class="col-md-4">

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user margin-r-5"></i>Tentang Saya</h3>
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
                            <strong><i class="fa fa-envelope margin-r-5"></i> Email
                                <button data-toggle="modal" data-target="#modal-tambah-email" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button>
                            </strong>
                                <p></p>
                             @if(empty($data_karyawan->getAlamatEmailKy))
                            <p class="text-muted">
                                email anda belum dimasukan  <button data-toggle="modal" data-target="#modal-tambah-email" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button>
                            </p>

                            @else
                                @foreach($data_karyawan->getAlamatEmailKy as $value)
                                    <form action="{{ url('hapus-email-ky/'. $value->id) }}" method="post">
                                        <p class="text-muted">
                                            <input type="hidden" name="_method" value="put">
                                            {{ csrf_field() }}
                                            {{ $value->nm_email }} <button type="submit" class="btn btn-xs btn-primary pull-right" onclick="return confirm('Apakah anda serius akan manghapus email ini')"><i class="fa fa-trash"></i></button>
                                        </p>
                                    </form>
                                   @endforeach
                            @endif
                            <hr>
                                <strong><i class="fa fa-tty margin-r-5"></i> No.Handphone
                                    <button data-toggle="modal" data-target="#modal-tambah-handphone" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button>
                                </strong>
                                <p></p>
                                @if(empty($data_karyawan->getHpKy))
                                    <p class="text-muted">
                                        No.Handphone anda belum dimasukan  <button data-toggle="modal" data-target="#modal-tambah-no-handphone" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button>
                                    </p>
                                @else
                                    @foreach($data_karyawan->getHpKy as $value)
                                        <form action="{{ url('hapus-hp-ky/'. $value->id) }}" method="post">
                                            <p class="text-muted">
                                                <input type="hidden" name="_method" value="put">
                                                {{ csrf_field() }}
                                                {{ $value->hp }}
                                                <small>{{ $value->status_hp }}</small><button type="submit" class="btn btn-xs btn-primary pull-right" onclick="return confirm('Apakah anda serius akan manghapus no.handphone ini')"><i class="fa fa-trash"></i></button>
                                            </p>
                                        </form>
                                    @endforeach
                                @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-group margin-r-5"></i> Data Keluarga</h3>
                        <button id="btnEditDataKeluarga" data-toggle="modal" data-target="#modal-ubah-keluarga" class="btn btn-xs btn-primary pull-right"><i class="fa fa-pencil"></i></button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(empty($data_karyawan->getDataKeluarga))
                            <p class="text-muted" style="margin-bottom: 2px">
                                Data Keluarga anda belum dimasukan
                            </p>
                            <hr style="margin: 1px">
                        @else
                        <p class="text-muted" style="margin-bottom: 2px">
                            Nama Ayah : <br>
                            <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->nm_ayah }}</label>
                            @if($data_karyawan->getDataKeluarga->status_a==0)
                                <label class="pull-right" style="font-weight: bold; color: green;padding-left: 5px">Masih Hidup</label>
                            @else
                                <label class="pull-right" style="font-weight: bold; color: yellow; padding-left: 5px">Meninggal Dunia</label>
                            @endif
                        </p>
                        <hr style="margin: 1px">
                        <p class="text-muted" style="margin-bottom: 2px">
                            Nama Ibu : <br>
                            <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->nm_ibu }}</label>
                            @if($data_karyawan->getDataKeluarga->status_i==0)
                                <label class="pull-right" style="font-weight: bold; color: green;padding-left: 5px">Masih Hidup</label>
                            @else
                                <label class="pull-right" style="font-weight: bold; color: yellow; padding-left: 5px">Meninggal Dunia</label>
                            @endif
                        </p>
                        <hr style="margin: 1px">
                        <p class="text-muted" style="margin-bottom: 2px">
                            Jumlah Saudara : <br>
                            <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->jum_saudara }}</label>
                        </p>
                        <hr style="margin: 1px">
                        <p class="text-muted" style="margin-bottom: 2px">
                            Anak Ke : <br>
                            <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->anak_ke }}</label>
                        </p>
                        <hr style="margin: 1px">
                        <p class="text-muted" style="margin-bottom: 2px">
                            Kontak Person Darurat : <br>
                            <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->cp_darurat }}</label>
                        </p>
                        <hr style="margin: 1px">
                        <p class="text-muted" style="margin-bottom: 2px">
                                Telepon Darurat : <br>
                                <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->telp_darurat }}</label>
                        </p>
                        <hr style="margin: 1px">
                        @if(!empty($data_karyawan->getDataKeluarga->file_kk))
                                <p class="text-muted" style="margin-bottom: 2px">  <button data-toggle="modal" data-target="#modal-ubah-keluarga-file" class="btn btn-xs btn-primary pull-right"><i class="fa fa-upload"></i></button>
                                </p>
                                    File Scan KK : <br>
                                    <label style="font-weight: bold; padding-left: 5px">{{ $data_karyawan->getDataKeluarga->file_kk }}</label>
                                    <img src="{{ asset('FileScanKK/'. $data_karyawan->getDataKeluarga->file_kk) }}" style="width: 100%;height: 50%"/>
                                </p>
                                <hr style="margin: 1px">
                        @else
                            <p class="text-muted" style="margin-bottom: 2px">
                                Maaf, file scan kartu keluarga anda belum tersedia <button data-toggle="modal" data-target="#modal-ubah-keluarga-file" class="btn btn-xs btn-primary pull-right"><i class="fa fa-upload"></i></button>
                            </p>
                            <hr style="margin: 1px">
                        @endif
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>

@include('user.karyawan.section.Profil.include.modal_alamat')
@include('user.karyawan.section.Profil.include.modal_alamat_sek')
@include('user.karyawan.section.Profil.include.modal_pendidikan')
@include('user.karyawan.section.Profil.include.modal_keluarga')
@include('user.karyawan.section.Profil.include.modal_email')
@include('user.karyawan.section.Profil.include.modal_hp_ky')

@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

    @include('user.karyawan.section.Profil.include.JS')
@stop

