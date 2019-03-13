@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Pengaturan Menu
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Daftar Menu</h3>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif
                           <p style="color: green">Pilihlah menu pada daftar menu dibawah ini sesuai yang anda inginkan</p>

                              @foreach($menu as $key=> $menus)
                               <div class="form-group">
                                   <label>
                                       <input type="checkbox" class="minimal" id="menu_{{ $key }}"> {{ $menus->nm_menu }}
                                   </label>
                               </div>
                                  @if(!empty($submenu=$menus->getSubmenu))
                                        @foreach($submenu as $sKey => $sum_menu)
                                           <div class="form-group" style="padding-left: 5%;">
                                               <label>
                                                   <input type="checkbox" class="minimal" id="menu_sub_{{ $key }}"> {{ $sum_menu->nm_submenu }}
                                               </label>
                                           </div>
                                        @endforeach
                                  @endif
                               @endforeach

                       </div>
                       <div class="box-footer">

                       </div>
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

        window.onload = function() {
            CKEDITOR.replace( 'misi',{
                height: 600
            } );
        };

        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();

           //iCheck for checkbox and radio inputs
           $('input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           });

           //iCheck for checkbox and radio inputs
           $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           })

       })
    </script>
@stop