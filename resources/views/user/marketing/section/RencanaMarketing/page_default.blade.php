@extends('user.marketing.master_user')

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
                        @foreach($data_rpb->groupBy('tahun') as $tahun =>$value)
							<div class="col-md-12">
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title"><b> {{ $tahun }}</b></h3>
									</div>   
								</div>
								<!-- /.box -->
							</div>
							@foreach($value->groupBy('bulan') as $bulane => $values)
									<div class="col-md-12">
										<div class="box box-default collapsed-box">
											<div class="box-header with-border">
												<h4 class="box-title">
												{{ $bulane }}
												</h4>
												@if ((!empty ($tahun) && ($bulane)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
												@endif
											</div>
											<!-- /.box-header -->
											<div class="box-body">
												<table id="example1" class="table table-bordered table-striped">
												<h5 class="box-title"><b><font color="#e60000">Rencana Penjualan Barang</font color></b></h5>
												<thead>
													<tr>
														<th>No.</th>
														<th>Nama Barang</th>
														<th>Harga Beli</th>
														<th>Harga Jual</th>
														<th>Target Klien Beli</th>
														<th>Target Barang Terjual</th>
														<th>Omset</th>
														<th>Laba Kotor</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													@php($total_klien_beli=0)
													@php($total_barang_dibeli=0)
													@php($total_omset=0)
													@php($total_laba_kotor=0)
													
													@foreach($data_rpb as $rpb)
													@if(($rpb->tahun == $tahun) AND 
														($rpb->bulan == $bulane))
														<tr>
															<td>{{ $i++ }}</td>
															<td>{{ $rpb->getDataBarang->nm_barang }}</td>
															<td align="right">
																@foreach($data_pembelian as $beli)
																	@if(!empty($rpb->getDataBarang->id == $beli->getBarang->id))
																	{{ number_format($harga_beli = 	$beli->harga_beli,2,',','.') }}
																	@endif
																@endforeach
															</td>
															<td align="right">
																{{ number_format($harga_jual = $rpb->getDataBarang->harga_jual,2,',','.') }}
															</td>
																@php( $jumlah_klien = $rpb->target_klien_beli)
															<td align="center">
																{{ $jumlah_klien }}
															</td>
																@php($jumlah_barang = $rpb->target_brg_terjual)
															<td align="center">
																{{ $jumlah_barang }}
															</td>
															<!--
															omset per brg = jumlah brg * hrg jual brg * jumlah klien yg beli
															laba kotor    = jumlah brg * keuntungan (harga jual - hrg beli) * jumlah klien
															-->
															<td align="right">
																{{ number_format($omset = $jumlah_barang * $harga_jual * $jumlah_klien,2,',','.') }}
																
															</td>
															<td align="right">
																{{ number_format($laba_kotor = $jumlah_barang * ($harga_jual- $harga_beli) * $jumlah_klien,2,',','.') }}
															</td>
															<td>	
																<button type="button" class="btn btn-box-tool" onclick="tambahRMB('{{ $rpb->id }}','{{ $rpb->target_brg_terjual }}','{{ $rpb->target_klien_beli }}'
																)" title="tambah Marketing Barang"><i class="fa fa-plus"></i>
																</button> 
																 	
															</td>
														</tr>
															@php ($total_klien_beli += $jumlah_klien)
															@php ($total_barang_dibeli += $jumlah_barang)
															@php ($total_omset += $omset)
															@php ($total_laba_kotor += $laba_kotor)
													@endif
													@endforeach
														<tr>
															<td colspan="4"><strong>Jumlah Total</strong></td>
															<td align="center">{{ $total_klien_beli }}</td>
															<td align="center">{{ $total_barang_dibeli }}</td>
															<td align="right">{{ number_format($total_omset,2,',','.') }}</td>
															<td align="right">{{ number_format($total_laba_kotor,2,',','.') }}</td>
														</tr>
												</tbody>
												</table>
											</div>
											<!-- /.box body rencana penjualan brg-->
											
											<!--/.rencana marketing barang-->
											<div class="box-body">
												<table id="example1" class="table table-bordered table-striped">
												<h5 class="box-title"><b><font color="#e60000">Rencana Marketing Barang</font color="#e60000"></b></h5>
												<thead>
													<tr>
														<th>No.</th>
														<th>Nama Barang</th>
														<th>Promo Klien</th>
														<th>Promo Calon Klien</th>
														<th>Keterangan</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													@foreach($data_rpb as $rpb)
													@foreach($data_rmb as $rmb)
													@if($rpb->id == $rmb->id_rencana_pend_brg)
														<tr>
															<td>{{ $i++ }}</td>
															<td>
															{{ $rmb->getRencanaPendBarang->id_rencana_pend_brg = $rpb->getDataBarang->nm_barang }}
															</td>
															<td align="center">
																{{ $rmb->jum_klien_lama }}
															</td>
															<td align="center">
																{{ $rmb->jum_klien_baru }}
															</td>
															<td align="justify">
																{!! $rmb->ket !!}
																
															</td>
															<td align="center">
																<form action="{{ url('hapus-rmb/'.$rmb->id) }}" method="post">
																<a href="#" onclick="ubahRMB({{ $rmb->id }})" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a> 
																{{ csrf_field() }}
																<input type="hidden" name="_method" value="put"/>
																<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
																</form>	
															</td>
														</tr>
													@endif
													@endforeach
													@endforeach
												</tbody>
												</table>
											</div>
											<!-- /.box body rencana marketing brg-->
										</div>
										<!-- /.collapsed-box -->
									</div>
									<!-- /.col-md-12 -->
							 @endforeach	
                        @endforeach
                        </div>
						<!-- /.end tab_1 -->
                        <div class="tab-pane active" id="tab_2">
                        @foreach($data_rpj->groupBy('tahun') as $tahun =>$value)
							<div class="col-md-12">
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title"><b> {{ $tahun }}</b></h3>
									</div>   
								</div>
								<!-- /.box -->
							</div>
							@foreach($value->groupBy('bulan') as $bulane => $values)
									<div class="col-md-12">
										<div class="box box-default collapsed-box">
											<div class="box-header with-border">
												<h4 class="box-title">
												{{ $bulane }}
												</h4>
												@if ((!empty ($tahun) && ($bulane)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
												@endif
											</div>
											<!-- /.box-header -->
											<div class="box-body">
												<table id="example1" class="table table-bordered table-striped">
												<h5 class="box-title"><b><font color="#e60000">Rencana Penjualan Jasa</font color></b></h5>
												<thead>
													<tr>
														<th>No.</th>
														<th>Nama Jasa</th>
														<th>Tarif</th>
														<th>Target Klien Beli</th>
														<th>Target Jasa Terjual</th>
														<th>Omset</th>
														<th>Laba Kotor</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													@php($total_jklien_beli=0)
													@php($total_jasa_dibeli=0)
													@php($total_jomset=0)
													@php($total_jlaba_kotor=0)
													
													@foreach($data_rpj as $rpj)
														@if(($rpj->tahun == $tahun) AND 
														($rpj->bulan == $bulane))
														<tr>
															<td>{{ $i++ }}</td>
															<td>{{ $rpj->getDataJasa->nm_jasa }}</td>
															<td align="right">
																{{ number_format($tarif = $rpj->getDataJasa->harga_jasa,2,',','.') }}
															</td>
															@php( $target_klien = $rpj->target_klien_beli)
															<td align="center">
																{{ $target_klien }}
															</td>
															@php($target_jasa = $rpj->target_jasa_terjual)
															<td align="center">
																{{ $target_jasa }}
															</td>
															<!--
															omset per jasa = laba kotor  = 
															jumlah jasa terjual * hrg jual jasa * jumlah klien yg beli
															laba kotor   
															-->
															<td align="right">
																{{ number_format($jomset = $target_jasa * $tarif * $target_klien,2,',','.') }}
													
															</td>
															<td align="right">
																{{ number_format($jlaba_kotor = $jomset,2,',','.') }}
															</td>
															<td>	
																<button type="button" class="btn btn-box-tool" onclick="tambahRMJ('{{ $rpj->id }}','{{ $rpj->target_jasa_terjual }}','{{ $rpj->target_klien_beli }}'
																)" title="tambah Marketing Jasa"><i class="fa fa-plus"></i>
																</button> 
																 	
															</td>
														</tr>
															@php ($total_jklien_beli += $target_klien)
															@php ($total_jasa_dibeli += $target_jasa)
															@php ($total_jomset += $jomset)
															@php ($total_jlaba_kotor += $jlaba_kotor)
														@endif
													@endforeach
														<tr>
															<td colspan="3"><strong>Jumlah Total</strong></td>
															<td align="center">{{ $total_jklien_beli }}</td>
															<td align="center">{{ $total_jasa_dibeli }}</td>
															<td align="right">{{ 	 number_format($total_jomset,2,',','.') }}</td>
															<td align="right">{{ number_format($total_jlaba_kotor,2,',','.') }}</td>
														</tr>
												</tbody>
												</table>
											</div>
											<!-- /.box body rencana penjualan jasa-->
											
											<!--/.rencana marketing jasa-->
											<div class="box-body">
												<table id="example1" class="table table-bordered table-striped">
												<h5 class="box-title"><b><font color="#e60000">Rencana Marketing Jasa</font color="#e60000"></b></h5>
												<thead>
													<tr>
														<th>No.</th>
														<th>Nama Barang</th>
														<th>Promo Klien</th>
														<th>Promo Calon Klien</th>
														<th>Keterangan</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													@foreach($data_rpj as $rpj)
													@foreach($data_rmj as $rmj)
													@if($rpj->id == $rmj->id_rencana_pend_jasa)
														<tr>
															<td>{{ $i++ }}</td>
															<td>
															{{ $rmj->getRencanaPendJasa->id_rencana_pend_jasa = $rpj->getDataJasa->nm_jasa }}
															</td>
															<td align="center">
																{{ $rmj->jum_klien_lama }}
															</td>
															<td align="center">
																{{ $rmj->jum_klien_baru }}
															</td>
															<td align="justify">
																{!! $rmj->ket !!}
															</td>
															<td align="center">
																<form action="{{ url('hapus-rmj/'.$rmj->id) }}" method="post">
																<a href="#" onclick="ubahRMJ({{ $rmj->id }})" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a> 
																{{ csrf_field() }}
																<input type="hidden" name="_method" value="put"/>
																<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
																</form>	
															</td>
														</tr>
													@endif
													@endforeach
													@endforeach
												</tbody>
												</table>
											</div>
											<!-- /.box body rencana marketing jasa-->
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
	@include('user.marketing.section.RencanaMarketing.include.modal')
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
			
			tambahRMB  = function (id,id2,id3) {
			//alert("test")
				$('[name="id_rencana_pend_brg"]').val(id);
				$('[name="target_brg_terjual"]').val(id2);
				$('[name="target_klien_beli"]').val(id3);
                $('#modal-tambah-RMB').modal('show');
            };
			ubahRMB = function (id) {
                $.ajax({
                    url: '{{ url('ubah-rmb') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_tjp.thn_mulai);
					
						$('[name="id_rencana_pend_brg_ubah"]').val(result.data_rmb.id_rencana_pend_brg).trigger('change');
						$('[name="jum_klien_lama_ubah"]').val(result.data_rmb.jum_klien_lama).trigger('change');
						$('[name="jum_klien_baru_ubah"]').val(result.data_rmb.jum_klien_baru).trigger('change');
						CKEDITOR.instances.ket_ubah.setData(result.data_rmb.ket);
						$('[name="id_rmb"]').val(result.data_rmb.id);
                        $('#modal-ubahRMB').modal('show');
                    }
                })
			};
			tambahRMJ  = function (id,id2,id3) {
			//alert("test")
				$('[name="id_rencana_pend_jasa"]').val(id);
				$('[name="target_jasa_terjual"]').val(id2);
				$('[name="target_klien_beli"]').val(id3);
                $('#modal-tambah-RMJ').modal('show');
            };
		})
	 </script>
@stop
