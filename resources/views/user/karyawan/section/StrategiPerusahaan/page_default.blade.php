@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Strategi Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>
			<!---target jangka panjang--->
			@foreach ($data_tjp as $tjp)
				<div class="col-md-12">
                    <div class="box box-default collapsed-box">
						<div class="box-header with-border">
						@if(!empty($tjp))
                            <h3 class="box-title"><b> {{ $tjp->nm_tjp }}</b></h3>
						@endif
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" onclick="tambahSJP({{ $tjp->id }})" title="Tambah Strategi Jangka Panjang"><i class="fa fa-plus"></i>
									</button> 			
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="Buka tutup isi"></i>
									</button>   
								</div>
                        </div>
                        <!-- /.box -->
						<div class="box-body">
							<ul>
								@if(!empty($tjp->getSJP->isi_sjp))	
								<a href="#" onclick="hapusSJP({{ $tjp->getSJP->id }})" class="pull-right" title="hapus strategi Jangka Panjang" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
								<a href="#" onclick="ubahSJP({{ $tjp->getSJP->id }})" class="pull-right" title="ubah strategi jangka panjang"><i class="fa fa-pencil"></i>  </a> </li>
								<h4 class="box-title">
									{!! $tjp->getSJP->isi_sjp !!}
								</h4>
								@endif	
							</ul>
						</div>
                </div>
				@foreach($tjp->getTargetTahunan->groupBy('tahun') as $tahune =>$values)
				<div class="col-md-11">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b> {{ $tahune }}</b></h3>
                        </div>   
                    </div>
                    <!-- /.box -->
                </div>
					@foreach($data_tt as $Ttahunan)
						@if ($tahune == $Ttahunan->tahun)
							<div class="col-md-10">
								<div class="box box-default collapsed-box">
									<div class="box-header with-border">
										  <h4 class="box-title"><b>Departemen</b> : {{ $Ttahunan->getBagian->nm_bagian }}, &nbsp; <b>Divisi</b> : {{ $Ttahunan->getDivisi->nm_devisi }}, &nbsp; <b>Jabatan</b> : {{ $Ttahunan->getJabatan->nm_jabatan }}
										  </h4>
										@if ((!empty($Ttahunan->id)) && (!empty($tjp->getSJP->id)))
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" onclick="tambahStahunan('{{ $tjp->getSJP->id }}','{{ $Ttahunan->id }}' )" title="tambah Strategi Tahunan"><i class="fa fa-plus"></i></button> 	
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>   
										</div>
										@endif
									</div>
									<div class="box-body">
										<ul>
										@if(!empty($Ttahunan->getStrategiTahunan->isi_stahunan))
											
											<a href="#" onclick="hapusStahunan({{ $Ttahunan->getStrategiTahunan->id }})" class="pull-right" title="hapus strategi tahunan" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
											<a href="#" onclick="ubahStahunan({{ $Ttahunan->getStrategiTahunan->id }})" class="pull-right" title="ubah strategi tahunan"><i class="fa fa-pencil"></i>  </a> </li>
											<h4 class="box-title">
											{!! $Ttahunan->getStrategiTahunan->isi_stahunan !!}
											</h4>
										@endif	
										</ul>
									</div>
								</div>
                            <!-- /.box -->
							</div>
							@foreach($data_tbulanan as $bulan)
							@if ($bulan->id_target_tahunan == $Ttahunan->id)	
							<div class="col-md-9">
								<div class="box box-default collapsed-box">
									<div class="box-header with-border">
									<h4 class="box-title">
									{{ $bulan->bulan}}
									</h4>
										@if ((!empty($bulan->id)) && ($Ttahunan->getStrategiTahunan->id))
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" onclick="tambahSbulanan('{{ $bulan->id }}','{{ $Ttahunan->getStrategiTahunan->id }}' )" title="tambah Strategi Bulanan"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
										</div>
										@endif	
									</div>
									<div class="box-body">
									<ul>
										<a href="#" onclick="hapusSbulanan({{ $bulan->id }})" class="pull-right" title="hapus strategi bulanan" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
										<a href="#" onclick="ubahSbulanan({{ $bulan->id }})" class="pull-right" title="ubah strategi bulanan"><i class="fa fa-pencil"></i>  </a> </li>
										<h4 class="box-title">
										@if(!empty($bulan->getStrategiBulanan->isi_sbulanan))
										{!! $bulan->getStrategiBulanan->isi_sbulanan !!}
										@endif
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
    </section>
    <!-- /.content -->
	@include('user.karyawan.section.StrategiPerusahaan.include.modal')
</div>
@stop
@section('plugins')

   <!-- Select2 -->
   <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
   <script>
   $(function () {
            $('.select2').select2();
        });

        $(document).ready(function () {
            var ids;
            
			tambahSJP  = function (id) {
                $('[name="id_tjp"]').val(id);
                $('#modal-tambah-SJP').modal('show');
            };
			
			ubahSJP = function (id) {
                $.ajax({
                    url: '{{ url('ubah-sjp') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    
						CKEDITOR.instances.isi_sjp_ubah.setData(result.data_sjp.isi_sjp);
                        $('[name="id_sjp"]').val(result.data_sjp.id);
                        $('#modal-ubah-SJP').modal('show');
                    }
                })
			};    
			
			hapusSJP = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusSJP') }}/'+id,
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
			
			tambahStahunan  = function (id,id2) {
			//alert("test")
				$('[name="id_sjp"]').val(id);
                $('[name="id_target_tahunan"]').val(id2);
                $('#modal-tambah-Stahunan').modal('show');
            }; 
			
			ubahStahunan = function (id) {
                $.ajax({
                    url: '{{ url('ubah-stahunan') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    
						CKEDITOR.instances.isi_stahunan_ubah.setData(result.data_stahunan.isi_stahunan);
                        $('[name="id_stahunan"]').val(result.data_stahunan.id);
                        $('#modal-ubah-Stahunan').modal('show');
                    }
                })
			};
			
			hapusStahunan = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusStahunan') }}/'+id,
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
			
			tambahSbulanan  = function (id,id2) {
			//alert("test")
				$('[name="id_target_bulanan"]').val(id);
                $('[name="id_stahunan"]').val(id2);
                $('#modal-tambah-Sbulanan').modal('show');
            };
			
			ubahSbulanan = function (id) {
                $.ajax({
                    url: '{{ url('ubah-sbulanan') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    
						CKEDITOR.instances.isi_sbulanan_ubah.setData(result.data_sbulanan.isi_sbulanan);
                        $('[name="id_sbulanan"]').val(result.data_sbulanan.id);
                        $('#modal-ubah-Sbulanan').modal('show');
                    }
                })
			};
			
			hapusSbulanan = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusSbulanan') }}/'+id,
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

