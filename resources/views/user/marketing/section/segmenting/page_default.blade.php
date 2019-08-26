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
            Segmenting
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><b>Demografis</b></a></li>
                        <li><a href="#tab_2" data-toggle="tab"><b>Geografis</b></a></li>
                        <li><a href="#tab_3" data-toggle="tab"><b>Psikografis</b></a></li>
                        <li><a href="#tab_4" data-toggle="tab"><b>Segmenting Barang</b></a></li>
						<li><a href="#tab_5" data-toggle="tab"><b>Segmenting Jasa</b></a></li>
                    </ul>
                    <div class="tab-content">
						<div class="tab-pane active" id="tab_1">
                            <p><b>Tambah</b></p>
                            <table class="table table-striped">
								<tbody>
									<tr>
										<th style="width: 30px">Kategori Demografis</th>
										<th style="width: 30px">Sub Kategori Demografis</th>
										<th style="width: 30px">Sub Sub Kategori Demografis</th>
										<th style="width: 10px">Proses</th>
									</tr>
									<tr>
										@foreach ($data_sg as $value)
									
										<form role="form" action="{{ url('store-segmenting') }}" method="post">
										<td>
											 <input type="hidden" name="id_segmenting" value="{{ $value->id }}" class="form-control"/>
											 <input type="text" name="item_sub_segmenting" class="form-control"/>
										</td>
										<td>
											 <input type="text" name="item_subsub_segmenting" class="form-control"/>
										</td>
										<td>
											 <input type="text" name="content_segmenting" class="form-control"/>
										</td>
										<td>
											{{ csrf_field() }}
											<button type="submit" class="btn btn-primary">Simpan</button>
										</td>
										</form>
										@endforeach
									</tr>
								</tbody>
							</table>
							
							<!--tampian inputna di atas segmenting-->
							<table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Segmenting</th>
                                    <th>Klasifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_subsg as $subsg)
									@if($subsg->getSegmenting->id == 1)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
											@if(!empty($subsg->getSegmenting->item_segmenting))
											{{ $subsg->getSegmenting->item_segmenting }}
											@endif
										</td>
                                        <td>
												@if(!empty($subsg->item_sub_segmenting))
												{{ $subsg->item_sub_segmenting }} 
												@endif	
												@if(!empty($subsg->getSubSubSegmenting->item_subsub_segmenting))
													--> {{ $subsg->getSubSubSegmenting->item_subsub_segmenting }} 	
												@endif
												@if(!empty($subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting))
													--> {{ $subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting }} 	
												@endif
                                        </td>
                                       <td>
											<form action="{{ url('hapus-segmenting/'.$subsg->id) }}" method="post">
												<a href="{{ url('ubah-segmenting/'.$subsg->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
												<button type="button" class="btn btn-primary" onclick="tambahSegBarang('{{ $subsg->getSubSubSegmenting->getContentSegmenting->id }}');" title="Tambah Segmentasi Barang"><i class="fa fa-plus"></i></button>
												
												<button type="button" class="btn btn-success" onclick="tambahSegJasa('{{ $subsg->getSubSubSegmenting->getContentSegmenting->id }}');" title="Tambah Segmentasi Jasa"><i class="fa fa-plus"></i></button>

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
                        <!-- /.tab-1-pane -->
						
						<div class="tab-pane" id="tab_2">
                            <p><b>Tambah</b></p>
                            <table class="table table-striped">
								<tbody>
									<tr>
										<th style="width: 30px">Kategori Geografis</th>
										<th style="width: 30px">Sub Kategori Geografis</th>
										<th style="width: 30px">Sub Sub Kategori Geografis</th>
										<th style="width: 10px">Proses</th>
									</tr>
									<tr>
										@foreach ($data_sg_geo as $value)
									
										<form role="form" action="{{ url('store-segmenting') }}" method="post">
										<td>
											 <input type="hidden" name="id_segmenting" value="{{ $value->id }}" class="form-control"/>
											 <input type="text" name="item_sub_segmenting" class="form-control"/>
										</td>
										<td>
											 <input type="text" name="item_subsub_segmenting" class="form-control"/>
										</td>
										<td>
											 <input type="text" name="content_segmenting" class="form-control"/>
										</td>
										<td>
											{{ csrf_field() }}
											<button type="submit" class="btn btn-primary">Simpan</button>
										</td>
										</form>
										@endforeach
									</tr>
								</tbody>
							</table>
							
							<!--tampian inputna di atas segmenting-->
							<table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Segmenting</th>
                                    <th>Klasifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_subsg as $subsg)
									@if($subsg->getSegmenting->id == 2)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
										@if(!empty($subsg->getSegmenting->item_segmenting))
										{{ $subsg->getSegmenting->item_segmenting }}
										@endif
										</td>
                                        <td>
												@if(!empty($subsg->item_sub_segmenting))
												{{ $subsg->item_sub_segmenting }} 
												@endif
												
												@if(!empty($subsg->getSubSubSegmenting->item_subsub_segmenting))
													--> {{ $subsg->getSubSubSegmenting->item_subsub_segmenting }} 	
												@endif
												@if(!empty($subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting))
													--> {{ $subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting }} 	
												@endif
                                        </td>
                                       <td>
											<form action="{{ url('hapus-segmenting/'.$subsg->id) }}" method="post">
												<a href="{{ url('ubah-segmenting/'.$subsg->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
												<button type="button" class="btn btn-primary" onclick="tambahSegBarangGeo('{{ $subsg->getSubSubSegmenting->getContentSegmenting->id }}');" title="Tambah Segmentasi Barang"><i class="fa fa-plus"></i></button>
												
												<button type="button" class="btn btn-success" onclick="tambahSegJasaGeo('{{ $subsg->getSubSubSegmenting->getContentSegmenting->id }}');" title="Tambah Segmentasi Jasa"><i class="fa fa-plus"></i></button>

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
                        <!-- /.tab-2-pane -->
						
						<div class="tab-pane" id="tab_3">
                            <p><b>Tambah</b></p>
                            <table class="table table-striped">
								<tbody>
									<tr>
										<th style="width: 30px">Kategori Psikografis</th>
										<th style="width: 30px">Sub Kategori Psikografis</th>
										<th style="width: 30px">Sub Sub Kategori Psikografis</th>
										<th style="width: 10px">Proses</th>
									</tr>
									<tr>
										@foreach ($data_sg_psi as $value)
									
										<form role="form" action="{{ url('store-segmenting') }}" method="post">
										<td>
											 <input type="hidden" name="id_segmenting" value="{{ $value->id }}" class="form-control"/>
											 <input type="text" name="item_sub_segmenting" class="form-control"/>
										</td>
										<td>
											 <input type="text" name="item_subsub_segmenting" class="form-control"/>
										</td>
										<td>
											 <input type="text" name="content_segmenting" class="form-control"/>
										</td>
										<td>
											{{ csrf_field() }}
											<button type="submit" class="btn btn-primary">Simpan</button>
										</td>
										</form>
										@endforeach
									</tr>
								</tbody>
							</table>
							
							<!--tampian inputna di atas segmenting-->
							<table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Segmenting</th>
                                    <th>Klasifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_subsg as $subsg)
									@if($subsg->getSegmenting->id == 3)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
											@if(!empty($subsg->getSegmenting->item_segmenting))
											{{ $subsg->getSegmenting->item_segmenting }}
										@endif
										</td>
                                        <td>
												@if(!empty($subsg->item_sub_segmenting))
												{{ $subsg->item_sub_segmenting }} 
												@endif
												
												@if(!empty($subsg->getSubSubSegmenting->item_subsub_segmenting))
													--> {{ $subsg->getSubSubSegmenting->item_subsub_segmenting }} 	
												@endif
												@if(!empty($subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting))
													--> {{ $subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting }} 	
												@endif
                                        </td>
                                       <td>
											<form action="{{ url('hapus-segmenting/'.$subsg->id) }}" method="post">
												<a href="{{ url('ubah-segmenting/'.$subsg->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
												<button type="button" class="btn btn-primary" onclick="tambahSegBarangPsi('{{ $subsg->getSubSubSegmenting->getContentSegmenting->id }}');" title="Tambah Segmentasi Barang"><i class="fa fa-plus"></i></button>
												
												<button type="button" class="btn btn-success" onclick="tambahSegJasaPsi('{{ $subsg->getSubSubSegmenting->getContentSegmenting->id }}');" title="Tambah Segmentasi Jasa"><i class="fa fa-plus"></i></button>

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
                        <!-- /.tab-3-pane -->
						
						<!--- hasil segmenting Barang---->
						
						<div class="tab-pane" id="tab_4">
                            <div class="col-md-12">
								<label style="font-size: 15px">Tampilkan Berdasarkan Tahun</label>
							</div>
							<div class="col-md-12" style="padding-top: 5px">
								<form action="{{ url('cari-hasilsg-brg') }}" method="post" style="width: 100%">
									<div class="input-group input-group-md" >
										{{ csrf_field() }}
										<select class="form-control select2" style="width: 100%;" name="tahun_cari" required>
										@if(empty($select_tahun_brg))
											<option>Hasil Segmentasi Barang masih kosong</option>
										@else
											<option>Pilih Tahun</option>
											@foreach($select_tahun_brg as $value)
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
								<h4><b>Hasil Segmentasi Barang Tahun 
								{{ now()->year }}
								</b></h4>
							</div>
							</br></br></br>
							
							<table id="example4" class="table table-bordered table-striped">
								<tr>
                                    <th colspan="5"><font color="#E42217"><b>Segmentasi Demografis</b></font></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Segmentasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                                
                                <tbody>
                                @php($i=1)
									@foreach($data_hasilsg_brg as $hasilsg_brg)	
										@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1) 
                                    <tr>
                                       <td>{{ $i++ }}</td>
									   <!--<td>{{ $hasilsg_brg->tahun }}</td>-->
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
                                       </td>
									   <td> {{ $hasilsg_brg->hasil_segmenting }} </td>
                                       <td>
											<button type="button" class="btn btn-warning" onclick="ubahHasilSegmentingDemog('{{ $hasilsg_brg->id }}');" title="Ubah Hasil Segmentasi Barang"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
									@endif
									@endforeach
                                </tbody>
                            </table>
							<!--barang : Geografi-->
							</br></br>
							<table id="example5" class="table table-bordered table-striped">
                                <tr>
                                    <th colspan="5"><font color="#E42217"><b>Segmentasi Geografis</b></font></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Segmentasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                                <tbody>
                                @php($i=1)
									@foreach($data_hasilsg_brg as $hasilsg_brg)	
									@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
                                    <tr>
                                       <td>{{ $i++ }}</td>
									    <!--<td>{{ $hasilsg_brg->tahun }}</td>-->
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
                                       </td>
									   <td> {{ $hasilsg_brg->hasil_segmenting }} </td>
                                       <td>
											<button type="button" class="btn btn-warning" onclick="ubahHasilSegmentingGeog('{{ $hasilsg_brg->id }}');" title="Ubah Hasil Segmentasi Barang"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
									@endif
									@endforeach
                                </tbody>
                            </table>
							
							<!--barang : Psikografis-->
							</br></br>
							<table id="example6" class="table table-bordered table-striped">
                                <tr>
                                    <th colspan="5"><font color="#E42217"><b>Segmentasi Psikografis</b></font></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Segmentasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                                <tbody>
                                @php($i=1)
									@foreach($data_hasilsg_brg as $hasilsg_brg)	
									@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
                                    <tr>
                                       <td>{{ $i++ }}</td>
									   <!--<td>{{ $hasilsg_brg->tahun }}</td>-->
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
                                       </td>
									   <td> {{ $hasilsg_brg->hasil_segmenting }} </td>
                                       <td>
											<button type="button" class="btn btn-warning" onclick="ubahHasilSegmentingPsi('{{ $hasilsg_brg->id }}');" title="Ubah Hasil Segmentasi Barang"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
									@endif
									@endforeach
                                </tbody>
                            </table>
						</div>
                        <!-- /.tab-4-pane -->
						
						<!--- hasil segmenting Jasa---->
						
						<div class="tab-pane" id="tab_5">
                            
							<div class="col-md-12">
								<label style="font-size: 15px">Tampilkan Berdasarkan Tahun</label>
							</div>
							<div class="col-md-12" style="padding-top: 5px">
								<form action="{{ url('cari-hasilsg-jasa') }}" method="post" style="width: 100%">
									<div class="input-group input-group-md" >
										{{ csrf_field() }}
										<select class="form-control select2" style="width: 100%;" name="tahun_cari" required>
										@if(empty($select_tahun_jasa))
											<option>Hasil Segmentasi Jasa masih kosong</option>
										@else
											<option>Pilih Tahun</option>
											@foreach($select_tahun_jasa as $value)
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
								<h4><b>Hasil Segmentasi Jasa Tahun 
								{{ now()->year }}
								</b></h4>
							</div>
							</br></br></br>
							
							<table id="example7" class="table table-bordered table-striped">
                                <tr>
                                    <th colspan="5"><font color="#E42217"><b>Segmentasi Demografis</b></font></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Jasa</th>
                                    <th>Segmentasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                                
                                <tbody>
                                @php($i=1)
									@foreach($data_hasilsg_jasa as $hasilsg_jasa)	
									@if($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
                                    <tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_jasa->getJasa->nm_jasa }}</td>
                                       <td>
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
										{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->content_segmenting }}
										@endif
                                       </td>
									   <td> {{ $hasilsg_jasa->hasil_segmenting }} </td>
                                       <td>
											<button type="button" class="btn btn-warning" onclick="ubahHasilSegmentingDemog('{{ $hasilsg_jasa->id }}');" title="Ubah Hasil Segmentasi Barang"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
									@endif
									@endforeach
                                </tbody>
                            </table>
							</br></br>
							<!-- Jasa : Geografi -->
							
							<table id="example8" class="table table-bordered table-striped">
                                <tr>
                                    <th colspan="5"><font color="#E42217"><b>Segmentasi Geografis</b></font></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Jasa</th>
                                    <th>Segmentasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                                <tbody>
                                @php($i=1)
									@foreach($data_hasilsg_jasa as $hasilsg_jasa)	
									@if($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 2)
                                    <tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_jasa->getJasa->nm_jasa }}</td>
                                       <td>
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
										{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->content_segmenting }}
										@endif
                                       </td>
									   <td> {{ $hasilsg_jasa->hasil_segmenting }} </td>
                                       <td>
											<button type="button" class="btn btn-warning" onclick="ubahHasilSegmentingGeog('{{ $hasilsg_jasa->id }}');" title="Ubah Hasil Segmentasi Barang"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
									@endif
									@endforeach
                                </tbody>
                            </table>
							
							<!-- Jasa : Psikografis -->
							</br></br>
							<table id="example9" class="table table-bordered table-striped">
                                <tr>
                                    <th colspan="5"><font color="#E42217"><b>Segmentasi Psikografis</b></font></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Jasa</th>
                                    <th>Segmentasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                                <tbody>
                                @php($i=1)
									@foreach($data_hasilsg_jasa as $hasilsg_jasa)	
									@if($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 3)
                                    <tr>
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $hasilsg_jasa->getJasa->nm_jasa }}</td>
                                       <td>
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
										{{$hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
										@endif
										@if(!empty($hasilsg_jasa->getContentSegmenting->content_segmenting))
										-> {{ $hasilsg_jasa->getContentSegmenting->content_segmenting }}
										@endif
                                       </td>
									   <td> {{ $hasilsg_jasa->hasil_segmenting }} </td>
                                       <td>
											<button type="button" class="btn btn-warning" onclick="ubahHasilSegmentingPsi('{{ $hasilsg_jasa->id }}');" title="Ubah Hasil Segmentasi Barang"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
									@endif
									@endforeach
                                </tbody>
                            </table>
						</div>
                        <!-- /.tab-5-pane -->
					</div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
 @include('user.marketing.section.segmenting.include.modal')
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
           
		   //===========Demografis========//
		   
            tambahSegBarang  = function (id) {
			//alert("test")
				$('[name="id_content_segmenting"]').val(id);
                $('#modal-tambah-SegBarang').modal('show');
            };
			
			tambahSegJasa  = function (id) {
			//alert("test")
				$('[name="id_content_segmenting"]').val(id);
                $('#modal-tambah-SegJasa').modal('show');
            };
			
			//===========Geografis========//
			
			tambahSegBarangGeo  = function (id) {
			//alert("test")
				$('[name="id_content_segmenting"]').val(id);
                $('#modal-tambah-SegBarangGeo').modal('show');
            };
			tambahSegJasaGeo  = function (id) {
			//alert("test")
				$('[name="id_content_segmenting"]').val(id);
                $('#modal-tambah-SegJasaGeo').modal('show');
            };
			
			//===========psikografis========//
			
			tambahSegBarangPsi  = function (id) {
			//alert("test")
				$('[name="id_content_segmenting"]').val(id);
                $('#modal-tambah-SegBarangPsi').modal('show');
            };
			
			tambahSegJasaPsi  = function (id) {
			//alert("test")
				$('[name="id_content_segmenting"]').val(id);
                $('#modal-tambah-SegJasaPsi').modal('show');
            };
			
			//ubah hasil segmenting brg dan jasa
				//Demografis 
			ubahHasilSegmentingDemog = function (id) {
                $.ajax({
                    url: '{{ url('ubah-hasil-segmenting-demog') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
						
                        $('[name="hasil_segmenting_ubah"]').val(result.data_hasilsg.hasil_segmenting);
                        $('[name="id_hasil_segmenting"]').val(result.data_hasilsg.id);
                        $('#modal-ubah-hasil-segmenting-demog').modal('show');
                    }
                })
            };
				//Geografis
			ubahHasilSegmentingGeog = function (id) {
                $.ajax({
                    url: '{{ url('ubah-hasil-segmenting-geog') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
						
                        $('[name="hasil_segmenting_ubah"]').val(result.data_hasilsg.hasil_segmenting);
                        $('[name="id_hasil_segmenting"]').val(result.data_hasilsg.id);
                        $('#modal-ubah-hasil-segmenting-geog').modal('show');
                    }
                })
            };
				//Psikografis
			ubahHasilSegmentingPsi = function (id) {
                $.ajax({
                    url: '{{ url('ubah-hasil-segmenting-psi') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
						
                        $('[name="hasil_segmenting_ubah"]').val(result.data_hasilsg.hasil_segmenting);
                        $('[name="id_hasil_segmenting"]').val(result.data_hasilsg.id);
                        $('#modal-ubah-hasil-segmenting-psi').modal('show');
                    }
                })
            };
        })
    </script>
@stop


