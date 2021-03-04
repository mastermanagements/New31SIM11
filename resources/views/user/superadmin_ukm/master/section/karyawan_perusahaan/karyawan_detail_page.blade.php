@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Detail Karyawan {{ $data_karyawan->nama_ky }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-6">
               <!-- Profile Image -->
               <div class="box box-primary">
                   <div class="box-body box-profile">
                       <img class="profile-user-img img-responsive img-circle" src="
                            @if(empty($data_karyawan->pas_foto))
                       {{ asset('image_superadmin_ukm/default.png') }}
                       @else
                       {{ asset('filePFoto/'.$data_karyawan->pas_foto) }}
                       @endif
                               " alt="User profile picture">

                       <h3 class="profile-username text-center">
                           {{ $data_karyawan->nama_ky }}<br>
                           <small>{{ $data_karyawan->nik }} </small>
                       </h3>
                       <p class="text-muted text-center">Profil Karyawan</p>
                       <ul class="list-group list-group-unbordered">

                           <li class="list-group-item">
                               <b>Status Kerja</b> <a class="pull-right">
                                   @if($data_karyawan->status_kerja == 0)
                                       <p style="color: green; font-weight: bold;">Aktif</p>
                                   @else
                                       <p style="color: red; font-weight: bold;">Tidak Aktif</p>
                                   @endif
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>No. KTP</b> <a class="pull-right">{{ $data_karyawan->no_ktp }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Nama Karyawan </b> <a class="pull-right">{{ $data_karyawan->nama_ky }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Tanggal Lahir</b> <a class="pull-right">{{ date('d-m-Y', strtotime($data_karyawan->tgl_lahir)) }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Jenis Kelamin</b> <a class="pull-right">
                                   @if($data_karyawan->jenis_kel==0)
                                       Pria
                                   @else
                                        Wanita
                                   @endif
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>Agama</b> <a class="pull-right">
                                  @foreach($agama as $value)
                                      @if($data_karyawan->agama == $value)
                                          {{ $value }}
                                       @endif
                                  @endforeach
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>Golongan Darah</b> <a class="pull-right">
                                  @foreach($gol_darah as $value)
                                      @if($data_karyawan->gol_darah == $value)
                                          {{ $value }}
                                       @endif
                                  @endforeach
                               </a>
                           </li>
                       </ul>
                       <p class="text-muted text-center">Data Pendidikan</p>
                       <ul class="list-group list-group-unbordered">
                           <li class="list-group-item">
                               <b>Pendidikan Terakhir</b> <a class="pull-right">
                                   {{ $data_karyawan->pend_akhir }}
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>Program Studi</b> <a class="pull-right">
                                   {{ $data_karyawan->program_studi }}
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>Perguruan Tinggi</b> <a class="pull-right">
                                   {{ $data_karyawan->pt }}
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
                               <b>No Rekening</b> <a class="pull-right">
                                   {{ $data_karyawan->no_rek }}
                               </a>
                           </li>
                       </ul>
                       <p class="text-muted text-center">Data Kantor</p>
                       <ul class="list-group list-group-unbordered">
                           <li class="list-group-item">
                               <b>Tanggal Masuk Kantor</b> <a class="pull-right">
                                   {{ date('d-m-Y', strtotime($data_karyawan->tgl_masuk)) }}
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>File KTP</b> <a href="{{ asset('fileKtp/'.$data_karyawan->file_ktp ) }}" class="pull-right">
                                   {{ $data_karyawan->file_ktp }}
                               </a>
                           </li>
                           <li class="list-group-item">
                               <b>File Curriculum Vitae</b> <a href="{{ asset('fileCV/'.$data_karyawan->cu_vitae ) }}" class="pull-right">
                                   {{ $data_karyawan->cu_vitae }}
                               </a>
                           </li>
                       </ul>
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


@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>


        //Initialize Select2 Elements
       $(function () {

       })
    </script>
@stop
