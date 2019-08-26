@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
	
	<link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Pelaksanaan Marketing - Delight
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
						<li class="active"><a href="#tab_1" data-toggle="tab">Barang Off Line</a></li>
						<li><a href="#tab_2" data-toggle="tab">Barang On Line</a></li>
						<li><a href="#tab_3" data-toggle="tab">Jasa Off Line</a></li>
						<li><a href="#tab_4" data-toggle="tab">Jasa On Line</a></li>
					</ul>
                    <div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<div class="col-md-12">
									<label style="font-size: 15px">Pelaksanaan Marketing - Delight Tahun {{now()->year }}</label>
							</div>
							</br></br>
							
							<!--Convert Barang Off Line-->
							@if(!empty($data_rm_off))
								@foreach($data_rm_off as $rm_off)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h1 class="box-title">
											<b>{{ $rm_off->bulan}}</b>
											</h1>
											@if ((!empty ($rm_off->tahun) && ($rm_off->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<table id="example1" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Pekerjaan</th>
														<th>Nama Barang</th>
														<th>Sasaran Klien </th>
														<th>Media Marketing</th>
														<th>Content </th>
														<th>Tema </th>
														<th>Kegiatan Marketing</th>
														<th>Leads Per Campaign</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												@php($i=1)
													
												@foreach ($data_rm_fase_b as $rm_fase_b)
													@foreach($pel_marketing as $pel_markets)
														@if($rm_fase_b->id_rm == $rm_off->id)
															@if($rm_fase_b->id == $pel_markets->id_rm_fase) 
																@if($rm_fase_b->fase_marketing == "Convert (Branding)")
																	<tr>
																		<td>{{ $pel_markets->id}}</td>
																		<td>{{ date('d-m-Y h:i:s', strtotime($pel_markets->created_at ))}} </td>
																				
																		<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
																				{{ $rm_fase_b->getBarang->nm_barang }}
																			@endif
																		</td>
																		<td>
																			@foreach($data_sasaran as $sasaran)
																				@if($rm_fase_b->id == $sasaran->id_rm_fase)
																					@php($sasaran_k=$sasaran->sasaran_klien)
																					{{ $sasaran_k }}</br>
																				@endif
																			@endforeach
																				
																		</td>
																		<td>
																			{{ $rm_fase_b->getMediaMarketing->media_marketing}}
																			@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
																				-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
																			@endif
																		</td>
																		<td>
																			@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
																			{{ $rm_fase_b->getContentMarketing->content_marketing}} 
																			@endif
																		</td>
																		<td>{{ $pel_markets->tema_content }}</td>
																				
																		<td>
																			@foreach($keg_market_harian as $km_harian)	
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					{{ $km_harian->getKegMarketing->jenis_keg_marketing }}</br>
																				@endif
																			@endforeach
																		</td>
																		<td>
																			@if(!empty($data_respon_leads))
																				@foreach($data_respon_leads as $respon_leads)
																					@if($respon_leads->id_pel_m == $pel_markets->id)
																						@php($like = $respon_leads->sum('jum_like'))
																						{{ $like }}
																					@endif
																				@endforeach
																			@endif
																		</td>
																		<td>
																			@foreach($keg_market_harian as $km_harian)
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					@if($km_harian->getKegMarketing->jenis_keg_marketing == "Publish")
																						<button type="button" class="btn btn-primary" onclick="tambahResponConvert('{{ $pel_markets->id }}');" title="Tambah Respon Leads"><i class="fa fa-plus"></i></button>
																					@endif
																				@endif
																			@endforeach
																		</td>
																	</tr>
																@endif
															@endif
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
                        <!-- /.tab_1-pane-->
						
						<!---tab_2: Convert Barang On Line-->
						<div class="tab-pane" id="tab_2">
							<div class="col-md-12">
									<label style="font-size: 15px">Pelaksanaan Marketing - Convert Tahun {{now()->year }}</label>
							</div>
							</br></br>
							
							<!---Convert Barang On line --->
							@if(!empty($data_rm_on))
								@foreach($data_rm_on as $rm_on)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h1 class="box-title">
											<b>{{ $rm_on->bulan}}</b>
											</h1>
											@if ((!empty ($rm_on->tahun) && ($rm_on->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<table id="example2" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Pekerjaan</th>
														<th>Nama Barang</th>
														<th>Sasaran Klien </th>
														<th>Media Marketing</th>
														<th>Content </th>
														<th>Tema </th>
														<th>Kegiatan Marketing</th>
														<th>Leads Per Campaign</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												@php($i=1)
													
												@foreach ($data_rm_fase_b as $rm_fase_b)
													@foreach($pel_marketing as $pel_markets)
														@if($rm_fase_b->id_rm == $rm_on->id)
															@if($rm_fase_b->id == $pel_markets->id_rm_fase) 
																@if($rm_fase_b->fase_marketing == "Convert (Branding)")
																	<tr>
																		<td>{{ $pel_markets->id}}</td>
																		<td>{{ date('d-m-Y h:i:s', strtotime($pel_markets->created_at ))}} </td>
																				
																		<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
																				{{ $rm_fase_b->getBarang->nm_barang }}
																			@endif
																		</td>
																		<td>
																			@foreach($data_sasaran as $sasaran)
																				@if($rm_fase_b->id == $sasaran->id_rm_fase)
																					@php($sasaran_k=$sasaran->sasaran_klien)
																					{{ $sasaran_k }}</br>
																				@endif
																			@endforeach
																				
																		</td>
																		<td>
																			{{ $rm_fase_b->getMediaMarketing->media_marketing}}
																			@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
																				-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
																			@endif
																		</td>
																		<td>
																			@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
																			{{ $rm_fase_b->getContentMarketing->content_marketing}} 
																			@endif
																		</td>
																		<td>{{ $pel_markets->tema_content }}</td>
																				
																		<td>
																			@foreach($keg_market_harian as $km_harian)	
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					{{ $km_harian->getKegMarketing->jenis_keg_marketing }}</br>
																				@endif
																			@endforeach
																		</td>
																		<td>
																			@if(!empty($data_respon_leads))
																				@foreach($data_respon_leads as $respon_leads)
																					@if($respon_leads->id_pel_m == $pel_markets->id)
																						@php($like = $respon_leads->sum('jum_like'))
																						{{ $like }}
																					@endif
																				@endforeach
																			@endif
																		</td>
																		<td>
																			@foreach($keg_market_harian as $km_harian)
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					@if($km_harian->getKegMarketing->jenis_keg_marketing == "Publish")
																						<button type="button" class="btn btn-primary" onclick="tambahResponConvert('{{ $pel_markets->id }}');" title="Tambah Respon Leads"><i class="fa fa-plus"></i></button>
																					@endif
																				@endif
																			@endforeach
																		</td>
																	</tr>
																@endif
															@endif
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
                        <!-- /.tab_2-pane-->
						
						<!--Convert Jasa Off Line-->
						<div class="tab-pane" id="tab_3">
							<div class="col-md-12">
									<label style="font-size: 15px">Pelaksanaan Marketing - Convert Tahun {{now()->year }}</label>
							</div>
							</br></br>
							@if(!empty($data_rm_off))
								@foreach($data_rm_off as $rm_off)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h1 class="box-title">
											<b>{{ $rm_off->bulan}}</b>
											</h1>
											@if ((!empty ($rm_off->tahun) && ($rm_off->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<table id="example3" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Pekerjaan</th>
														<th>Nama Barang</th>
														<th>Sasaran Klien </th>
														<th>Media Marketing</th>
														<th>Content </th>
														<th>Tema </th>
														<th>Kegiatan Marketing</th>
														<th>Leads Per Campaign</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												@php($i=1)
													
												@foreach ($data_rm_fase_j as $rm_fase_j)
													@foreach($pel_marketing as $pel_markets)
														@if($rm_fase_j->id_rm == $rm_off->id)
															@if($rm_fase_j->id == $pel_markets->id_rm_fase) 
																@if($rm_fase_j->fase_marketing == "Convert (Branding)")
																	<tr>
																		<td>{{ $pel_markets->id}}</td>
																		<td>{{ date('d-m-Y h:i:s', strtotime($pel_markets->created_at ))}} </td>
																				
																		<td> @if(!empty($rm_fase_j->getBarang->nm_barang))
																				{{ $rm_fase_j->getBarang->nm_barang }}
																			@endif
																		</td>
																		<td>
																			@foreach($data_sasaran as $sasaran)
																				@if($rm_fase_j->id == $sasaran->id_rm_fase)
																					@php($sasaran_k=$sasaran->sasaran_klien)
																					{{ $sasaran_k }}</br>
																				@endif
																			@endforeach
																				
																		</td>
																		<td>
																			{{ $rm_fase_j->getMediaMarketing->media_marketing}}
																			@if(!empty($rm_fase_j->getSubMediaMarketing->submedia_marketing))
																				-->{{ $rm_fase_j->getSubMediaMarketing->submedia_marketing}} 
																			@endif
																		</td>
																		<td>
																			@if(!empty($rm_fase_j->getContentMarketing->content_marketing))
																			{{ $rm_fase_j->getContentMarketing->content_marketing}} 
																			@endif
																		</td>
																		<td>{{ $pel_markets->tema_content }}</td>
																				
																		<td>
																			@foreach($keg_market_harian as $km_harian)	
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					{{ $km_harian->getKegMarketing->jenis_keg_marketing }}</br>
																				@endif
																			@endforeach
																		</td>
																		<td>
																			@if(!empty($data_respon_leads))
																				@foreach($data_respon_leads as $respon_leads)
																					@if($respon_leads->id_pel_m == $pel_markets->id)
																						@php($like = $respon_leads->sum('jum_like'))
																						{{ $like }}
																					@endif
																				@endforeach
																			@endif
																		</td>
																		<td>
																			@foreach($keg_market_harian as $km_harian)
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					@if($km_harian->getKegMarketing->jenis_keg_marketing == "Publish")
																						<button type="button" class="btn btn-primary" onclick="tambahResponConvert('{{ $pel_markets->id }}');" title="Tambah Respon Leads"><i class="fa fa-plus"></i></button>
																					@endif
																				@endif
																			@endforeach
																		</td>
																	</tr>
																@endif
															@endif
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
                        <!-- /.tab_3-pane-->
						
						<!---Convert Jasa On line --->
						<div class="tab-pane" id="tab_4">
							<div class="col-md-12">
									<label style="font-size: 15px">Pelaksanaan Marketing - Convert Tahun {{now()->year }}</label>
							</div>
							</br></br>
							@if(!empty($data_rm_on))
								@foreach($data_rm_on as $rm_on)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h1 class="box-title">
											<b>{{ $rm_on->bulan}}</b>
											</h1>
											@if ((!empty ($rm_on->tahun) && ($rm_on->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<table id="example4" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Pekerjaan</th>
														<th>Nama Barang</th>
														<th>Sasaran Klien </th>
														<th>Media Marketing</th>
														<th>Content </th>
														<th>Tema </th>
														<th>Kegiatan Marketing</th>
														<th>Leads Per Campaign</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												@php($i=1)
													
												@foreach ($data_rm_fase_j as $rm_fase_j)
													@foreach($pel_marketing as $pel_markets)
														@if($rm_fase_j->id_rm == $rm_on->id)
															@if($rm_fase_j->id == $pel_markets->id_rm_fase) 
																@if($rm_fase_j->fase_marketing == "Convert (Branding)")
																	<tr>
																		<td>{{ $pel_markets->id}}</td>
																		<td>{{ date('d-m-Y h:i:s', strtotime($pel_markets->created_at ))}} </td>
																				
																		<td> @if(!empty($rm_fase_j->getBarang->nm_barang))
																				{{ $rm_fase_j->getBarang->nm_barang }}
																			@endif
																		</td>
																		<td>
																			@foreach($data_sasaran as $sasaran)
																				@if($rm_fase_j->id == $sasaran->id_rm_fase)
																					@php($sasaran_k=$sasaran->sasaran_klien)
																					{{ $sasaran_k }}</br>
																				@endif
																			@endforeach
																				
																		</td>
																		<td>
																			{{ $rm_fase_j->getMediaMarketing->media_marketing}}
																			@if(!empty($rm_fase_j->getSubMediaMarketing->submedia_marketing))
																				-->{{ $rm_fase_j->getSubMediaMarketing->submedia_marketing}} 
																			@endif
																		</td>
																		<td>
																			@if(!empty($rm_fase_j->getContentMarketing->content_marketing))
																			{{ $rm_fase_j->getContentMarketing->content_marketing}} 
																			@endif
																		</td>
																		<td>{{ $pel_markets->tema_content }}</td>
																				
																		<td>
																			@foreach($keg_market_harian as $km_harian)	
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					{{ $km_harian->getKegMarketing->jenis_keg_marketing }}</br>
																				@endif
																			@endforeach
																		</td>
																		<td>
																			@if(!empty($data_respon_leads))
																				@foreach($data_respon_leads as $respon_leads)
																					@if($respon_leads->id_pel_m == $pel_markets->id)
																						@php($like = $respon_convert->sum('jum_like'))
																						{{ $like }}
																					@endif
																				@endforeach
																			@endif
																		</td>
																		<td>
																			@foreach($keg_market_harian as $km_harian)
																				@if($km_harian->id_pel_m == $pel_markets->id) 
																					@if($km_harian->getKegMarketing->jenis_keg_marketing == "Publish")
																						<button type="button" class="btn btn-primary" onclick="tambahResponConvert('{{ $pel_markets->id }}');" title="Tambah Respon Leads"><i class="fa fa-plus"></i></button>
																					@endif
																				@endif
																			@endforeach
																		</td>
																	</tr>
																@endif
															@endif
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
                        <!-- /.tab_4-pane-->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
			<!--md12--->
        </div>
		<!--row--->
    </section>
    <!-- /.content -->
</div>
@include('user.marketing.section.pelaksanaan_marketing.convert.modal_respon_convert')
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script>
		$(function () {
            $('.select2').select2();
        });
		
		$(document).ready(function () {
            var ids;		
			
			tambahResponConvert = function (id) {
			//alert("test")
				$('[name="id_pel_m"]').val(id);
                $('#modal-tambah-ResponConvert').modal('show');
            };
		})
	 </script>
@stop
