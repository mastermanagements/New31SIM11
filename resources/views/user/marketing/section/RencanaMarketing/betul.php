@extends('user.keuangan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rencana Marketing
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>
			
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Rencana Pemasaran Barang</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Rencana Pemasaran Jasa</a></li>
                    </ul>
				
                    <div class="tab-content">
						<div class="tab-pane active" id="tab_1">
                        @foreach($data_rpb as $rpb)
							<div class="col-md-12">
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title"><b> {{ $rpb->tahun }}</b></h3>
									</div>   
								</div>
								<!-- /.box -->
							</div>
							
							@foreach($data_rpb2->groupBy('bulan') as $bulane => $values)
								
									
								<div class="col-md-12">
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h4 class="box-title">
											
											{{ $bulane }}
											</h4>
										</div>
										<!-- /.box body -->
									</div>
									<!-- /.collapsed-box -->
								</div>
								<!-- /.col-md-12 -->
							
							 @endforeach	
                        @endforeach
                        </div>
						<!-- /.tab_1 -->
                        
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
			<!-- /.col-md-12 -->
        </div>
		<!-- /.row -->
    </section>
    <!-- /.sectiont -->
</div>
	<!-- /.wrapper -->
	@include('user.keuangan.section.rab.include.modal')
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
			
			tambahRPB  = function (id,id2) {
			//alert("test")
				$('[name="bulan"]').val(id);
                $('[name="tahun"]').val(id2);
                $('#modal-tambah-RPB').modal('show');
            };
			ubahRPB = function (id) {
                $.ajax({
                    url: '{{ url('ubah-rpb') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
					
						$('[name="tahun_ubah"]').val(result.data_rpb.tahun).trigger('change');
						$('[name="bulan_ubah"]').val(result.data_rpb.bulan).trigger('change');
						$('[name="id_barang_ubah"]').val(result.data_rpb.id_barang).trigger('change');
						$('[name="target_brg_terjual_ubah"]').val(result.data_rpb.target_brg_terjual);
						$('[name="target_klien_beli_ubah"]').val(result.data_rpb.target_klien_beli);
						$('[name="id_rpb"]').val(result.data_rpb.id);
                        $('#modal-ubahRPB').modal('show');
                    }
                })
			};
			tambahRPJ  = function (id,id2) {
			//alert("test")
				$('[name="bulan"]').val(id);
                $('[name="tahun"]').val(id2);
                $('#modal-tambah-RPJ').modal('show');
            };
			ubahRPJ = function (id) {
                $.ajax({
                    url: '{{ url('ubah-rpj') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
					
						$('[name="tahun_ubah"]').val(result.data_rpj.tahun).trigger('change');
						$('[name="bulan_ubah"]').val(result.data_rpj.bulan).trigger('change');
						$('[name="id_jasa_ubah"]').val(result.data_rpj.id_jasa).trigger('change');
						$('[name="target_jasa_terjual_ubah"]').val(result.data_rpj.target_jasa_terjual);
						$('[name="target_klien_beli_ubah"]').val(result.data_rpj.target_klien_beli);
						$('[name="id_rpj"]').val(result.data_rpj.id);
                        $('#modal-ubahRPJ').modal('show');
                    }
                })
			};
			
			tambahROUT  = function (id,id2) {
			//alert("test")
				$('[name="bulan"]').val(id);
                $('[name="tahun"]').val(id2);
                $('#modal-tambah-ROUT').modal('show');
            };
			
			ubahROUT = function (id) {
                $.ajax({
                    url: '{{ url('ubah-rout') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
					
						$('[name="tahun_ubah"]').val(result.data_rout.tahun).trigger('change');
						$('[name="bulan_ubah"]').val(result.data_rout.bulan).trigger('change');
						$('[name="id_subsub_akun_ubah"]').val(result.data_rout.id_subsub_akun).trigger('change');
						$('[name="jumlah_pengeluaran_ubah"]').val(result.data_rout.jumlah_pengeluaran);
						$('[name="id_rout"]').val(result.data_rout.id);
                        $('#modal-ubahROUT').modal('show');
                    }
                })
			};
			
		})
	 </script>
@stop
