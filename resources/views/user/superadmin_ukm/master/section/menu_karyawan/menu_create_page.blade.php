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
           Halaman Pengaturan Menu Karyawan
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
                       <h5 class="pull-right"><a href="{{ url('pengguna-karyawan')}}">Kembali ke Halaman utama</a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif
                           <p style="color: green">Pilihlah menu aplikasi dibawah ini yang dapat di akses oleh karyawan bersangkutan.</p>

                              @foreach($menu as $key=> $menus)
                               <div class="form-group">
                                   <label class="main-class" >{{ $menus->getMasterMenu->nm_menu }}</label>
                               </div>
                                  @if(!empty($submenu=$menus->getSubMenu))
                                        @foreach($submenu as $sKey => $sum_menu)
											@if(!empty($sum_menu->getMasterSubMenuUKM->id))
                                           <div class="form-group" style="padding-left: 5%;">
                                               <input type="checkbox" class="minimal menu_sub_{{ $key }}" value="{{ $sum_menu->getMasterSubMenuUKM->id }}" id="menus_{{ $key }}"
                                               @if(!empty($daftar_menu_karyawan))
                                                    @foreach($daftar_menu_karyawan as $daftar_menu)
                                                            @if($sum_menu->getMasterSubMenuUKM->id == $daftar_menu->getSubMenuPerusahaan->id_master_submenu)
                                                                checked
                                                                @endif
                                                            @endforeach
                                                       @endif
                                               > <label >  {{ $sum_menu->getMasterSubMenuUKM->nm_submenu }}
                                               </label>
                                           </div>
										   @endif
                                        @endforeach
                                  @endif
                               @endforeach
                               <input type="hidden" name="id_perusahaan" value="{{ $karyawan->id_perusahaan }}">
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
                       url:"{{ url('store_request_menu_karyawan') }}/{{ $karyawan->id }}",
                       type: "post",
                       data :{
                           'id_master_submenu': $(this).val(),
                           'id_usaha': $('[name="id_perusahaan"]').val(),
                           '_method' : 'put',
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
                       url:"{{ url('delete_request_menu_karyawan') }}/{{ $karyawan->id }}",
                       type: "post",
                       data :{
                           'id_master_submenu': $(this).val(),
                           'id_usaha': $('[name="id_perusahaan"]').val(),
                           '_method' : 'put',
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
