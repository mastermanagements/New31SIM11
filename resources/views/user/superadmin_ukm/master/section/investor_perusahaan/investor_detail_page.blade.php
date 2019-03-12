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
           Halaman Detail Investor {{ $data_investor->nm_investor }}
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
                           {{ $data_investor->nm_investor }}<br>
                           <small>{{ $data_investor->no_ktp }} </small>
                       </h3>
                       <p class="text-muted text-center">Profil Lengkap Investor</p>
                       <ul class="list-group list-group-unbordered">

                           <li class="list-group-item">
                               <b>No. KTP</b> <a class="pull-right">{{ $data_investor->no_ktp }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Nama Investor </b> <a class="pull-right">{{ $data_investor->nm_investor }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Alamat </b> <a class="pull-right">{{ $data_investor->alamat}}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Provinsi </b> <a class="pull-right">{{ $data_investor->getUserProvinsi->nama_provinsi }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Kabupaten </b> <a class="pull-right">{{ $data_investor->getUserKabupaten->nama_kabupaten }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Kabupaten </b> <a class="pull-right">{{ $data_investor->getUserKabupaten->nama_kabupaten }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>No. Handphone</b> <a class="pull-right">{{ $data_investor->hp }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>No. Whatshapp</b> <a class="pull-right">{{ $data_investor->wa }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Jumlah Saham</b> <a class="pull-right" style="color: green; font-weight: bold">{{ $data_investor->jum_saham }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>File Scan Ktp Investor</b> <a href="{{ asset('ktpInvestor/'.$data_investor->file_ktp ) }}" class="pull-right">{{ $data_investor->file_ktp }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Nama Ahli Waris</b> <a class="pull-right">{{ $data_investor->nm_ahli_waris }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>No. Handphone Ahli Waris</b> <a class="pull-right">{{ $data_investor->no_hp_aw }}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Alamat Ahli Waris</b> <a class="pull-right">{{ $data_investor->alamat_aw }}</a>
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