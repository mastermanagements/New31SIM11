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
            RAB
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Rencana Pengeluaran</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Rencana Penjualan Barang(RPB)</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Rencana Penjualan Jasa (RPJ)</a></li>
                    </ul>
				
                    <div class="tab-content">
						<div class="tab-pane active" id="tab_1"></br>
                        @foreach($data_tt as $tahun)
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title"><b> {{ $tahun->tahun }}</b></h3>
									</div>   
								</div>
								<!-- /.box -->

							@foreach($data_tbulanan as $bulan)
								@if ($bulan->id_target_tahunan == $tahun->id)
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h4 class="box-title">
											{{ $bulan->bulan}}
											</h4>
											@if ((!empty ($tahun->tahun) && ($bulan->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahROUT('{{ $bulan->bulan }}','{{ $tahun->tahun }}' )" title="tambah Rencana Pengeluaran"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Pengeluaran</th>
												<th>Jumlah Pengeluaran</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											@php($i=1)
											@php($total_pengeluaran=0)

											@foreach($data_rout as $value)
											@if(($value->tahun == $tahun->tahun) AND ($value->bulan == $bulan->bulan))
											<tr>
												<td>{{ $i++ }}</td>
												<td>
													@if(!empty($value->getSubSubAkun->nm_subsub_akun))
													{{ $value->getSubSubAkun->nm_subsub_akun }}
													@endif
												</td>
													
													@php($total_rout = $value->jumlah_pengeluaran)
												<td align="right">
													{{ number_format($total_rout,2,',','.') }}
												</td>
												
											   <td align="center">	
													<form action="{{ url('hapus-rout/'.$value->id) }}" method="post">
													<a href="#" onclick="ubahROUT({{ $value->id }})" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a> 
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="put"/>
													<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
													</form>	
												</td>
											</tr>
												@php ($total_pengeluaran += $total_rout)
	
											@endif
											@endforeach
											 <tr>
												<td colspan="2"><strong>Jumlah Total</strong></td>
												<td align="right">{{ number_format($total_pengeluaran,2,',','.') }}</td>
											  </tr>
										</tbody>
										</table>
										</div>
										<!-- /.box body -->
									</div>
									<!-- /.box -->
								@endif
							@endforeach	
                        @endforeach
                        </div>
						<!-- /.tab_1 -->
                        <div class="tab-pane" id="tab_2"></br>
                        @foreach($data_tt as $tahun)
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title"><b> {{ $tahun->tahun }}</b></h3>
									</div>   
								</div>
								<!-- /.box -->
								
							@foreach($data_tbulanan as $bulan)
								@if ($bulan->id_target_tahunan == $tahun->id)
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h4 class="box-title">
											{{ $bulan->bulan}}
											</h4>
											@if ((!empty ($tahun->tahun) && ($bulan->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahRPB('{{ $bulan->bulan }}','{{ $tahun->tahun }}' )" title="tambah P Barang"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
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
											
											@foreach($data_rpb as $value)
											@if(($value->tahun == $tahun->tahun) AND ($value->bulan == $bulan->bulan))
											<tr>
												<td>{{ $i++ }}</td>
												<td>{{ $value->getDataBarang->nm_barang }}</td>
												<td align="right">
												@foreach($data_pembelian as $beli)
													@if(!empty($value->getDataBarang->id == $beli->getBarang->id))
													{{ number_format($harga_beli = $beli->harga_beli,2,',','.') }}
													@endif
												@endforeach
												</td>
												<td align="right">
												{{ number_format($harga_jual = $value->getDataBarang->harga_jual,2,',','.') }}
												</td>
												@php( $jumlah_klien = $value->target_klien_beli)
												<td align="center">
													{{ $jumlah_klien }}
												</td>
												@php($jumlah_barang = $value->target_brg_terjual)
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
													<form action="{{ url('hapus-rpb/'.$value->id) }}" method="post">
													<a href="#" onclick="ubahRPB({{ $value->id }})" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a> 
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="put"/>
													<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
													</form>	
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
										<!-- /.box body -->
									</div>
									<!-- /.collapsed-box -->
								@endif
							@endforeach	
                        @endforeach
                        </div>
						
						<div class="tab-pane" id="tab_3"></br>
                        @foreach($data_tt as $tahun)
							
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title"><b> {{ $tahun->tahun }}</b></h3>
									</div>   
								</div>
								<!-- /.box -->
							
							@foreach($data_tbulanan as $bulan)
								@if ($bulan->id_target_tahunan == $tahun->id)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h4 class="box-title">
											{{ $bulan->bulan}}
											</h4>
											@if ((!empty ($tahun->tahun) && ($bulan->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahRPJ('{{ $bulan->bulan }}','{{ $tahun->tahun }}' )" title="tambah P Barang"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
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
											
											@foreach($data_rpj as $value)
											@if(($value->tahun == $tahun->tahun) AND ($value->bulan == $bulan->bulan))
											<tr>
												<td>{{ $i++ }}</td>
												<td>{{ $value->getDataJasa->nm_jasa }}</td>
												<td align="right">
												{{ number_format($tarif = $value->getDataJasa->harga_jasa,2,',','.') }}
												</td>
												@php( $target_klien = $value->target_klien_beli)
												<td align="center">
													{{ $target_klien }}
												</td>
												@php($target_jasa = $value->target_jasa_terjual)
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
													<form action="{{ url('hapus-rpj/'.$value->id) }}" method="post">
													<a href="#" onclick="ubahRPJ({{ $value->id }})" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a> 
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="put"/>
													<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
													</form>	
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
												<td align="right">{{ number_format($total_jomset,2,',','.') }}</td>
												<td align="right">{{ number_format($total_jlaba_kotor,2,',','.') }}</td>
											  </tr>
										</tbody>
										</table>
										</div>
									</div>
									<!-- /.box -->
								
								@endif
							@endforeach	
                        @endforeach
                        </div>
						<!-- /.tab-pane 3 -->
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
