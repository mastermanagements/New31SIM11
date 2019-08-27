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
            Targeting
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><b>Targeting Barang</b></a></li>
						<li><a href="#tab_2" data-toggle="tab"><b>Hasil Targeting Barang</b></a></li>
                        <li><a href="#tab_3" data-toggle="tab"><b>Targeting Jasa</b></a></li>
                        <li><a href="#tab_4" data-toggle="tab"><b>Hasil Targeting Jasa</b></a></li>
                    </ul>
                    <div class="tab-content">
						<div class="tab-pane active" id="tab_1">
                            <p><b>Menentukan Targeting Barang</b></p>
							<table class="table table-striped">
								<tbody>
									<tr>
										<th style="width: 50px">Segmenting</th>
										<th style="width: 30px">Pola Targeting</th>
										
									</tr>
									<tr>
										<form role="form" action="{{ url('store-targeting') }}" method="post">
										<td>
											 <select class="form-control select2" style="width: 100%;" 	name="id_hasil_segmenting" required>
												@if(empty($data_hasilsg_brg))
													<option>Data hasil segmenting Belum di isi</option>
												@else
													<option>Pilih: Barang -> Segmenting</option>
													@foreach($data_hasilsg_brg as $hasilsg_brg)
													<option value="{{ $hasilsg_brg->id }}">
													{{ $hasilsg_brg->getBarang->nm_barang }} =>
													<b>{{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->item_segmenting }} </b>->
													{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting 
													}}  	 	
													@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
													-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
													@endif
													@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
													{{ $hasilsg_brg->getContentSegmenting->content_segmenting }} 
													@endif
													-> {{ $hasilsg_brg->hasil_segmenting }}
													</option>
													@endforeach
												@endif
											</select> 
										</td>
									
										<td> 
											<select class="form-control select2" style="width: 100%;"name="id_pola_targeting" required>
													<option>Pilih Pola Targeting</option>
													@foreach($data_pola_targeting as $pola_targeting)
													<option value="{{ $pola_targeting->id }}">{{ $pola_targeting->nm_pola_targeting }}</option>
													@endforeach
											</select> 
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-striped">
							<p><b>Jawablah pertanyaan berikut yang sesuai dengan keadaan perusahaan Anda. Setiap satu pertanyaan, anda harus memilih satu jawaban (Yes / No). Anda harus menjawab semua pertanyaan</b></p>
								<tbody>	
								@php($i=1)
									<tr>
										<th style="width: 10px">No</th>
										<th style="width: 60px">Pertanyaan</th>
										<th style="width: 40px">Jawaban</th>
									</tr>
									@foreach($pertanyaan_targeting as $pertanyaan_t)
									<tr>
										<td>{{ $i++ }}</td>
										<td> 
											{{ $pertanyaan_t->pertanyaan_kriteria }}
											<input type="hidden" name="id_pertanyaan_targeting[]" value="{{$pertanyaan_t->id}}">	
										</td>
										<td> 
											<input type="checkbox" name="jawaban_kriteria[]" value="1">&nbsp;Yes&nbsp;
											<input type="checkbox" name="jawaban_kriteria[]" value="0">&nbsp;No&nbsp;
										</td>
									</tr>
									@endforeach									
								</tbody>
							</table>		
							
							<table class="table table-striped">
								<tbody>	
									<tr>
										<td align="right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary">Simpan</button>
										</td>
									</tr>
									</form>
								</tbody>
							</table>			
							
                        </div>
                        <!-- /.tab-pane -->
						
						<!--- hasil segmenting Barang---->
						<div class="tab-pane" id="tab_2">  
							<p><b>Hasil Targeting Barang</b></p></br>
							
							<p><font color="#E42217"><b>Segmentasi Demografis</b></font></p></br>
							<table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil Segmentasi</th>
									<th>Pola Targeting</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($hasil_targeting as  $targeting)
									@foreach($data_hasilsg_brg as $hasilsg_brg)	
									  @if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
										@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
									<tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_brg->getBarang->nm_barang }}</td>
                                       <td>
										@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
										{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@endif
										@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
										@endif
										-> {{ $hasilsg_brg->hasil_segmenting }}
                                       </td>
									   <td> {{ $targeting->getPolaTargeting->nm_pola_targeting }}</td>			
										<td>   
											<form action="{{ url('hapus-targeting/'.$targeting->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data Targeting barang ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
										</td>
                                    </tr>
										@endif
										@endif
									@endforeach
								@endforeach
                                </tbody>
                            </table>
							<!-- /.table-->
							<p><font color="#E42217"><b>Segmentasi Geografis</b></font></p></br>
							<table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil Segmentasi</th>
									<th>Pola Targeting</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($hasil_targeting as  $targeting)
									@foreach($data_hasilsg_brg as $hasilsg_brg)	
									  @if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
										@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
									<tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_brg->getBarang->nm_barang }}</td>
                                       <td>
										@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
										{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@endif
										@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
										@endif
										-> {{ $hasilsg_brg->hasil_segmenting }}
                                       </td>
									   <td> {{ $targeting->getPolaTargeting->nm_pola_targeting }}</td>			
										<td>   
											<form action="{{ url('hapus-targeting/'.$targeting->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data Targeting barang ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
										</td>
                                    </tr>
										@endif
										@endif
									@endforeach
								@endforeach
                                </tbody>
                            </table>
							<!-- /.table-->
							
							<p><font color="#E42217"><b>Segmentasi Psikografis</b></font></p></br>
							<table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil Segmentasi</th>
									<th>Pola Targeting</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($hasil_targeting as  $targeting)
									@foreach($data_hasilsg_brg as $hasilsg_brg)	
									  @if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
										@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
									<tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_brg->getBarang->nm_barang }}</td>
                                       <td>
										@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
										{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										@endif
										-> {{ $hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
										@endif
										-> {{ $hasilsg_brg->hasil_segmenting }}
                                       </td>
									   <td> {{ $targeting->getPolaTargeting->nm_pola_targeting }}</td>			
										<td>   
											<form action="{{ url('hapus-targeting/'.$targeting->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data Targeting barang ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
										</td>
                                    </tr>
										@endif
										@endif
									@endforeach
								@endforeach
                                </tbody>
                            </table>
						</div>
                        <!-- /.tab-pane -->
						<!-- targeting jasa -->
						<div class="tab-pane" id="tab_3">
                            <p><b>Menentukan Targeting Jasa</b></p>
							<table class="table table-striped">
								<tbody>
									<tr>
										<th style="width: 50px">Segmenting</th>
										<th style="width: 30px">Pola Targeting</th>
										
									</tr>
									<tr>
										<form role="form" action="{{ url('store-targeting') }}" method="post">
										<td>
											 <select class="form-control select2" style="width: 100%;" 			name="id_hasil_segmenting" required>
												@if(empty($data_hasilsg_jasa))
													<option>Data hasil segmenting Belum di isi</option>
												@else
													<option>Pilih: Barang -> Segmenting</option>
													@foreach($data_hasilsg_jasa as $hasilsg_jasa)
													<option value="{{ $hasilsg_jasa->id }}">
													<b>{{ $hasilsg_jasa->getJasa->nm_jasa }}</b> =>
													{{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->item_segmenting }} ->
													{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting 
													}}  	 	
													@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
													-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
													@endif
													@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
													{{ $hasilsg_jasa->getContentSegmenting->content_segmenting }} 
													@endif
													-> {{ $hasilsg_jasa->hasil_segmenting }}
													</option>
													@endforeach
												@endif
											</select> 
										</td>
									
										<td> 
											<select class="form-control select2" style="width: 100%;"name="id_pola_targeting" required>
													<option>Pilih Pola Targeting</option>
													@foreach($data_pola_targeting as $pola_targeting)
													<option value="{{ $pola_targeting->id }}">{{ $pola_targeting->nm_pola_targeting }}</option>
													@endforeach
											</select> 
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-striped">
							<p><b>Jawablah pertanyaan berikut yang sesuai dengan keadaan perusahaan Anda. Setiap satu pertanyaan, anda harus memilih satu jawaban (Yes / No). Anda harus menjawab semua pertanyaan</b></p>
								<tbody>	
								@php($i=1)
									<tr>
										<th style="width: 10px">No</th>
										<th style="width: 60px">Pertanyaan</th>
										<th style="width: 40px">Jawaban</th>
									</tr>
									@foreach($pertanyaan_targeting as $pertanyaan_t)
									<tr>
										<td>{{ $i++ }}</td>
										<td> 
											{{ $pertanyaan_t->pertanyaan_kriteria }}
											<input type="hidden" name="id_pertanyaan_targeting[]" value="{{$pertanyaan_t->id}}">	
										</td>
										<td> 
											<input type="checkbox" name="jawaban_kriteria[]" value="1">&nbsp;Yes&nbsp;
											<input type="checkbox" name="jawaban_kriteria[]" value="0">&nbsp;No&nbsp;
										</td>
									</tr>
									@endforeach									
								</tbody>
							</table>		
							
							<table class="table table-striped">
								<tbody>	
									<tr>
										<td align="right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary">Simpan</button>
										</td>
									</tr>
									</form>
								</tbody>
							</table>			
							
                        </div>
                        <!-- /.tab-pane -->
						
						<!-- hasil targeting jasa -->
						<div class="tab-pane" id="tab_4">  
						
							<p><b>Hasil Targeting Jasa</b></p></br>
							<p><font color="#E42217"><b>Segmentasi Demografis</b></font></p></br>
							<table id="example4" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil Segmentasi</th>
									<th>Pola Targeting</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($hasil_targeting as  $targeting)
									@foreach($data_hasilsg_jasa as $hasilsg_jasa)	
									  @if($hasilsg_jasa->id == $targeting->id_hasil_segmenting )
										@if($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
									<tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_jasa->getJasa->nm_jasa }}</td>
                                       <td>
										{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->content_segmenting }}
										@endif
										-> {{ $hasilsg_jasa->hasil_segmenting }}
                                       </td>
									   <td> {{ $targeting->getPolaTargeting->nm_pola_targeting }}</td>			
										<td>   
											<form action="{{ url('hapus-targeting/'.$targeting->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data Targeting Jasa ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
										</td>
                                    </tr>
										@endif
										@endif
									@endforeach
								@endforeach
                                </tbody>
                            </table>
							<!-- /.table -->
							
							<p><font color="#E42217"><b>Segmentasi Geografis</b></font></p></br>
							<table id="example5" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil Segmentasi</th>
									<th>Pola Targeting</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($hasil_targeting as  $targeting)
									@foreach($data_hasilsg_jasa as $hasilsg_jasa)	
									  @if($hasilsg_jasa->id == $targeting->id_hasil_segmenting )
										@if($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
									<tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_jasa->getJasa->nm_jasa }}</td>
                                       <td>
										{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->content_segmenting }}
										@endif
										-> {{ $hasilsg_jasa->hasil_segmenting }}
                                       </td>
									   <td> {{ $targeting->getPolaTargeting->nm_pola_targeting }}</td>			
										<td>   
											<form action="{{ url('hapus-targeting/'.$targeting->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data Targeting Jasa ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
										</td>
                                    </tr>
										@endif
										@endif
									@endforeach
								@endforeach
                                </tbody>
                            </table>
							<!-- /.table -->
							
							<p><font color="#E42217"><b>Segmentasi Psikografis</b></font></p></br>
							<table id="example6" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil Segmentasi</th>
									<th>Pola Targeting</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($hasil_targeting as  $targeting)
									@foreach($data_hasilsg_jasa as $hasilsg_jasa)	
									  @if($hasilsg_jasa->id == $targeting->id_hasil_segmenting )
										@if($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
									<tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_jasa->getJasa->nm_jasa }}</td>
                                       <td>
										{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->content_segmenting }}
										@endif
										-> {{ $hasilsg_jasa->hasil_segmenting }}
                                       </td>
									   <td> {{ $targeting->getPolaTargeting->nm_pola_targeting }}</td>			
										<td>   
											<form action="{{ url('hapus-targeting/'.$targeting->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data Targeting Jasa ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
										</td>
                                    </tr>
										@endif
										@endif
									@endforeach
								@endforeach
                                </tbody>
                            </table>
						</div>
                        <!-- /.tab-4-pane -->
					</div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
