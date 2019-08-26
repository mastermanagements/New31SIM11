<div class="modal fade" id="modal-tambah-ClosingBrg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-closing') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Formulir Tambah Data Closing Marketing Barang</h4>
                </div>
                <div class="modal-body">
					@php($waktu_now = \Carbon\Carbon::now())		
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Kegiatan</label>
								<input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
							</div>
							<div class="form-group">
                                <label for="exampleInputFile">Leads/Customer</label>
                                   <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                        <option>Pilih Customer</option>
                                         @foreach($data_klien as $value)
                                           <option value="{{ $value->id }}">
										   @if($value->jenis_klien =='1')
										   Leads
										   @else
										   Customer 
											@endif
											--
											{{ $value->nm_klien }}
										   </option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>	
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Barang</label>
									<select class="form-control select2" style="width: 100%;" name="id_barang" required>
									@if(empty($data_barang))
										<option>Data Barang Belum di isi</option>
										@else
										<option>Pilih Barang</option>
										@foreach($data_barang as $barang)
										<option value="{{ $barang->id }}">{{ $barang->nm_barang }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputFile">Tool Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="tool_closing" required>
                                        <option>Pilih Tool Closing </option>
                                         @foreach($tool_closing as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Pesan Closing</label>
								<textarea name="content_closing" class="form-control" id="content_closing" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Respon Customer</label>
								<textarea name="respon_klien" class="form-control" id="respon_klien"></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Hasil Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="hasil_akhir" required>
                                        <option>Pilih Hasil Closing </option>
                                         @foreach($hasil_akhir as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Status Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="status_closing" required>
                                        <option>Tentukan Status Closing </option>
                                         @foreach($status_closing_f as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div>
							Apakah perlu di follow up oleh departemen dan divisi lain?
							</div></br>
							<div class="form-group">
								<label for="exampleInputEmail1">Departemen</label>
									<select class="form-control select2" style="width: 100%;" name="id_bagian_p">
										@if(empty($bagian_p))
											<option>Departemen Perusahaan Belum di Isi</option>
										@else
											<option value="0">Pilih Departemen</option>
											@foreach($bagian_p as $bagian)
												<option value="{{ $bagian->id }}">{{ $bagian->nm_bagian }}</option>
											@endforeach
										@endif
									</select>
									<small style="color:#35C30F">* Isi Jika Perlu Follow up ke departemen lain</small>
							</div>
							<div class="form-group">
								<label for="exampleInputFile">Divisi</label>
									<select class="form-control select2" style="width: 100%;" name="id_divisi_p">
										<option value="0">Pilih Divisi</option>
									</select>
									<small style="color: green">* Isi Jika Perlu Follow up ke divisi lain</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
								<textarea name="ket" class="form-control" id="ket"></textarea>
                                <small style="color:#35C30F">* Isi Jika Perlu</small>
                            </div>
							<div class="modal-footer">
								{{ csrf_field() }}
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
								<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
							</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->

<div class="modal fade" id="modal-tambah-ClosingJasa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-closing') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Formulir Tambah Data Closing Marketing Barang</h4>
                </div>
                <div class="modal-body">
					@php($waktu_now = \Carbon\Carbon::now())		
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Kegiatan</label>
								<input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
							</div>
							<div class="form-group">
                                <label for="exampleInputFile">Leads/Customer</label>
                                   <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                        <option>Pilih Customer</option>
                                         @foreach($data_klien as $value)
                                           <option value="{{ $value->id }}">
										   @if($value->jenis_klien =='1')
										   Leads
										   @else
										   Customer 
											@endif
											--
											{{ $value->nm_klien }}
										   </option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>	
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Jasa</label>
									<select class="form-control select2" style="width: 100%;" name="id_jasa" required>
									@if(empty($data_jasa))
										<option>Data Layanan jasa Belum di isi</option>
										@else
										<option>Pilih Layanan</option>
										@foreach($data_jasa as $jasa)
										<option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputFile">Tool Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="tool_closing" required>
                                        <option>Pilih Tool Closing </option>
                                         @foreach($tool_closing as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Pesan Closing</label>
								<textarea name="content_closing" class="form-control" id="content_closing" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Respon Customer</label>
								<textarea name="respon_klien" class="form-control" id="respon_klien"></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Hasil Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="hasil_akhir" required>
                                        <option>Pilih Hasil Closing </option>
                                         @foreach($hasil_akhir as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Status Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="status_closing" required>
                                        <option>Tentukan Status Closing </option>
                                         @foreach($status_closing_f as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div>
							Apakah perlu di follow up oleh departemen dan divisi lain?
							</div></br>
							<div class="form-group">
								<label for="exampleInputEmail1">Departemen</label>
									<select class="form-control select2" style="width: 100%;" name="id_bagian_p">
										@if(empty($bagian_p))
											<option>Departemen Perusahaan Belum di Isi</option>
										@else
											<option value="0">Pilih Departemen</option>
											@foreach($bagian_p as $bagian)
												<option value="{{ $bagian->id }}">{{ $bagian->nm_bagian }}</option>
											@endforeach
										@endif
									</select>
									<small style="color:#35C30F">* Isi Jika Perlu Follow up ke departemen lain</small>
							</div>
							<div class="form-group">
								<label for="exampleInputFile">Divisi</label>
									<select class="form-control select2" style="width: 100%;" name="id_divisi_p">
										<option value="0">Pilih Divisi</option>
									</select>
									<small style="color: green">* Isi Jika Perlu Follow up ke divisi lain</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
								<textarea name="ket" class="form-control" id="ket"></textarea>
                                <small style="color:#35C30F">* Isi Jika Perlu</small>
                            </div>
							<div class="modal-footer">
								{{ csrf_field() }}
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
								<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
							</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->

<!---tambah follow up-->
<div class="modal fade" id="modal-tambah-SClosing">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-sclosing') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Formulir Tambah Follow up Closing</h4>
                </div>
                <div class="modal-body">
					@php($waktu_now = \Carbon\Carbon::now())		
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Kegiatan</label>
								<input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
							</div>
							<div class="form-group">
                                <label for="exampleInputFile">Tool Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="tool_closing" required>
                                        <option>Pilih Tool Closing </option>
                                         @foreach($tool_closing as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Pesan Closing</label>
								<textarea name="content_closing" class="form-control" id="content_closing" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Respon Customer</label>
								<textarea name="respon_klien" class="form-control" id="respon_klien"></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Hasil Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="hasil_akhir" required>
                                        <option>Pilih Hasil Closing </option>
                                         @foreach($hasil_akhir as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Status Closing</label>
                                   <select class="form-control select2" style="width: 100%;" name="status_closing" required>
                                        <option>Tentukan Status Closing </option>
                                         @foreach($status_closing_f as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div>
							Apakah perlu di follow up oleh departemen dan divisi lain?
							</div></br>
							<div class="form-group">
								<label for="exampleInputEmail1">Departemen</label>
									<select class="form-control select2" style="width: 100%;" name="id_bagian_p">
										@if(empty($bagian_p))
											<option>Departemen Perusahaan Belum di Isi</option>
										@else
											<option value="0">Pilih Departemen</option>
											@foreach($bagian_p as $bagian)
												<option value="{{ $bagian->id }}">{{ $bagian->nm_bagian }}</option>
											@endforeach
										@endif
									</select>
									<small style="color:#35C30F">* Isi Jika Perlu Follow up ke departemen lain</small>
							</div>
							<div class="form-group">
								<label for="exampleInputFile">Divisi</label>
									<select class="form-control select2" style="width: 100%;" name="id_divisi_p">
										<option value="0">Pilih Divisi</option>
									</select>
									<small style="color: green">* Isi Jika Perlu Follow up ke divisi lain</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
								<textarea name="ket" class="form-control" id="ket"></textarea>
                                <small style="color:#35C30F">* Isi Jika Perlu</small>
                            </div>
								<input type="hidden" name="id_closing" class="form-control" required/>
							<div class="modal-footer">
								{{ csrf_field() }}
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
								<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
							</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->
<script>
	window.onload = function() {
		 
		$('[name="id_bagian_p"]').change(function () {
               $.ajax({
                   url:"{{ url('getDivisi') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option value='0'>Pilih Divisi</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nm_devisi+"</option>";
                       });
                       $('[name="id_divisi_p"]').html(option);
                   }
               })
			})
	};
	
</script>