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
                       <h5 class="pull-right"><a href="{{ url('menu-perusahaan')}}"><font color="#1052EE"><font color="#1052EE">Kembali ke Halaman Utama</font></font></a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif
                           <h4><p><font color="#0E50EC">Pilihlah menu dan submenu dibawah ini sesuai kebutuhan perusahaan anda, Klik dikolom centang untuk mengaktifkannya.
						   Anda dapat mengaktifkan atau menonaktifkan kapan saja Anda mau.</font></p></h4>
						  

                              @foreach($menu as $key=> $menus)
							<div class="col-md-12">
                               <div class="form-group">
                                   <label class="main-class" ><font color="#EE3723">{{ $menus->nm_menu }}</font></label>
                               </div>
							</div>
                                  @if(!empty($submenu=$menus->getSubmenu))
                                        @foreach($submenu as $sKey => $sum_menu)
										<div class="col-md-4">
                                           <div class="form-group" style="padding-left: 5%;">
                                               <input type="checkbox" class="minimal menu_sub_{{ $key }}" value="{{ $sum_menu->id }}" id="menus_{{ $key }}"
                                               @if(!empty($menu_perusahaan))
                                                    @foreach($menu_perusahaan as $menu_perusahaans)
                                                        @if($menu_perusahaans->id_master_submenu == $sum_menu->id)
                                                            checked
                                                                @endif
                                                    @endforeach
                                               @endif
                                               > <label > {{ $sum_menu->nm_submenu }}
                                               </label>
                                           </div>
										</div>
										<input type="hidden" name="urutan" value="{{ $sum_menu->urutan }}">
                                        @endforeach
                                  @endif
                               @endforeach
							
                               <input type="hidden" name="id_perusahaan" value="{{ $usaha->id }}">
							
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
           });

           $('.main-class').each(function (index) {
//               $('#menu_'+index).on('ifChecked', function (event) {
//                   $('.menu_sub_'+index).iCheck('check')
//               })

               $('.menu_sub_'+index).on('ifChecked', function (event) {
                 //  $('#menu_'+index).iCheck('check')
                  // alert(""+ $(this).val());
                   $.ajax({
                       url:"{{ url('store_request_menu') }}",
                       type: "post",
                       data :{
                           'sub_menu_id': $(this).val(),
                           'id_usaha': $('[name="id_perusahaan"]').val(),
                           '_token' : "{{ csrf_token() }}"
                       },
                       success:function (result) {
                           console.log(result);
                           console.log("Anda telah mengkatifkan menu ini")
                       }
                   })
               });

               $('.menu_sub_'+index).on('ifUnchecked', function (event) {
                   $.ajax({
                       url:"{{ url('delete_request_menu') }}",
                       type: "post",
                       data :{
                           'sub_menu_id': $(this).val(),
                           'id_usaha': $('[name="id_perusahaan"]').val(),
                           '_token' : "{{ csrf_token() }}"
                       },
                       success:function (result) {
                           console.log(result);
                           console.log("Anda telah menontaktifkan menu ini")
                       }
                   })
               })

           })


       })
    </script>
@stop
