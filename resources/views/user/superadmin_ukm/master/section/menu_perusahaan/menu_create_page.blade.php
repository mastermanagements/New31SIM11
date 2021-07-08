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
                Halaman Pengaturan Menu Perusahaan 
				@if($usaha->jenis_usaha =='0')Dagang
				@elseif($usaha->jenis_usaha =='1')Jasa
				@elseif($usaha->jenis_usaha =='2')Dagang & Jasa
				@else Manufaktur
				@endif
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
                            <h5 class="pull-right"><a href="{{ url('menu-perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a>
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            @if(!empty(session('message_success')))
                                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                            @elseif(!empty(session('message_fail')))
                                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                            @endif
                            <h4><p><font color="#0E50EC">Pilihlah menu dan submenu dibawah ini sesuai <font color="#E14408">kebutuhan perusahaan anda</font>, Klik dikolom centang untuk mengaktifkannya.
						   Anda dapat mengaktifkan atau menonaktifkan bebas kapan saja Anda mau. Untuk mengaktifkan/menonaktifkan semua menu dan sub menu, klik select all. </font></p></h4>
                            <label><input type="checkbox" name="sample" class="minimal selectall"/> Select all</label>

							@foreach($menu as $key=> $menus)
							<div class="col-md-12">
								{{-- tampilkan menu untuk jenis perusahaan dagang & kelompok menu perusahaan dagang --}}
								@if(($usaha->jenis_usaha == '0') AND ($menus->kelompok_menu =='0'))
                                <div class="form-group">
                                    <label ><font color="#EE3723">{{ $menus->nm_menu }}</font></label>
                                    <input type="hidden" class="main-class" value="{{ $key }}">
									
                                </div>
								@endif
								{{-- tampilkan menu untuk jenis perusahaan jasa & kelompok menu perusahaan jasa --}}
								@if(($usaha->jenis_usaha == '1') AND ($menus->kelompok_menu =='1'))
                                <div class="form-group">
                                    <label><font color="#EE3723">{{ $menus->nm_menu }}</font></label>
                                    <input type="hidden" class="main-class" value="{{ $key }}">
                                </div>
								@endif
								{{-- tampilkan menu untuk jenis perusahaan dagang & jasa & kelompok menu perusahaan dagang & jasa --}}
								@if(($usaha->jenis_usaha == '2') AND ($menus->kelompok_menu =='2'))
                                <div class="form-group">
                                    <label><font color="#EE3723">{{ $menus->nm_menu }}</font></label>
                                    <input type="hidden" class="main-class" value="{{ $key }}">
                                </div>
								@endif
								{{-- tampilkan menu untuk jenis perusahaan dagang & jasa & kelompok menu perusahaan dagang & jasa --}}
								@if(($usaha->jenis_usaha == '3') AND ($menus->kelompok_menu =='3'))
                                <div class="form-group">
                                    <label><font color="#EE3723">{{ $menus->nm_menu }}</font></label>
                                    <input type="hidden" class="main-class" value="{{ $key }}">
                                </div>
								@endif
							</div>
                                @if(!empty($submenu=$menus->getSubmenu))
                                    @foreach($submenu as $sKey => $sum_menu)
									<div class="col-md-4">
									
										{{-- tampilkan submenu untuk jenis perusahaan dagang & kelompok submenu perusahaan dagang --}}
										@if (($usaha->jenis_usaha == '0') AND($sum_menu->kelompok_submenu =='0'))
                                        <div class="form-group" style="padding-left: 5%;">
                                            <input type="checkbox" class="minimal status menu_sub_{{ $key }}"
                                                   value="{{ $sum_menu->id }}" id="menus_{{ $key }}"
                                                   @if(!empty($menu_perusahaan))
													@foreach($menu_perusahaan as $menu_perusahaans)
														@if($menu_perusahaans->id_master_submenu == $sum_menu->id)
															checked
														@endif
                                                    @endforeach
                                                   @endif
                                            > <label> 											
											{{ $sum_menu->nm_submenu }}											
                                            </label>
                                        </div>
										@endif
										
										{{-- tampilkan menu untuk jenis perusahaan jasa & kelompok menu perusahaan jasa --}}
										@if (($usaha->jenis_usaha == '1') AND($sum_menu->kelompok_submenu =='1'))
                                        <div class="form-group" style="padding-left: 5%;">
                                            <input type="checkbox" class="minimal status menu_sub_{{ $key }}"
                                                   value="{{ $sum_menu->id }}" id="menus_{{ $key }}"
                                                   @if(!empty($menu_perusahaan))
													@foreach($menu_perusahaan as $menu_perusahaans)
														@if($menu_perusahaans->id_master_submenu == $sum_menu->id)
															checked
														@endif
                                                    @endforeach
                                                   @endif
                                            > <label> 											
											{{ $sum_menu->nm_submenu }}											
                                            </label>
                                        </div>
										@endif
										
										{{-- tampilkan menu untuk jenis perusahaan dagang & jasa & kelompok submenu perusahaan dagang & jasa --}}
										@if (($usaha->jenis_usaha == '2') AND($sum_menu->kelompok_submenu =='2'))
                                        <div class="form-group" style="padding-left: 5%;">
                                            <input type="checkbox" class="minimal status menu_sub_{{ $key }}"
                                                   value="{{ $sum_menu->id }}" id="menus_{{ $key }}"
                                                   @if(!empty($menu_perusahaan))
													@foreach($menu_perusahaan as $menu_perusahaans)
														@if($menu_perusahaans->id_master_submenu == $sum_menu->id)
															checked
														@endif
                                                    @endforeach
                                                   @endif
                                            > <label> 											
											{{ $sum_menu->nm_submenu }}											
                                            </label>
                                        </div>
										@endif
										
										{{-- tampilkan menu untuk jenis perusahaan manufaktur & kelompok menu perusahaan manufaktur --}}
										@if (($usaha->jenis_usaha == '3') AND($sum_menu->kelompok_submenu =='3'))
                                        <div class="form-group" style="padding-left: 5%;">
                                            <input type="checkbox" class="minimal status menu_sub_{{ $key }}"
                                                   value="{{ $sum_menu->id }}" id="menus_{{ $key }}"
                                                   @if(!empty($menu_perusahaan))
													@foreach($menu_perusahaan as $menu_perusahaans)
														@if($menu_perusahaans->id_master_submenu == $sum_menu->id)
															checked
														@endif
                                                    @endforeach
                                                   @endif
                                            > <label> 											
											{{ $sum_menu->nm_submenu }}											
                                            </label>
                                        </div>
										@endif
									</div>
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

            $('.selectall').on('ifChecked', function(event){
                $('.minimal').iCheck('check');
            });
            $('.selectall').on('ifUnchecked', function(event){
                $('.minimal').iCheck('uncheck');
            });
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $('.main-class').each(function (index) {
                var n_val = $(this).val();
//               $('#menu_'+index).on('ifChecked', function (event) {
//                   $('.menu_sub_'+index).iCheck('check')
//               })
				

                $('.menu_sub_' + n_val).on('ifChecked', function (event) {
                    //  $('#menu_'+index).iCheck('check')
                    // alert(""+ $(this).val());
                    $.ajax({
                        url: "{{ url('store_request_menu') }}",
                        type: "post",
                        data: {
                            'sub_menu_id': $(this).val(),
                            'id_usaha': $('[name="id_perusahaan"]').val(),
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function (result) {
                            consalesle.log(result);
                            consalesle.log("Anda telah mengkatifkan menu ini")
                        }
                    })
                });

                $('.menu_sub_' + n_val).on('ifUnchecked', function (event) {
                    $.ajax({
                        url: "{{ url('delete_request_menu') }}",
                        type: "post",
                        data: {
                            'sub_menu_id': $(this).val(),
                            'id_usaha': $('[name="id_perusahaan"]').val(),
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function (result) {
                            consalesle.log(result);
                            consalesle.log("Anda telah menontaktifkan menu ini")
                        }
                    })
                })

            })


        })
    </script>
@stop
