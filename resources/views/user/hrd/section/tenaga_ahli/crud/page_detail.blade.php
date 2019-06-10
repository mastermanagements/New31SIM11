@extends('user.hrd.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Daftar Sertifikasi
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
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('filePFoto/'. $data_profil_karyawan->pas_foto) }}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $data_profil_karyawan->nama_ky }}</h3>

                            <p class="text-muted text-center">NIK: {{ $data_profil_karyawan->nik }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <strong><i class="fa fa-book margin-r-5"></i> Pendidikan
                                    </strong>

                                    Pendidikan Terakhir:  {{ $data_profil_karyawan->pend_akhir  }}<br>
                                    Program Studi:  {{ $data_profil_karyawan->program_studi }} <br>
                                    Perguruan Tinggi  {{ $data_profil_karyawan->pt }} <br>
                                </li>
                                <li class="list-group-item">
                                    @if(empty($data_profil_karyawan->getAlamatAsal))
                                     @else
                                        <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat
                                        </strong>

                                        Alamat Asal:  {{ $data_profil_karyawan->getAlamatAsal->alamat_asal }} <br>
                                        Kabupaten :{{ $data_profil_karyawan->getAlamatAsal->getKabupaten->nama_kabupaten }}
                                        Provinsi :{{ $data_profil_karyawan->getAlamatAsal->getProvinsi->nama_provinsi }}

                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <strong><i class="fa fa-envelope margin-r-5"></i> Email
                                    </strong>
                                    <p></p>
                                    @if(empty($data_profil_karyawan->getAlamatEmailKy))
                                        <p class="text-muted">
                                            email anda belum dimasukan  <button data-toggle="modal" data-target="#modal-tambah-email" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button>
                                        </p>

                                    @else
                                        @foreach($data_profil_karyawan->getAlamatEmailKy as $value)
                                            <form action="{{ url('hapus-email-ky/'. $value->id) }}" method="post">
                                                <p class="text-muted">
                                                    <input type="hidden" name="_method" value="put">
                                                    {{ csrf_field() }}
                                                    {{ $value->nm_email }}
                                                </p>
                                            </form>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <div class="col-md-8">
                    <div class="box box-primary ">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Sertifikasi</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ url('tambah-karyawan') }}" class="btn btn-box-tool" ><i class="fa fa-user-plus"></i>
                                </a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet
                                        Explorer 4.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td> 4</td>
                                    <td>X</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@stop