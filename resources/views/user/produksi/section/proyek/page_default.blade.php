@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proyek
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
                      <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Proyek </a></li>
                      <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Tim Proyek</a></li>
                      <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Jadwal Proyek </a></li>
                      <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Progres Proyek </a></li>
					  <li class="@if(Session::get('tab5') == 'tab5') active @else '' @endif"><a href="#tab_5" data-toggle="tab"><i class="fa fa-book"></i> Pemeliharaan Proyek </a></li>
					  <li class="@if(Session::get('tab6') == 'tab6') active @else '' @endif"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i></a></li>
					</ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-proyek') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Proyek </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-proyek') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <select class="form-control select2" style="width: 100%;" name="id_spk" required>
                                                @if(empty($spk))
                                                    <option>Spk masih kosong</option>
                                                @else
                                                    @foreach($spk as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($proyeks))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan jual jasa </h4></div>
                                @else
                                    @foreach($proyeks as $value)
                                        <div class="col-md-12">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                <div class="box-tools pull-right">
                                                    <form action="{{ url('delete-proyek/'.$value->id) }}" method="post">
                                                        <a href="{{ url('ubah-proyek/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah proyek"><i class="fa fa-pencil"></i>
                                                        </a>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="btn btn-box-tool" title="hapus proyek"><i class="fa fa-eraser"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3 style="color: #0b93d5; margin-top: 0px"><u>{{ $value->spk->getKlien->nm_klien }}</u> </h3>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                            <h4 style="font-weight: bold">Rincian Klien</h4>
                                                            <p>Perusahaan : {{ $value->spk->getKlien->nm_perusahaan }}</p>
                                                            <p>Alamat : {{ $value->spk->getKlien->alamat }}</p>
                                                            <p>No. Handphone : {{ $value->spk->getKlien->hp}}</p>
                                                                <p style="font-weight: bold">No. SPK : {{ $value->spk->no_spk }} </p>
                                                                <p>Nama SP K: {{ $value->spk->nm_spk }} </p>
                                                                <p>Jangka Waktu : {{ $value->jangka_waktu }} Hari</p>
                                                            </div>
                                                            <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                <p><h5 style="font-weight: bold">Detail Proyek : </h5> {!!  $value->rincian_proyek  !!} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    @endforeach
                                    {{ $proyeks->links() }}
                                @endif
                            </div>
                        </div>
						<!--./-end tab-1-->
						<div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
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
											<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Proyek & Tim Kerja</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1">
					
												<p></p>
												<div class="row">
													@if(empty($proyeks))
														<div class="col-md-12"> <h4 align="center">Anda belum menambahkan data proyek </h4></div>
													@else
														@foreach($proyeks as $value)
															<div class="col-md-12">
															<div class="box box-success box-solid">
																<div class="box-header with-border">
																	<h3 class="box-title">Tanggal dibuat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
															
																</div>
																<!-- /.box-header -->
																<div class="box-body">
																	<div class="row">
																		<div class="col-md-12">
																			<h3 style="color: #0b93d5; margin-top: 0px"><u>{{ $value->spk->getKlien->nm_klien }}</u> </h3>
																			<div class="row">
																				<div class="col-md-3">
																				<h4 style="font-weight: bold">Rincian Klien</h4>
																				<p>Perusahaan : {{ $value->spk->getKlien->nm_perusahaan }}</p>
																				<p>Alamat : {{ $value->spk->getKlien->alamat }}</p>
																				<p>No. Handphone : {{ $value->spk->getKlien->hp}}</p>
																					<p style="font-weight: bold">No. SPK : {{ $value->spk->no_spk }} </p>
																					<p>Nama SP K: {{ $value->spk->nm_spk }} </p>
																					<p>Jangka Waktu : {{ $value->jangka_waktu }} Hari</p>
																				</div>
																				<div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
																					<p><h5 style="font-weight: bold">Tim Produksi :  <button class="btn btn-xs btn-primary pull-right btnAddTim" value="{{ $value->id }}"><i class="fa fa-plus"></i> Tambah Tim</button> </h5>
																					<table class="table table-striped example2">
																						<tbody><tr>
																							<th style="width: 10px">#</th>
																							<th>Nama Karyawan</th>
																							<th>Jabatan</th>
																							<th style="width: 40px">Aksi</th>
																						</tr>
																						@php($i=1)
																						@if(!empty($value->timProyek))
																							@foreach($value->timProyek as $value)
																								<tr>
																									<td>{{ $i++ }}</td>
																									<td>{{ $value->karyawan->nama_ky }}</td>
																									<td>
																										{{ $value->jabatan_proyek }}
																									</td>
																									<td>

																										<form action="{{ url('delete-tim-proyek/'.$value->id) }}" method="post">
																										   {{ csrf_field() }}
																											<input type="hidden" name="_method" value="put">
																											<button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="badge bg-red" title="hapus tim proyek"><i class="fa fa-eraser"></i>
																											</button>
																										</form>
																									</td>
																								</tr>
																							@endforeach
																						@else
																							<tr>
																								<td colspan="2">Tim Belum dimasukan</td>
																							</tr>
																						@endif
																						</tbody>
																					</table>
																					</p>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- /.box-body -->
															</div>
															<!-- /.box -->
														</div>
														@endforeach
														{{ $proyeks->links() }}
													@endif
												</div>
											</div>

										</div>
										<!-- /.tab-content -->
									</div>
									<!-- nav-tabs-custom -->
								</div>
							</div>
						</div>
						<!--./-end tab-2-->
						<div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
						<div class="row">
							<div class="col-md-3" style="margin: 0">
                                <a href="{{ url('tambah-jadwal-proyek') }}" class="btn btn-primary" style="width: 100%" ><i class="fa fa-plus"></i> Tambah Jadwal Proyek </a>
								
                            </div>
							<div class="col-md-9" style="margin: 0" align="right">
                                <a href="#task_proyek" data-toggle="tab"><i class="fa fa-list"></i> Task Proyek</a></li>&nbsp;&nbsp;			
								<a href="#rincian_tugas" data-toggle="tab"><i class="fa fa-list"></i> Rincian Tugas</a></li>
                            </div>
                                                   
                        </div>
                        <p></p>
											<div class="row">
                                                    @if(empty($proyeks))
                                                        <div class="col-md-12"> <h4 align="center">Anda belum menambahkan data jadwal proyek </h4></div>
                                                    @else
                                                        @foreach($proyeks as $value)
                                                            <div class="col-md-12">
                                                                <div class="box box-success box-solid">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">Tanggal dibuat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                                        
                                                                    </div>
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3 style="color: #0b93d5; margin-top: 0px"><u></u> </h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <h4 style="font-weight: bold">Rincian Proyek
                                                                                        </h4>
                                                                                        <p>Nama Proyek : {{ $value->spk->nm_spk }}</p>
                                                                                        <p>No. SPK : {{ $value->spk->no_spk }}</p>
                                                                                        <hr>
                                                                                        <p>Klien : {{ $value->spk->getKlien->nm_klien }}</p>
                                                                                        <p>Nama Perusahaan : {{ $value->spk->getKlien->nm_perusahaan }}</p>
                                                                                        <p>Alamat : {{ $value->spk->getKlien->alamat }}</p>
                                                                                        <p>No.Hp : {{ $value->spk->getKlien->hp }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                                        <p><h5 style="font-weight: bold">Jadwal Proyek :   </h5>
                                                                                        <table class="table table-striped example2">
                                                                                            <tbody><tr>
                                                                                                <th style="width: 10px">#</th>
                                                                                                <th>Gugus Tugas</th>
                                                                                                <th>Durasi</th>
                                                                                                <th>Mulai</th>
                                                                                                <th>Selesai</th>
                                                                                                <th style="width: 40px">Aksi</th>
                                                                                            </tr>

                                                                                            @if(!empty($value->taks_proyek))
                                                                                                @php($i=1)
                                                                                                    @foreach($value->taks_proyek as $keys=> $value2)

                                                                                                    <tr>
                                                                                                        <td>{{ $i }}</td>
                                                                                                        <td> {{ $value2->nama_tugas }} </td>
                                                                                                        <td>{{ $value2->jadwal_proyek->sum('durasi') }}</td>
                                                                                                        <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek->sortBy('tgl_mulai')->groupBy('id_task_p')->take(1)->first()[0]['tgl_mulai'])) }}</td>
                                                                                                        <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek->sortByDesc('tgl_selesai')->groupBy('id_task_p')->take(1)->first()[0]['tgl_selesai'])) }}</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    @if(!empty($value2->rincian_tugas))
                                                                                                        @php($j=1)
                                                                                                        @foreach($value2->rincian_tugas as $key => $rincian_tugas)
                                                                                                            <tr>
                                                                                                                <td>{{ $i++.'.'.$j++ }}</td>
                                                                                                                <td>{{ $rincian_tugas->rincian_tugas }} </td>
                                                                                                               @if(!empty($value2->jadwal_proyek[$key]))
                                                                                                                <td>{{ $value2->jadwal_proyek[$key]->durasi }}</td>
                                                                                                                <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek[$key]->tgl_mulai)) }}</td>
                                                                                                                <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek[$key]->tgl_selesai)) }}</td>
                                                                                                                <td>
                                                                                                                   <form action="{{ url('delete-jadwal-proyek/'.$value2->jadwal_proyek[$key]->id) }}" method="post">
                                                                                                                       {{ csrf_field() }}
                                                                                                                       <a href="{{ url('ubah-jadwal-proyek/'.$value2->jadwal_proyek[$key]->id) }}" class="btn btn-xs btn-warning"><i class=" fa fa-edit"></i> </a>
                                                                                                                       <input type="hidden" name="_method" value="put">
                                                                                                                       <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda akan menghapus Jadwal ini')"><i class="fa fa-eraser"></i></button>
                                                                                                                   </form>
                                                                                                                </td>
                                                                                                                @else
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                @endif

                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                @endforeach
                                                                                                {{ $proyeks->links() }}
                                                                                            @else
                                                                                                <tr>
                                                                                                    <td colspan="2">Tim Belum dimasukan</td>
                                                                                                </tr>
                                                                                            @endif
                                                                                            </tbody>
                                                                                        </table>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.box-body -->
                                                                </div>
                                                                <!-- /.box -->
                                                            </div>
                                                        @endforeach
                                                        {{--{{ $data_jadwal->links() }}--}}
                                                    @endif
                                                </div>                         
						</div>
						<!--./-end tab-3-->
						<!--./task proyek-->
						<div class="tab-pane" id="task_proyek">
                            <div class="row">
								<div class="col-md-12">
									<div class="box box-primary">
										<div class="box-header with-border">
											<h3 class="box-title">Formulir Taks Proyek</h3>
											<h5 class="pull-right"><a href="{{ url('Proyek')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
										</div>
										<!-- /.box-header -->
										<!-- form start -->
										<form role="form" action="{{ url('store-taksproyek') }}" method="post" enctype="multipart/form-data">
											<div class="box-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Nama Tugas </label>
															<input type="text" class="form-control" name="nama_tugas" required>
															<!-- /.input group -->
															<small style="color: red">* Tidak Boleh Kosong</small>
														</div>

														<div class="form-group">
															<label for="exampleInputEmail1">Proyek</label>
															<select class="form-control select2" style="width: 100%;" name="id_proyek" required>
																@if(empty($proyeks))
																	<option>Anda Belum Memasukan data proyek </option>
																@else
																	  @foreach($proyeks as $value)
																		 <option value="{{ $value->id }}"> {{ $value->spk->nm_spk}}</option>
																	  @endforeach
																@endif
															</select>
															<small style="color: red">* Tidak Boleh Kosong</small>
														</div>
													</div>
												</div>
											</div>
											<!-- /.box-body -->

											<div class="box-footer">
												{{ csrf_field() }}
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tugas</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_taks_proyek as $value)
                                <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->nama_tugas }}</td>

                                <td>
                                    <form action="{{ url('hapus-taksproyek/'.$value->id) }}" method="post">
                                    <a href="{{ url('ubah-taksproyek/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus penjualan ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
						<!--./task-project-->
						<!--./rincian-tugas-->
						<div class="tab-pane" id="rincian_tugas">
                            <div class="row">
								<div class="col-md-12">
									<div class="box box-primary">
										<div class="box-header with-border">
											<h3 class="box-title">Formulir Rincian Tugas</h3>
										</div>
										<!-- /.box-header -->
										<!-- form start -->
										<form role="form" action="{{ url('store-rincian-tugas') }}" method="post" enctype="multipart/form-data">
											<div class="box-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for="exampleInputEmail1">Task Proyek</label>
															<select class="form-control select2" style="width: 100%;" name="id_task_p" required>
																@if(empty($data_taks_proyek))
																	<option>Taks Proyek masih kosong</option>
																@else
																	@foreach($data_taks_proyek as $value)
																		<option value="{{ $value->id }}">{{ $value->nama_tugas }}</option>
																	@endforeach
																@endif
															</select>
															<small style="color: red">* Tidak Boleh Kosong</small>
														</div>
														<div class="form-group">
															<label>Tincian Tugas</label>
															<textarea class="form-control" name="rincian_tugas"></textarea>
															<!-- /.input group -->
															<small style="color: red">* Tidak Boleh Kosong</small>
														</div>


													</div>
												</div>
											</div>
											<!-- /.box-body -->

											<div class="box-footer">
												{{ csrf_field() }}
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
                            <p></p>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tugas Proyek</th>
                                    <th>Rincian Tugas</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_rincian_proyek as $value)
                                <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->tugasProyek->nama_tugas }}</td>
                                <td>{{ $value->rincian_tugas }}</td>
                                <td>
                                    <form action="{{ url('hapus-rincian-tugas/'.$value->id) }}" method="post">
                                    <a href="{{ url('ubah-rincian-tugas/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus penjualan ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.rincian-tugas -->
						<!--/.tab4-->
						<div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
							<div class="row">
                                                    @if(empty($proyeks))
                                                        <div class="col-md-12"> <h4 align="center">Anda belum menambahkan data jadwal proyek </h4></div>
                                                    @else
                                                        @foreach($proyeks as $value)
                                                            <div class="col-md-12">
                                                                <div class="box box-success box-solid">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">Tanggal Proyek dibuat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                                        
                                                                    </div>
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3 style="color: #0b93d5; margin-top: 0px"><u></u> </h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <h4 style="font-weight: bold">Rincian Proyek
                                                                                        </h4>
                                                                                        <p>Nama Proyek : {{ $value->spk->nm_spk }}</p>
                                                                                        <p>No. SPK : {{ $value->spk->no_spk }}</p>
                                                                                        <hr>
                                                                                        <p>Klien : {{ $value->spk->getKlien->nm_klien }}</p>
                                                                                        <p>Nama Perusahaan : {{ $value->spk->getKlien->nm_perusahaan }}</p>
                                                                                        <p>Alamat : {{ $value->spk->getKlien->alamat }}</p>
                                                                                        <p>No.Hp : {{ $value->spk->getKlien->hp }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                                        <p><h5 style="font-weight: bold">Jadwal Proyek :   </h5>
                                                                                        <table class="table table-striped example2">
                                                                                            <tbody><tr>
                                                                                                <th style="width: 10px">#</th>
                                                                                                <th>Gugus Tugas</th>
                                                                                                <th>Durasi</th>
                                                                                                <th>Mulai</th>
                                                                                                <th>Selesai</th>
                                                                                                <th style="width: 40px">Aksi</th>
                                                                                            </tr>

                                                                                            @if(!empty($value->taks_proyek))
                                                                                                @php($i=1)
                                                                                                    @foreach($value->taks_proyek as $keys=> $value2)

                                                                                                    <tr>
                                                                                                        <td>{{ $i }}</td>
                                                                                                        <td> {{ $value2->nama_tugas }} </td>
                                                                                                        <td>{{ $value2->jadwal_proyek->sum('durasi') }}</td>
                                                                                                        <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek->sortBy('tgl_mulai')->groupBy('id_task_p')->take(1)->first()[0]['tgl_mulai'])) }}</td>
                                                                                                        <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek->sortByDesc('tgl_selesai')->groupBy('id_task_p')->take(1)->first()[0]['tgl_selesai'])) }}</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    @if(!empty($value2->rincian_tugas))
                                                                                                        @php($j=1)
                                                                                                        @foreach($value2->rincian_tugas as $key => $rincian_tugas)
                                                                                                            <tr>
                                                                                                                <td>{{ $i++.'.'.$j++ }}</td>
                                                                                                                <td>{{ $rincian_tugas->rincian_tugas }} </td>
                                                                                                               @if(!empty($value2->jadwal_proyek[$key]))
                                                                                                                <td>{{ $value2->jadwal_proyek[$key]->durasi }}</td>
                                                                                                                <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek[$key]->tgl_mulai)) }}</td>
                                                                                                                <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek[$key]->tgl_selesai)) }}</td>
                                                                                                                <td>
                                                                                                                   <form action="{{ url('Daftar-progress/'.$value2->jadwal_proyek[$key]->id) }}" method="get">
                                                                                                                       {{ csrf_field() }}
                                                                                                                        <button type="submit" class="btn btn-xs btn-danger" ><i class="fa fa-file-text"></i></button>
                                                                                                                   </form>
                                                                                                                </td>
                                                                                                                @else
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                @endif

                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                @endforeach
                                                                                                {{ $proyeks->links() }}
                                                                                            @else
                                                                                                <tr>
                                                                                                    <td colspan="2">Tim Belum dimasukan</td>
                                                                                                </tr>
                                                                                            @endif
                                                                                            </tbody>
                                                                                        </table>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.box-body -->
                                                                </div>
                                                                <!-- /.box -->
                                                            </div>
                                                        @endforeach
                                                        {{--{{ $data_jadwal->links() }}--}}
                                                    @endif
                                                </div>
						</div>
						<!--/. end tab4-->
						<div class="tab-pane @if(Session::get('tab5') == 'tab5') active @else '' @endif" id="tab_5">
							<div class="row">
                                                    <div class="col-md-3" style="margin: 0">
                                                        <a href="{{ url('tambah-pemeliharaan') }}" class="btn btn-primary" style="width: 100%" ><i class="fa fa-plus"></i> Tambah Pemeliharaan </a>
                                                    </div>
													<!--<div class="col-md-9" style="margin: 0" align="right">
														<a href="#jenis_pem" data-toggle="tab"><i class="fa fa-list"></i> Jenis Pemeliharaan</a></li>&nbsp;&nbsp;			
														
													</div>-->
                                                   
                                                </div>
                                                <p></p>
                                                <div class="row">
                                                    @if(empty($data_pemeliaraan))
                                                        <div class="col-md-12"> <h4 align="center">Anda belum menambahkan pemeliharaan </h4></div>
                                                    @else
                                                        @foreach($data_pemeliaraan as $value)
                                                            <div class="col-md-12">
                                                                <div class="box box-success box-solid">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <form action="{{ url('delete-pemeliharaan/'.$value->id) }}" method="post">
                                                                                <a href="{{ url('ubah-pemeliharaan/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah jasa"><i class="fa fa-pencil"></i>
                                                                                </a>
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="_method" value="put">
                                                                                <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="btn btn-box-tool" title="hapus proposal"><i class="fa fa-eraser"></i>
                                                                                </button>
                                                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                        <!-- /.box-tools -->
                                                                    </div>
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3 style="color: #0b93d5; margin-top: 0px"><u>Pemeliharaan Proyek {{ $value->proyek->spk->nm_spk }}</u> </h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <h4 style="font-weight: bold">Rincian Pekerjaan Pemeliharaan :</h4>
                                                                                        {{-- <p>Jasa  : {{ $value->jasa->nm_jasa }}</p> --}}
																							{{-- <p>Jenis Pemeliharaan : {{ $value->jenis_pem->jenis_pm --}}</p>
                                                                                        <p>Jangka Waktu Pemeliharaan : {{ $value->jangka_waktu }}</p>
                                                                                        <p>Harga Pemeliharaan :Rp. {{ $value->biaya_pem }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">                                                                     
																						<p><h5 style="font-weight: bold">Keterangan Pemeliharaan : <a href="{{ url('lihat-progress/'.$value->id) }}" class="btn btn-xs btn-primary pull-right">Lihat Progress</a></h5> {!!  $value->ket  !!} </p>
                                                                                    </div>																					
                                                                                                                                                                        
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.box-body -->
                                                                </div>
                                                                <!-- /.box -->
                                                            </div>
                                                        @endforeach
                                                        {{ $data_pemeliaraan->links() }}
                                                    @endif
                                                </div>
						</div>
						<!--/.end tab5-->
						<div class="tab-pane" id="jenis_pem">
                            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Jenis Pemeliharaan</h3>
						<h5 class="pull-right"><a href="{{ url('Proyek')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-jenis-pemeliharaan') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Jenis Pemeliharaan </label>
                                        <input type="text" class="form-control" name="jenis_pem" required>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
                            <p></p>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Proyek</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($jenis_pemeliharaan as $value)
                                <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->jenis_pem }}</td>

                                <td>
                                    <form action="{{ url('hapus-jenis-pemeliharaan/'.$value->id) }}" method="post">
                                    <a href="{{ url('ubah-jenis-pemeliharaan/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus penjualan ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

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

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    {{--<script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>--}}
    @include('user.produksi.section.timproyek.JS.JS')
    @include('user.produksi.section.timproyek.JS.modal')
@stop