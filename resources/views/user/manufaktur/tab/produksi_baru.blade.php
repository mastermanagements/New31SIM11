<div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
    <a href="{{ url('produksi-baru/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Produksi</a>
    <a href="{{ url('item-biaya-overhead/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Item Biaya Overhead</a>
    <p></p>
    <table id="example1" class="table table-bordered table-striped">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang Jadi</th>
                    <th>Barang Dalam Proses</th>
                    <th>Supervisor</th>
                    <th>Tanggal Mulai</th>
                    <th>Status Produksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data_produksi))
                    @php($no=1)
                    @foreach($data_produksi as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
						@if(!empty($data->linkToBarang->linkToSatuan->satuan) AND !empty($data->linkToBarang->nm_barang) AND !empty($data->linkToBarang->spec_barang))
                        <td>{{ $data->linkToBarang->nm_barang }}, &nbsp;{{ $data->linkToBarang->linkToSatuan->satuan }}, &nbsp;{{ $data->linkToBarang->spec_barang }}</td>
						@endif
                        @if(!empty($data->linkToBarangDalamProses->nm_barang ))
                        <td>{{ $data->linkToBarangDalamProses->nm_barang }}</td>
                        @else
                        <td>Tidak ada</td>
                        @endif
                        <td>{{ $data->linkToSupervisor->nama_ky }}</td>
                        <td>{{ tanggalView($data->tgl_mulai) }}</td>
                        <td>@if($data->status_produksi=='0') Baru @elseif($data->status_produksi=='1') Sedang Berlangsung @endif</th>
                        <td>
                            <form action="{{ url('produksi-baru/'.$data->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('delete')
                                {{--<a href="{{ url('bahan-baku/'.$data->id) }}" class="btn btn-primary" title="Tambah Bahan Baku" ><i class="fa fa-archive"></i></a>--}}
								{{--<a href="{{ url('tenaga-produksi/'.$data->id) }}" class="btn btn-primary" title="Tambah Pekerja"><i class="fa fa-user-plus"></i></a>--}}
                                {{--<a href="{{ url('biaya-overhead/'.$data->id) }}" class="btn btn-primary" title="Tambah Biaya Overhead"><i class="fa fa-dollar"></i></a>--}}
                                {{--<a href="{{ url('proses-produksi/'.$data->id.'/begin-produksi') }}" class="btn btn-primary" title="Mulai Proses Produksi"><i class="fa fa-refresh"></i></a>--}}
                                {{--<a href="{{ url('produksi-baru/'.$data->id.'/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>--}}
								
                                <a href="#" onclick="bahanProduksi()" class="btn btn-primary" title="Klik Untuk buka/tutup">Bahan Baku</a>			
								<a href="#" onclick="tenagaProduksi()" class="btn btn-primary" title="Klik Untuk buka/tutup">Tenaga Kerja</a>
                                <a href="#" onclick="biayaOverhead()" class="btn btn-primary" title="Klik Untuk buka/tutup">Overhead</a>
                                <a href="{{ url('proses-produksi/'.$data->id.'/begin-produksi') }}" class="btn btn-success" title="Mulai Proses Produksi"><i class="fa fa-refresh"></i></a>
                                <a href="{{ url('produksi-baru/'.$data->id.'/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data produksi ini...?')"><i class="fa fa-eraser"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </table>
</div>

<!---tambah bahan baku--->
<!-- Main content -->
<section class="content container-fluid" id="bahanBaku" style="display:none">
	<p></p>
	<div class="row">          
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Formulir Bahan Baku</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
									 {{ csrf_field() }}
									<div class="col-md-12">
										<table class="table table-striped" style="width: 100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Bahan Baku &nbsp;<strong style="color: red">*</strong></th>
													<th>Jumlah &nbsp;<strong style="color: red">*</strong></th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php($no=1)
												<tr>
													<form action="{{ url('bahan-baku') }}" method="post">
														<td> {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data->id }}"></td>
														<td>
															<select name="id_barang_mentah" class="form-control select2" style="width: 100%;" required>
																@if(!empty($barang))
																	<option disabled>Pilih bahan baku</option>
																	@foreach($barang as $data_barang)
																		<option value="{{ $data_barang->id }}">{{ $data_barang->nm_barang }}, {{ $data_barang->linkToSatuan->satuan }}, {{ $data_barang->merk_barang }} </option>
																	@endforeach
																@endif
															</select>
														</td>
														<td>
															<input type="text" class="form-control" name="jumlah_bahan" required>
														</td>
														<td><button type="submit" class="btn btn-primary">Tambah</button></td>
													</form>
												</tr>
												<p></p>
												@if(!empty($bahan_baku))
													@foreach($bahan_baku as $item_bahan_baku)
														@if($item_bahan_baku->id_tambah_produksi == $data->id)
														<tr>
															<form action="{{ url('bahan-baku/'.$item_bahan_baku->id) }}" method="post">
																<td>{{ $no++ }} @method('put') {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $item_bahan_baku->id_tambah_produksi }}"></td>																																
																<td>
																	<select name="id_barang_mentah" class="form-control select2" style="width: 100%;" required>
																		@if(!empty($barang))
																			<option value="">Pilih bahan baku</option>
																			@foreach($barang as $data_barang)
																				<option value="{{ $data_barang->id }}" @if($item_bahan_baku->id_barang_mentah==$data_barang->id) selected @endif>{{ $data_barang->nm_barang }} , {{ $data_barang->linkToSatuan->satuan }}, {{ $data_barang->merk_barang }}</option>
																			@endforeach
																		@endif
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" name="jumlah_bahan" value="{{ $item_bahan_baku->jumlah_bahan }}" required>
																</td>
																
																<td>
																	<button type="submit" class="btn btn-warning">ubah</button>
																	<a href="{{ url('bahan-baku/'.$item_bahan_baku->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus data bahan baku ini...?')" type="submit" class="btn btn-danger">hapus</a>
																</td>
															</form>
														</tr>
														@endif
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
 <!-- /.content -->
<!-- /.Tenaga Kerja -->
<!-- Main content -->
<section class="content container-fluid" id="tenagaKerja" style="display:none">
	<p></p>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Formulir Tenaga Produksi</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
									 {{ csrf_field() }}
									<div class="col-md-12">
										<table class="table table-striped" style="width: 100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Nama Karyawan&nbsp;<strong style="color: red">*</strong></th>
													<th>Besaran Upah&nbsp;<strong style="color: red">*</strong></th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php($no=1)
												<tr>
													<form action="{{ url('tenaga-produksi') }}" method="post">
														<td> {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data->id }}"></td>
														<td>
															<select name="tenaga_kerja" class="form-control select2" style="width: 100%;" required>
																@if(!empty($karyawan))
																	<option value="">Pilih Karyawan</option>
																	@foreach($karyawan as $data_karyawan)
																		<option value="{{ $data_karyawan->id }}">{{ $data_karyawan->nama_ky }}</option>
																	@endforeach
																@endif
															</select>
														</td>
														<td>
															<input type="text" id="rupiah2" class="form-control" name="jumlah_upah" required>
														</td>
														<td><button type="submit" class="btn btn-primary">Simpan</button></td>
													</form>
												</tr>
												@if(!empty($tenaga_prod))
													@foreach($tenaga_prod as $tenaga_prod)
													@if($tenaga_prod->id_tambah_produksi == $data->id)
														<tr>
															<form action="{{ url('tenaga-produksi/'.$tenaga_prod->id) }}" method="post">
																<td>{{ $no++ }} @method('put') {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $tenaga_prod->id_tambah_produksi }}"></td>
																<td>
																		<select name="tenaga_kerja" class="form-control select2" style="width: 100%;" required>
																			@if(!empty($karyawan))
																				<option value="">Pilih Karyawan</option>
																				@foreach($karyawan as $karyawan_item)
																					<option value="{{ $karyawan_item->id }}" @if($tenaga_prod->tenaga_kerja == $karyawan_item->id) selected @endif>{{ $karyawan_item->nama_ky }}</option>
																				@endforeach
																			@endif
																		</select>
																</td>
																<td>
																	<input type="text" class="form-control" name="jumlah_upah" value="{{ rupiahView($tenaga_prod->jumlah_upah) }}" required>
																</td>
																<td>
																	<button type="submit" class="btn btn-warning">ubah</button>
																	<a href="{{ url('tenaga-produksi/'.$tenaga_prod->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus data pekerja produksi ini...?')" type="submit" class="btn btn-danger">hapus</a>
																</td>
															</form>
														</tr>
														@endif
													@endforeach
												@endif
											</tbody>
										</table>

									</div>
							</div>
						</div>
					</div>

			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<!-- overHead -->
<!-- Main content -->
<section class="content container-fluid" id="overHead" style="display:none">
	<p></p>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Formulir Biaya Overhead</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->				 
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
								 {{ csrf_field() }}
								<div class="col-md-12">
									<table class="table table-striped" style="width: 100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Biaya Overhead</th>
												<th>Besarnya Biaya Overhead</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											@php($no=1)
											<tr>
												<form action="{{ url('biaya-overhead') }}" method="post">
													<td> {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data->id }}"></td>
													<td>
														<select name="id_item_overhead" class="form-control select2" style="width: 100%;" required>
															@if(!empty($item_over_head))
																<option value="">Pilih Item Overhead</option>
																@foreach($item_over_head as $data_item_over_head)
																	<option value="{{ $data_item_over_head->id }}">{{ $data_item_over_head->item_overhead }}</option>
																@endforeach
															@endif
														</select>
													</td>
													<td>
														<input type="text" class="form-control" id="rupiah2" name="jumlah_biaya" required>
													</td>
													<td><button type="submit" class="btn btn-primary">Simpan</button></td>
												</form>
											</tr>
											@if(!empty($data_biaya_overhead))
												@foreach($data_biaya_overhead as $data_biaya_overhead)
													@if($data_biaya_overhead->id_tambah_produksi == $data->id)
													<tr>
														<form action="{{ url('biaya-overhead/'.$data_biaya_overhead->id) }}" method="post">
															<td>{{ $no++ }} @method('put') {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data_biaya_overhead->id_tambah_produksi }}"></td>
															<td>
																	<select name="id_item_overhead" class="form-control select2" style="width: 100%;" required>
																		@if(!empty($item_over_head))
																			<option value="">Pilih Item Overhead</option>
																			@foreach($item_over_head as $data_item_over_head)
																				<option value="{{ $data_item_over_head->id }}" @if($data_biaya_overhead->id_item_overhead==$data_item_over_head->id) selected @endif>{{ $data_item_over_head->item_overhead }}</option>
																			@endforeach
																		@endif
																	</select>
															</td>
															<td>
																<input type="text" class="form-control" name="jumlah_biaya" value="{{ rupiahView($data_biaya_overhead->jumlah_biaya) }}" required>
															</td>
															<td>
																<button type="submit" class="btn btn-warning">ubah</button>
																<a href="{{ url('biaya-overhead/'.$data_biaya_overhead->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus data biaya overhead ini...?')" type="submit" class="btn btn-danger">hapus</a>
															</td>
														</form>
													</tr>
													@endif
												@endforeach
											@endif
										</tbody>
									</table>

								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

@section('plugins')
    @include('user.global.rupiah_input2')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	<script>
		function bahanProduksi() {
			var x = document.getElementById("bahanBaku");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		} 	
		function tenagaProduksi() {
			var x = document.getElementById("tenagaKerja");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		} 
		function biayaOverhead() {
			var x = document.getElementById("overHead");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		} 	
	</script>
@stop

