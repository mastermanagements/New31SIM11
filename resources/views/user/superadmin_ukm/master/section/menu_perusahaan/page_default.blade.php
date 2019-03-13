@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengaturan Menu Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
       <div class="row">
            <div class="col-md-12">
               <div class="nav-tabs-custom">
                   <ul class="nav nav-tabs">
                       <li @if($content_menu=="karyawan") class="active" @endif><a href="{{ url('profil-perusahaan') }}">Daftar Usaha</a></li>
                   </ul>
                   <div class="tab-content">
                       <div class="active tab-pane"
                            @if($content_menu=="daftar-perusahaan")
                            id="profil"
                            @endif
                       >
                           @if($content_menu=="daftar-perusahaan")
                               @include('user.superadmin_ukm.master.section.menu_perusahaan.include.menu_perusahaan_content')
                           @endif
                       </div>
                       <!-- /.tab-pane -->
                   </div>
                   <!-- /.tab-content -->
               </div>
               <!-- /.nav-tabs-custom -->
           </div>
       </div>


    </section>
    <!-- /.content -->
</div>
@stop

@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2()
       })
    </script>
@stop