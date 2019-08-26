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
           Rencana & Kegiatan Marketing
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
							<form action="{{ url('tambah-rmbj') }}" method=post>
							{{ csrf_field() }}
							<input type="hidden" name="off_on" value="0">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Rencana Marketing Barang Off Line</button>
							</form>
                            <p></p>
                            <div class="col-md-12">
								<label style="font-size: 15px">Rencana Marketing Barang Off Line Berdasarkan Tahun</label>
							</div>
							<div class="col-md-12" style="padding-top: 5px">
								<form action="{{ url('cari-rmbj') }}" method="post" style="width: 100%">
									<div class="input-group input-group-md" >
										{{ csrf_field() }}
										<select class="form-control select2" style="width: 100%;" name="tahun_cari" required>
										@if(empty($tahun_rm_off))
											<option>Rencana Marketing Barang masih kosong</option>
										@else
											<option>Pilih Tahun</option>
											@foreach($tahun_rm_off as $value)
												<option value="{{ $value->tahun }}">
													{{ $value->tahun }}
												</option>
											@endforeach
										@endif
										</select>
										<span class="input-group-btn">
											<button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
										</span>
									</div>
								</form>
							</div>
							</br></br></br></br>
							<div class="col-md-12">
									<label style="font-size: 15px">Rencana Marketing Barang Off Line Tahun {{now()->year }}</label>
							</div>
							</br></br>
							
							<!---rencana marketing per tahun now--->
							
							@foreach($data_rm_off as $rm_off)
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h5 class="box-title">
											<b>{{ $rm_off->bulan}}</b>
											</h5>
											@if ((!empty ($rm_off->tahun) && ($rm_off->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahRMB('{{ $rm_off->id }}')" title="Tambah Rencana Marketing Barang Off Line"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-box-tool" onclick="tambahTargetAudience('{{ $rm_off->id }}');" title="Tambah Target Audience"><i class="fa-plus-square-o"></i></button>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<div class="callout callout-info">
												<h4>Target Audience</h4>
												@foreach($data_rm_stp as $rm_stp)
												@if($rm_off->id == $rm_stp->id_rm)
													
												<p><font color="#0000"><b>Demografi</b></font></p>
												
													@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
														@endif
														@endif
													@endforeach
												@endforeach	
												
												<p><font color="#0000"><b>Geografis</b></font></p>
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach		
												
												<p><font color="#0000"><b>Psikografis</b></font></p>
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach
											@endif
											@endforeach
											</div>
										</div>
										<div class="box-body">
											<!--Attract-->
											<table id="example1" class="table table-bordered table-striped">
													<tr>
														<th colspan="8"><font color="#E42217"><b>Attract (Pengenalan)</b></font></th>
													</tr>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Barang</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												
												<tbody>
												@php($i=1)
												@foreach ($data_rm_fase_b as $rm_fase_b)
													@if($rm_fase_b->fase_marketing == 'Attract (Pengenalan)')
													<tr>
														<td>{{ $rm_fase_b->id }}</td>
														
														<td>{{ date('d-m-Y', strtotime($rm_fase_b->tgl_rencana_terbit ))}} </td>
														
														<td>{{ $rm_fase_b->fase_marketing }}</td>
														<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
															{{ $rm_fase_b->getBarang->nm_barang }}
															 @endif
														</td>
														<td>{{ $rm_fase_b->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
														{{ $rm_fase_b->getContentMarketing->content_marketing}} 
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
															<form action="{{ url('hapus-rmbj/'.$rm_fase_b->id) }}" method="post">
																<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_b->id }}')" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
															</form>											
														</td>
													</tr>
													@endif
												@endforeach	
												</tbody>
											</table>
											<!--end Attract-->
											<br>
											<!--Convert-->
											<table id="example1" class="table table-bordered table-striped">
													<tr>
														<th colspan="8"><font color="#E42217"><b>Convert (Branding)</b></font></th>
													</tr>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Barang</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												
												<tbody>
												@php($i=1)
												@foreach ($data_rm_fase_b as $rm_fase_b)
													@if($rm_fase_b->fase_marketing == 'Convert (Branding)')
													<tr>
														<td>{{ $rm_fase_b->id }}</td>
														
														<td>{{ date('d-m-Y', strtotime($rm_fase_b->tgl_rencana_terbit ))}} </td>
														
														<td>{{ $rm_fase_b->fase_marketing }}</td>
														<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
															{{ $rm_fase_b->getBarang->nm_barang }}
															 @endif
														</td>
														<td>{{ $rm_fase_b->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
														{{ $rm_fase_b->getContentMarketing->content_marketing}} 
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
															<form action="{{ url('hapus-rmbj/'.$rm_fase_b->id) }}" method="post">
																<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_b->id }}')" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
															</form>											
														</td>
													</tr>
													@endif
												@endforeach	
												</tbody>
											</table>
											<!--end convert-->
											<br>
											
											<!--Delight-->
											<table id="example1" class="table table-bordered table-striped">
													<tr>
														<th colspan="8"><font color="#E42217"><b>Delighting (Pemeliharaan)</b></font></th>
													</tr>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Barang</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												
												<tbody>
												@php($i=1)
												@foreach ($data_rm_fase_b as $rm_fase_b)
													@if($rm_fase_b->fase_marketing == 'Delighting (Pemeliharaan)')
													<tr>
														<td>{{ $rm_fase_b->id }}</td>
														
														<td>{{ date('d-m-Y', strtotime($rm_fase_b->tgl_rencana_terbit ))}} </td>
														
														<td>{{ $rm_fase_b->fase_marketing }}</td>
														<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
															{{ $rm_fase_b->getBarang->nm_barang }}
															 @endif
														</td>
														<td>{{ $rm_fase_b->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
														{{ $rm_fase_b->getContentMarketing->content_marketing}} 
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
															<form action="{{ url('hapus-rmbj/'.$rm_fase_b->id) }}" method="post">
																<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_b->id }}')" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
															</form>											
														</td>
													</tr>
													@endif
												@endforeach	
												</tbody>
											</table>
											<!--end delight-->
											<br>
											
											<!--Evaluating-->
											<table id="example1" class="table table-bordered table-striped">
													<tr>
														<th colspan="8"><font color="#E42217"><b>Evaluating (Evaluasi)</b></font></th>
													</tr>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Barang</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												
												<tbody>
												@php($i=1)
												@foreach ($data_rm_fase_b as $rm_fase_b)
													@if($rm_fase_b->fase_marketing == 'Evaluating (Evaluasi)')
													<tr>
														<td>{{ $rm_fase_b->id }}</td>
														
														<td>{{ date('d-m-Y', strtotime($rm_fase_b->tgl_rencana_terbit ))}} </td>
														
														<td>{{ $rm_fase_b->fase_marketing }}</td>
														<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
															{{ $rm_fase_b->getBarang->nm_barang }}
															 @endif
														</td>
														<td>{{ $rm_fase_b->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
														{{ $rm_fase_b->getContentMarketing->content_marketing}} 
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
															<form action="{{ url('hapus-rmbj/'.$rm_fase_b->id) }}" method="post">
																<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_b->id }}')" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
															</form>											
														</td>
													</tr>
													@endif
												@endforeach	
												</tbody>
											</table>
											<!--end evaluating-->
										</div>
										<!-- /.box body -->
									</div>
									<!-- /.collapsed-box -->
							@endforeach	
                        </div>
                        <!-- /.tab_1-pane-->
						
						<!---tab_2 Rencana Marketing Barang On Line-->
						<div class="tab-pane" id="tab_2">
							<form action="{{ url('tambah-rmbj') }}" method=post>
								{{ csrf_field() }}
								<input type="hidden" name="off_on" value="1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Rencana Marketing Barang On Line</button>
							</form>
                            <p></p>
                            <div class="col-md-12">
								<label style="font-size: 15px">Rencana Marketing Barang On Line Berdasarkan Tahun</label>
							</div>
							<div class="col-md-12" style="padding-top: 5px">
								<form action="{{ url('cari-rmbj') }}" method="post" style="width: 100%">
									<div class="input-group input-group-md" >
										{{ csrf_field() }}
										<select class="form-control select2" style="width: 100%;" name="tahun_cari" required>
										@if(empty($tahun_rm_on))
											<option>Rencana Marketing Barang masih kosong</option>
										@else
											<option>Pilih Tahun</option>
											@foreach($tahun_rm_on as $value)
												<option value="{{ $value->tahun }}">
													{{ $value->tahun }}
												</option>
											@endforeach
										@endif
										</select>
										<span class="input-group-btn">
											<button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
										</span>
									</div>
								</form>
							</div>
							</br></br></br></br>
							<div class="col-md-12">
									<label style="font-size: 15px">Rencana Marketing Barang On Line Tahun {{now()->year }}</label>
							</div>
							</br></br>

							<!---rencana marketing per tahun now--->
							
							@foreach($data_rm_on as $rm_on)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h5 class="box-title">
											<b>{{ $rm_on->bulan}}</b>
											</h5>
											@if ((!empty ($rm_on->tahun) && ($rm_on->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahRMB('{{ $rm_on->id }}')" title="Tambah Rencana Marketing Barang Off Line"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-box-tool" onclick="tambahTargetAudience('{{ $rm_on->id }}');" title="Tambah Target Audience"><i class="fa-plus-square-o"></i></button>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<div class="callout callout-info">
												<h4>Target Audience</h4>
												@foreach($data_rm_stp as $rm_stp)
												@if($rm_off->id == $rm_stp->id_rm)
													
												<p><font color="#0000"><b>Demografi</b></font></p>
												
													@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)
														@if($rm_stp->id_targeting == $targeting->id)	
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
														@endif
														@endif
													@endforeach
												@endforeach		
												<p><font color="#0000"><b>Geografis</b></font></p>
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach		
												<p><font color="#0000"><b>Psikografis</b></font></p>
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach
											@endif
											@endforeach
											</div>
											
										</div>
										<div class="box-body">
											<table id="example2" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Barang</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													
													@foreach ($data_rm_fase_b as $rm_fase_b)
														@if($rm_fase_b->id_rm == $rm_on->id)
													<tr>
														<td>{{ $i++ }}</td>
														<td>{{ date('d-m-Y', strtotime($rm_fase_b->tgl_rencana_terbit ))}} </td>
														<td>{{ $rm_fase_b->fase_marketing }}</td>
														<td> @if(!empty($rm_fase_b->getBarang->nm_barang))
															{{ $rm_fase_b->getBarang->nm_barang }}
															 @endif
														</td>
														<td>{{ $rm_fase_b->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_b->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_b->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_b->getContentMarketing->content_marketing))
														{{ $rm_fase_b->getContentMarketing->content_marketing}} 
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
															<form action="{{ url('hapus-rmbj/'.$rm_fase_b->id) }}" method="post">
															<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_b->id }}');" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
												
															</form>											
														</td>
													</tr>	
													@endif
												@endforeach
												</tbody>
											</table>	
										</div>
										<!-- /.box body -->
									</div>
									<!-- /.collapsed-box -->
							@endforeach	
                        </div>
                        <!-- /.tab-pane 2 -->
						
						<!--RM Jasa Off Line-->
						 
						<div class="tab-pane" id="tab_3">
							<form action="{{ url('tambah-rmbj') }}" method=post>
							{{ csrf_field() }}
							<input type="hidden" name="off_on" value="0">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Rencana Marketing Jasa Off Line</button>
							</form>
                            <p></p>
                            <div class="col-md-12">
								<label style="font-size: 15px">Rencana Marketing Jasa Off Line Berdasarkan Tahun</label>
							</div>
							<div class="col-md-12" style="padding-top: 5px">
								<form action="{{ url('cari-rmbj') }}" method="post" style="width: 100%">
									<div class="input-group input-group-md" >
										{{ csrf_field() }}
										<select class="form-control select2" style="width: 100%;" name="tahun_cari" required>
										@if(empty($tahun_rm_off))
											<option>Rencana Marketing Jasa masih kosong</option>
										@else
											<option>Pilih Tahun</option>
											@foreach($tahun_rm_off as $value)
												<option value="{{ $value->tahun }}">
													{{ $value->tahun }}
												</option>
											@endforeach
										@endif
										</select>
										<span class="input-group-btn">
											<button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
										</span>
									</div>
								</form>
							</div>
							</br></br></br></br>
							<div class="col-md-12">
									<label style="font-size: 15px">Rencana Marketing Jasa Off Line Tahun {{now()->year }}</label>
							</div>
							</br></br>
							
							<!---rencana marketing per tahun now--->
							
							@foreach($data_rm_off as $rm_off)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h5 class="box-title">
											<b>{{ $rm_off->bulan}}</b>
											</h5>
											@if ((!empty ($rm_off->tahun) && ($rm_off->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahRMJ('{{ $rm_off->id }}')" title="Tambah Rencana Marketing Barang Off Line"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-box-tool" onclick="tambahTargetAudience('{{ $rm_off->id }}');" title="Tambah Target Audience"><i class="fa-plus-square-o"></i></button>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<div class="callout callout-info">
												<h4>Target Audience</h4>
												@foreach($data_rm_stp as $rm_stp)
												@if($rm_off->id == $rm_stp->id_rm)
													
												<p><font color="#0000"><b>Demografi</b></font></p>
												
													@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
														@endif
														@endif
													@endforeach
												@endforeach	
												
												<p><font color="#0000"><b>Geografis</b></font></p>
												
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach		
												
												<p><font color="#0000"><b>Psikografis</b></font></p>
												
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach
											@endif
											@endforeach
											</div>
											
											</div>
										<div class="box-body">
											<table id="example3" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Jasa</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													
													@foreach ($data_rm_fase_j as $rm_fase_j)
														@if($rm_fase_j->id_rm == $rm_off->id)
													<tr>
														<td>{{ $i++ }}</td>
														<td>{{ date('d-m-Y', strtotime($rm_fase_j->tgl_rencana_terbit ))}} </td>
														<td>{{ $rm_fase_j->fase_marketing }}</td>
														<td>@if(!empty($rm_fase_j->getJasa->nm_jasa))
															{{ $rm_fase_j->getJasa->nm_jasa }}
															@endif
														</td>
														<td>{{ $rm_fase_j->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_j->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_j->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_j->getContentMarketing->content_marketing))
														{{ $rm_fase_j->getContentMarketing->content_marketing}} 
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
															<form action="{{ url('hapus-rmbj/'.$rm_fase_j->id) }}" method="post">
															<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_j->id }}');" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
												
															</form>											
														</td>
													</tr>	
														@endif
													@endforeach
												</tbody>
											</table>	
										</div>
										<!-- /.box body -->
									</div>
									<!-- /.collapsed-box -->
							@endforeach	
                        </div>
                        <!-- /.tab_3-pane-->
						
						<!--RM Jasa On Line-->
						 
						<div class="tab-pane" id="tab_4">
							<form action="{{ url('tambah-rmbj') }}" method=post>
							{{ csrf_field() }}
							<input type="hidden" name="off_on" value="0">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Rencana Marketing Jasa On Line</button>
							</form>
                            <p></p>
                            <div class="col-md-12">
								<label style="font-size: 15px">Rencana Marketing Jasa On Line Berdasarkan Tahun</label>
							</div>
							<div class="col-md-12" style="padding-top: 5px">
								<form action="{{ url('cari-rmbj') }}" method="post" style="width: 100%">
									<div class="input-group input-group-md" >
										{{ csrf_field() }}
										<select class="form-control select2" style="width: 100%;" name="tahun_cari" required>
										@if(empty($tahun_rm_on))
											<option>Rencana Marketing Jasa masih kosong</option>
										@else
											<option>Pilih Tahun</option>
											@foreach($tahun_rm_on as $value)
												<option value="{{ $value->tahun }}">
													{{ $value->tahun }}
												</option>
											@endforeach
										@endif
										</select>
										<span class="input-group-btn">
											<button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
										</span>
									</div>
								</form>
							</div>
							</br></br></br></br>
							<div class="col-md-12">
									<label style="font-size: 15px">Rencana Marketing Jasa On Line Tahun {{now()->year }}</label>
							</div>
							</br></br>
							
							<!---rencana marketing per tahun now--->
							
							@foreach($data_rm_on as $rm_on)
								
									<div class="box box-default collapsed-box">
										<div class="box-header with-border">
											<h5 class="box-title">
											<b>{{ $rm_on->bulan}}</b>
											</h5>
											@if ((!empty ($rm_on->tahun) && ($rm_on->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" onclick="tambahRMJ('{{ $rm_on->id }}')" title="Tambah Rencana Marketing Barang Off Line"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-box-tool" onclick="tambahTargetAudience('{{ $rm_on->id }}');" title="Tambah Target Audience"><i class="fa-plus-square-o"></i></button>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
										</div>
										<div class="box-body">
											<div class="callout callout-info">
												<h4>Target Audience</h4>
												@foreach($data_rm_stp as $rm_stp)
												@if($rm_on->id == $rm_stp->id_rm)
													
												<p><font color="#0000"><b>Demografi</b></font></p>
												
													@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
														@endif
														@endif
													@endforeach
												@endforeach	
												
												<p><font color="#0000"><b>Geografis</b></font></p>
												
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach		
												
												<p><font color="#0000"><b>Psikografis</b></font></p>
												
												@foreach ($hasil_targeting as  $targeting)
													@foreach($data_hasilsg_brg as $hasilsg_brg)	
														@if($rm_stp->id_targeting == $targeting->id)
														@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
														@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
														<p>@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
														{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
														@endif
														@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
														-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
														@endif
														-> {{ $hasilsg_brg->hasil_segmenting }} 
														</p>		
															@endif
															@endif
														@endif
													@endforeach
												@endforeach
											@endif
											@endforeach
											</div>
											
											</div>
										<div class="box-body">
											<table id="example4" class="table table-bordered table-striped">
											<thead>
													<tr>
														<th>No.</th>
														<th>Tanggal Terbit</th>
														<th>Fase Marketing</th>
														<th>Nama Jasa</th>
														<th>Media</th>
														<th>Content Marketing</th>
														<th>Sasaran Klien </th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													@php($i=1)
													
													@foreach ($data_rm_fase_j as $rm_fase_j)
														@if($rm_fase_j->id_rm == $rm_on->id)
													<tr>
														<td>{{ $i++ }}</td>
														<td>{{ date('d-m-Y', strtotime($rm_fase_j->tgl_rencana_terbit ))}} 
														<td>{{ $rm_fase_j->fase_marketing }}</td>
														<td>@if(!empty($rm_fase_j->getJasa->nm_jasa))
															{{ $rm_fase_j->getJasa->nm_jasa }}
															@endif
														</td>
														<td>{{ $rm_fase_j->getMediaMarketing->media_marketing}}
														@if(!empty($rm_fase_j->getSubMediaMarketing->submedia_marketing))
														-->{{ $rm_fase_j->getSubMediaMarketing->submedia_marketing}} 
														@endif
														</td>
														<td>
														@if(!empty($rm_fase_j->getContentMarketing->content_marketing))
														{{ $rm_fase_j->getContentMarketing->content_marketing}} 
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
														</td>
														<td>	
															<form action="{{ url('hapus-rmbj/'.$rm_fase_j->id) }}" method="post">
															<button type="button" class="btn btn-primary" onclick="tambahKM('{{ $rm_fase_j->id }}');" title="Tambah Kegiatan Marketing"><i class="fa fa-plus"></i></button>
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="put"/>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
												
															</form>											
														</td>
													</tr>	
														@endif
													@endforeach
												</tbody>
											</table>	
										</div>
										<!-- /.box body -->
									</div>
									<!-- /.collapsed-box -->
							@endforeach	
                        </div>
                        <!-- /.tab_4-pane-->
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
	@include('user.marketing.section.rencana_marketing.include.modal_RM')
	@include('user.marketing.section.rencana_marketing.include.modal_KM')
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
			
			// Rencana Marketing (RM)//
			tambahRMB = function (id) {
			   $.ajax({
				   url : '{{ url('getdataRM') }}/'+id,
				   dataType : 'json',
				   success : function (result) {
					   console.log(result);
					   if(result.data.off_on==0){
						  $('#md_0').show();
						  $('#select_md1').attr('disabled',true);
						  $('#md_1').hide();
					   }else{
						   $('#md_0').hide();
						   $('#select_md0').attr('disabled',true);
						   $('#md_1').show();
					   }
					   $('[name="id_rm"]').val(id)
					   $('#modal-tambah-RMB').modal('show')   
				   }
			   })
			}
			
			tambahRMJ = function (id) {
			   $.ajax({
				   url : '{{ url('getdataRM') }}/'+id,
				   dataType : 'json',
				   success : function (result) {
					   console.log(result);
					   if(result.data.off_on==0){
						  $('#md_00').show();
						  $('#md_11').hide();
					   }else{
						   $('#md_00').hide();
						   $('#md_11').show();
					   }
					   $('[name="id_rm"]').val(id)
					   $('#modal-tambah-RMJ').modal('show')   
				   }
			   })
			}
			
			tambahTargetAudience = function (id) {
			//alert("test")
				$('[name="id_rm"]').val(id);
                $('#modal-tambah-TargetAudience').modal('show');
            };
			
			tambahKM = function (id) {
			   $.ajax({
				   url : '{{ url('getdataKM') }}/'+id,
				   dataType : 'json',
				   success : function (result) {
					   //console.log(result);
					   //$('[name="id_rm_fase"]').val(result.data.id)
					   $('[name="id_rm_fase"]').val(id)
					   //$('#cek').val(result.data.nm_barang)
					   var checkbox="";
					   $.each(result.data, function(indx, value){
						 checkbox+='<label><input type="checkbox" name="id_keg_marketing[]" value="'+value.id+'">&nbsp;&nbsp;['+value.jenis_keg_marketing+']&nbsp;&nbsp;=>&nbsp;&nbsp;'+value.keg_marketing+'</label><br>';
					   })
					   $('#id_keg_marketing').html(checkbox);
					   $('#modal-tambah-KM').modal('show')   
					   
				   }
			   })
			}
			
			
			$('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
			});
			
			$('#datepicker2').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
			});
			
			$('#datepicker3').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
			});
			
			$('#datepicker4').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
			});
			
		})
	 </script>
@stop
