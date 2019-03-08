@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @section('title','Title')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
       <div class="row">
            @if(!empty($menu)=='edit')
               @include('user.superadmin_ukm.master.section.pengaturan_awal.include.section_edit')
            @else
                @include('user.superadmin_ukm.master.section.pengaturan_awal.include.section_profil')
            @endif
            <div class="col-md-9">
               <div class="nav-tabs-custom">
                   <ul class="nav nav-tabs">
                       <li @if($content_menu=="profil") class="active" @endif><a href="{{ url('profil-perusahaan') }}">Profil Usaha</a></li>
                       <li @if($content_menu=="visi") class="active" @endif><a href="{{ url('visi') }}" >Visi</a></li>
                       <li @if($content_menu=="misi") class="active" @endif><a href="{{ url('misi') }}">Misi</a></li>
                       <li @if($content_menu=="akta") class="active" @endif><a href="{{ url('akta') }}" >Akta</a></li>
                       <li  @if($content_menu=="isi_usaha") class="active" @endif><a href="{{ url('izin-usaha') }}" >Izin Usaha</a></li>
                       <li  @if($content_menu=="jabatan") class="active" @endif><a href="{{ url('jabatan') }}" >Jabatan</a></li>
                   </ul>
                   <div class="tab-content">
                       <div class="active tab-pane"
                            @if($content_menu=="profil")
                            id="profil"
                            @elseif($content_menu=="visi")
                            id="visi"
                            @elseif($content_menu=="misi")
                            id="misi"
                            @elseif($content_menu=="akta")
                            id="akta"
                            @elseif($content_menu=="isi_usaha")
                            id="isi_usaha"
                            @elseif($content_menu=="jabatan")
                            id="jabatan"
                            @endif
                       >
                           @if($content_menu=="profil")
                               @include('user.superadmin_ukm.master.section.profil_perusahaan.include.profil_content')
                           @elseif($content_menu=="visi")
                               @include('user.superadmin_ukm.master.section.visi_perusahaan.include.visi_content')
                           @elseif($content_menu=="misi")
                               @include('user.superadmin_ukm.master.section.misi_perusahaan.include.misi_content')
                           @elseif($content_menu=="akta")
                               @include('user.superadmin_ukm.master.section.akta_perusahaan.include.akta_content')
                           @elseif($content_menu=="isi_usaha")
                               @include('user.superadmin_ukm.master.section.isin_usaha_perusahaan.include.isin_content')
                           @elseif($content_menu=="jabatan")
                               @include('user.superadmin_ukm.master.section.profil_perusahaan.include.profil_content')
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