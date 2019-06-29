@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
	 <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
	
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Target Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-rencana-marketing') }}" class="btn btn-primary">Buat Rencana Marketing Perusahaan Anda</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @if(empty($data_rencana_mb))
            <h4 style="color: orange; text-align: center">Belum ada rencana marketing perusahaan anda..!!</h4>
            @else
			@foreach ($data_tjp as $tjp)
				<div class="col-md-12">
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
							@if(!empty($tjp))
                                <h3 class="box-title"><b> {{ $tjp->nm_tjp }}</b></h3>
							@endif
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" onclick="tambahTtahunan({{ $tjp->id }})" title="Tambah Target Jangka Panjang"><i class="fa fa-plus"></i>
								</button> 			
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="Buka tutup isi"></i>
								</button>   
							</div>
                        </div>
						<!-- /.box-header-->
							<div class="box-body">
							<ul>
								<a href="#" onclick="hapusTJP({{ $tjp->id }})" class="pull-right" 
								title="Hapus Target Jangka Panjang" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
								<a href="#" onclick="ubah_tjp({{ $tjp->id }})" class="pull-right" 
								title="Ubah target jangka panjang"><i class="fa fa-pencil"></i>  </a> </li>
								<h4 class="box-title">
									<p><h5><b>Mulai {{ $tjp->thn_mulai }} - {{ $tjp->thn_selesai }} </b> </h5></p>
											{!! $tjp->isi_tjp !!}
								</h4>	
							</ul>
							</div>
                        <!-- /.box body-->
					</div>
					 <!-- /.box success-->
				</div>
					@foreach($tjp->getTargetTahunan->sortBy('tahun')->groupBy('tahun') as $tahune =>$values)
					<div class="col-md-11">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b> {{ $tahune }}</b></h3>
                            </div>   
                        </div>
                        <!-- /.box -->
                    </div>
						@foreach ($data_tt as $Ttahunan)
							@if ($tahune == $Ttahunan->tahun)
							<div class="col-md-10">
								<div class="box box-default collapsed-box">
									<div class="box-header with-border">
										<h4 class="box-title">
											<b>Departemen</b> : {{ $Ttahunan->getBagian->nm_bagian }}, &nbsp; 
											<b>Divisi</b> : {{ $Ttahunan->getDivisi->nm_devisi }}, &nbsp; 
											<b>Jabatan</b> : {{ $Ttahunan->getJabatan->nm_jabatan }}
										</h4>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" onclick="tambahTbulanan({{ $Ttahunan->id }})" title="Tambah Target Bulanan"><i class="fa fa-plus"></i></button> 
										
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>   
										</div>
									</div>
										<div class="box-body">
											<ul>
											<a href="#" onclick="hapusTtahunan({{ $Ttahunan->id }})" class="pull-right" 
											title="Hapus Target Tahunan" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
											<a href="#" onclick="ubahTtahunan({{ $Ttahunan->id }})" class="pull-right" 
											title="Ubah target Tahunan"><i class="fa fa-pencil"></i>  </a> </li>
											<h4 class="box-title"> {!! $Ttahunan->target_tahunan !!}</h4>	
											</ul>
										</div>
								</div>
								<!-- /.box -->
							</div>
								@foreach($data_tb as $Tbulanan)
									@if ($Tbulanan->id_target_tahunan == $Ttahunan->id)
										<div class="col-md-9">
											<div class="box box-default collapsed-box">
												<div class="box-header with-border">
													<h4 class="box-title">{{ $Tbulanan->bulan}}</h4>
														<div class="box-tools pull-right">
															<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="Buka tutup isi"></i></button>   
														</div>
												</div>
													<div class="box-body">
														<ul>
															<a href="#" onclick="hapusTbulanan({{ $Tbulanan->id }})" class="pull-right" title="hapus target bulanan" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
															<a href="#" onclick="ubahTbulanan({{ $Tbulanan->id }})" class="pull-right" title="ubah target bulanan"><i class="fa fa-pencil"></i>  </a> </li>
															<h4 class="box-title">
																{!! $Tbulanan->target_bulanan !!}
															</h4>
														</ul>
													</div>
											</div>
											<!-- /.box -->
										</div>
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
				@endforeach  
            @endif

        </div>
    </section>
    <!-- /.content -->
</div>
	@include('user.karyawan.section.TargetPerusahaan.include.modal')
@stop

@section('plugins')

    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	  <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
	
    <script>
        $(function () {
			
            $('.select2').select2();
        });

        $(document).ready(function () {
            var ids;
            
         ubah_tjp = function (id) {
                $.ajax({
                    url: '{{ url('ubah-tjp') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
						$('[name="id_tjp_ubah"]').val(result.data_tjp.id);
						$('[name="nm_tjp_ubah"]').val(result.data_tjp.nm_tjp);
						$('[name="periode_ubah"]').val(result.data_tjp.periode);
						$('[name="thn_mulai_ubah"]').val(result.data_tjp.thn_mulai).trigger('change');
						$('[name="thn_selesai_ubah"]').val(result.data_tjp.thn_selesai).trigger('change');
						CKEDITOR.instances.isi_tjp_ubah.setData(result.data_tjp.isi_tjp);
                        $('#modal-ubah-tjp').modal('show');
                    }
                })
			};    
			
		hapusTJP = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusTJP') }}/'+id,
                        type : 'post',
                        data :{
                            '_method': 'put',
                            '_token' : '{{ csrf_token() }}'
                        },
                        success:function (result) {
                            alert(result.message);
                            window.location.reload()
                        }
                    })
                }else {
                    alert("Data ini tidak jadi dihapus");
                }
			}
			
		tambahTtahunan  = function (id) {
				$('[name="id_tjp"]').val(id);
				$('[name="id_bagian_p"]').val(id);
				$('[name="id_divisi_p"]').val(id);
                $('#tambah-target-tahunan').modal('show');
            };
			
		ubahTtahunan = function (id) {
                $.ajax({
                    url: '{{ url('ubah-Ttahunan') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
						$('[name="id_tjp_ubah"]').val(result.data_tt.id_tjp).trigger('change');
						$('[name="tahun_ubah"]').val(result.data_tt.tahun).trigger('change');
						$('[name="id_bagian_p_ubah"]').val(result.data_tt.id_bagian_p).trigger('change');
						$('[name="id_divisi_p_ubah"]').val(result.data_tt.id_divisi_p).trigger('change');
						$('[name="id_jabatan_p_ubah"]').val(result.data_tt.id_jabatan_p).trigger('change');
						CKEDITOR.instances.target_tahunan_ubah.setData(result.data_tt.target_tahunan);
						$('[name="id_Ttahunan"]').val(result.data_tt.id);
                        $('#modal-ubahTtahunan').modal('show');
                    }
                })
			}; 
		hapusTtahunan = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusTtahunan') }}/'+id,
                        type : 'post',
                        data :{
                            '_method': 'put',
                            '_token' : '{{ csrf_token() }}'
                        },
                        success:function (result) {
                            alert(result.message);
                            window.location.reload()
                        }
                    })
                }else {
                    alert("Data ini tidak jadi dihapus");
                }
			}
			
		tambahTbulanan  = function (id) {
				$('[name="id_target_tahunan"]').val(id);
                $('#tambah-target-bulanan').modal('show');
            };
			
		ubahTbulanan = function (id) {
                $.ajax({
                    url: '{{ url('ubah-Tbulanan') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
						$('[name="id_tt_ubah"]').val(result.data_tb.id_target_tahunan).trigger('change');
						$('[name="bulan_ubah"]').val(result.data_tb.bulan).trigger('change');
						CKEDITOR.instances.target_bulanan_ubah.setData(result.data_tb.target_bulanan);
						$('[name="id_Tbulanan"]').val(result.data_tb.id);
                        $('#modal-ubah-tTbulanan').modal('show');
                    }
                })
			};  
		hapusTbulanan = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusTbulanan') }}/'+id,
                        type : 'post',
                        data :{
                            '_method': 'put',
                            '_token' : '{{ csrf_token() }}'
                        },
                        success:function (result) {
                            alert(result.message);
                            window.location.reload()
                        }
                    })
                }else {
                    alert("Data ini tidak jadi dihapus");
                }
			}
			
			
        })
    </script>
@stop

