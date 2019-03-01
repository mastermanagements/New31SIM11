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
                       <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                       <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                       <li><a href="#settings" data-toggle="tab">Settings</a></li>
                   </ul>
                   <div class="tab-content">
                       <div class="active tab-pane" id="activity">

                       </div>
                       <!-- /.tab-pane -->
                       <div class="tab-pane" id="timeline">

                       </div>
                       <!-- /.tab-pane -->

                       <div class="tab-pane" id="settings">

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