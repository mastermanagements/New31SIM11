@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Detail Kompetitor {{ $data_kompetitor->nm_kompetitor }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-6">
               <!-- Profile Image -->
               <div class="box box-primary">
                   <div class="box-body box-profile">

                       <h3 class="profile-username text-center">
                           {{ $data_kompetitor->nm_kompetitor }}<br>
                       </h3>
                       <h5 class="pull-right"><a href="{{ url('Kompetitor')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                       <p class="text-muted text-left"><b>Profil Lengkap Perusahaan Kompetitor</b></p>
                       <ul class="list-group list-group-unbordered">

                           <li class="list-group-item">
                               <b>Nama Kompetitor </b> <a class="pull-right">{{ $data_kompetitor->nm_kompetitor }}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Badan Hukum </b> <a class="pull-right">{{ $data_kompetitor->badan_hukum }}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Bidang Usaha </b> <a class="pull-right">{{ $data_kompetitor->bidang_usaha }}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Alamat</b> <a class="pull-right">{{ $data_kompetitor->alamat }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Provinsi </b> <a class="pull-right">{{ $data_kompetitor->getProv->nama_provinsi }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Kabupaten </b> <a class="pull-right">{{ $data_kompetitor->getKab->nama_kabupaten }}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Contact Person</b> <a class="pull-right">{{ $data_kompetitor->cp }}</a>
                           </li>
						   <li class="list-group-item">
                               <b>No. Telp</b> <a class="pull-right">{{ $data_kompetitor->no_telp }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>No. Handphone</b> <a class="pull-right">{{ $data_kompetitor->hp }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>No. Whatshapp</b> <a class="pull-right">{{ $data_kompetitor->wa }}</a>
                           </li>
						    <li class="list-group-item">
                               <b>Telegram</b> <a class="pull-right">{{ $data_kompetitor->teleg }}</a>
                           </li>
						    <li class="list-group-item">
                               <b>Akun Fb</b> <a class="pull-right">{{ $data_kompetitor->akun_fb }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Fans Page</b> <a class="pull-right" style="color: green; font-weight: bold">{{ $data_kompetitor->fanspages }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Twitter</b> <a class="pull-right">{{ $data_kompetitor->twitter }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Instagram</b> <a class="pull-right">{{ $data_kompetitor->ig }}</a>
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
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
       $(function () {

       })
    </script>
@stop
