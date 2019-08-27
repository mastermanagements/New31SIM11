@extends('user.marketing.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pelaksanaan Marketing - Closing
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><b>Barang</b></a></li>
						<li><a href="#tab_2" data-toggle="tab"><b>Jasa</b></a></li>
                    </ul>
                    <div class="tab-content">
					
                        <div class="tab-pane active" id="tab_1">
							</br>
							<div class="col-md-12">
									<label style="font-size: 15px">Pelaksanaan Marketing - Closing Barang Tahun {{now()->year }} </label>
							</div>
							</br></br>
							
							@if(!empty($data_rm))
								@foreach($data_rm->sortBy('id') as $rm)
								<div class="box box-default collapsed-box">
									<div class="box-header with-border">
										<h1 class="box-title">
											<b>{{ $rm->bulan}}</b>
										</h1>
											@if ((!empty ($rm->tahun) && ($rm->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahClosingBrg()" title="Tambah Closing Marketing"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
									</div>
									<div class="box-body">	
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal</th>
													<th>Nama Customer</th>
													<th>Nama Barang</th>
													<th>Pesan Closing</th>
													<th>Respon Customer</th>
													<th>Hasil Closing</th>
													<th>Follow up Ke</th>
													<th>Status </th>
													<th>Keterangan</th>
													<th>Histori</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php($i=1)
												@foreach($data_closing_brg as $closing)
													@foreach($status_closing as $st_closing)
														@if($st_closing->id_closing == $closing->id )
														<tr>
															<td>{{ $i++ }}</td>
															<td>{{ date('d-m-Y h:i:s', strtotime($st_closing->created_at ))}} </td>
															<td>{{ $closing->getKlien->nm_klien }}</td>
															<td>
																@if(!empty($closing->getBarang->nm_barang))
																{{ $closing->getBarang->nm_barang }}
																@endif
															</td>
															<td>Via : {{ $st_closing->tool_closing }},
															{{ $st_closing->content_closing }}</td>
															<td>{{ $st_closing->respon_klien }}</td>
															<td>{{ $st_closing->hasil_akhir }}</td>
										
															<td> 
																@if($st_closing->id_bagian !== 0 AND $st_closing->id_divisi !== 0)
																Departemen : &nbsp;	
																{{ $st_closing->getBagian->nm_bagian }},&nbsp;
																Divisi : 	
																{{ $st_closing->getDivisi->nm_devisi }}
																@endif	
															</td>
															<td>
																@if($st_closing->status_closing == 'Close')
																	<font color="red">{{ $st_closing->status_closing }}</font>
																@else
																	<font color="35C30F">{{ $st_closing->status_closing }}</font>
																@endif
															</td>
															<td>{{ $st_closing->ket }}</td>	
															<td>
																<a href="{{ url('detail-closing/'.$closing->id) }}">
																	<span class="badge bg-red">Detail</span>
																</a>
															</td>
            
															<td>
																<button type="button" class="btn btn-primary" onclick="tambahSClosing('{{ $closing->id }}');" title="Follow Up"><i class="fa  fa-sticky-note-o"></i></button>
																<form action="{{ url('hapus-closing/'.$closing->id) }}" method="post">
																{{ csrf_field() }}
																<input type="hidden" name="_method" value="put"/>
																<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data closing ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
																</form>
															</td>
														</tr>
														@endif
													@endforeach
												@endforeach
											</tbody>
										</table>
									</div>
									<!-- /.box body -->
								</div>
								<!-- /.collapsed-box -->
								@endforeach
						@else
							<div>
								<p> Isi dulu data rencana marketing !!!</p>
							</div>
							@endif
                        </div>
                        <!-- /.tab-1-pane -->
						
						 <div class="tab-pane active" id="tab_2">
							</br>
							<div class="col-md-12">
									<label style="font-size: 15px">Pelaksanaan Marketing - Closing Jasa Tahun {{now()->year }} </label>
							</div>
							</br></br>
							
							@if(!empty($data_rm))
								@foreach($data_rm->sortBy('id') as $rm)
								<div class="box box-default collapsed-box">
									<div class="box-header with-border">
										<h1 class="box-title">
											<b>{{ $rm->bulan}}</b>
										</h1>
											@if ((!empty ($rm->tahun) && ($rm->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahClosingJasa()" title="Tambah Closing Marketing"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
									</div>
									<div class="box-body">	
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal</th>
													<th>Nama Customer</th>
													<th>Nama Barang</th>
													<th>Closing Via</th>
													<th>Pesan Closing</th>
													<th>Respon Customer</th>
													<th>Hasil Closing</th>
													<th>Follow up Ke</th>
													<th>Status </th>
													<th>Keterangan</th>
													<th>Histori</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php($i=1)
												@foreach($data_closing_jasa as $closing)
													@foreach($status_closing as $st_closing)
														@if($st_closing->id_closing == $closing->id )
														<tr>
															<td>{{ $i++ }}</td>
															<td>{{ date('d-m-Y h:i:s', strtotime($st_closing->created_at ))}} </td>
															<td>{{ $closing->getKlien->nm_klien }}</td>
															<td>
																@if(!empty($closing->getJasa->nm_jasa))
																{{ $closing->getJasa->nm_jasa }}
																@endif
															</td>
															<td>{{ $st_closing->tool_closing }}</td>
															<td>{{ $st_closing->content_closing }}</td>
															<td>{{ $st_closing->respon_klien }}</td>
															<td>{{ $st_closing->hasil_akhir }}</td>
										
															<td> 
																@if($st_closing->id_bagian !== 0 AND $st_closing->id_divisi !== 0)
																Departemen : &nbsp;	
																{{ $st_closing->getBagian->nm_bagian }},&nbsp;
																Divisi : 	
																{{ $st_closing->getDivisi->nm_devisi }}
																@endif	
															</td>
															<td>
																@if($st_closing->status_closing == 'Close')
																	<font color="red">{{ $st_closing->status_closing }}</font>
																@else
																	<font color="35C30F">{{ $st_closing->status_closing }}</font>
																@endif
															</td>
															<td>{{ $st_closing->ket }}</td>	
															<td>
																<a href="{{ url('detail-closing/'.$closing->id) }}">
																	<span class="badge bg-red">Detail</span>
																</a>
															</td>
                                        	
															<td>
																<button type="button" class="btn btn-primary" onclick="tambahSClosing('{{ $closing->id }}');" title="Follow Up"><i class="fa  fa-sticky-note-o"></i></button>
																<form action="{{ url('hapus-closing/'.$closing->id) }}" method="post">
																{{ csrf_field() }}
																<input type="hidden" name="_method" value="put"/>
																<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data closing ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
																</form>
															</td>
														</tr>
														@endif
													@endforeach
												@endforeach
											</tbody>
										</table>
									</div>
									<!-- /.box body -->
								</div>
								<!-- /.collapsed-box -->
								@endforeach
						@else
							<div>
								<p> Isi dulu data rencana marketing !!!</p>
							</div>
							@endif
                        </div>
                        <!-- /.tab-2-pane -->
						
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
	@include('user.marketing.section.close.include.modal_closing')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
	<script>
		$(function () {
            $('.select2').select2();
        });
		
		$(document).ready(function () {
            var ids;	
		
			tambahClosingBrg = function () {
                $('#modal-tambah-ClosingBrg').modal('show');
            };
			tambahClosingJasa = function () {
                $('#modal-tambah-ClosingJasa').modal('show');
            };
			tambahSClosing = function (id) {
			//alert("test")
				$('[name="id_closing"]').val(id);
                $('#modal-tambah-SClosing').modal('show');
            };
		
		})		
		
	</script>
@stop