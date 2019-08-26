<!---tambah segmentasi barang demografis-->
<div class="modal fade" id="modal-tambah-SegBarang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-segbarang') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Formulir Tambah Segmenting Demografis Untuk Barang : 
					 
				
					</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
                                <select class="form-control select2" style="width: 100%;" name="tahun" required>
                                   <option>Pilih Tahun Segmenting</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
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
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_content_segmenting" class="form-control" required/>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSegBrg" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->
<!---tambah segmentasi jasa demografis-->
<div class="modal fade" id="modal-tambah-SegJasa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-segjasa') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>	
                    <h4 class="modal-title">Formulir Tambah Segmenting Demografis Untuk Jasa : 
					</h4>
                </div>
				<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
                                <select class="form-control select2" style="width: 100%;" name="tahun" required>
                                   <option>Pilih Tahun Segmenting</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="modal-body">
					<div class="form-group">
                    <label for="exampleInputEmail1">Nama Jasa</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                            @if(empty($data_jasa))
                               <option>Data jasa di menu Produk Belum di isi</option>
								@else
								<option>Pilih jasa</option>
                                @foreach($data_jasa as $jasa)
                                    <option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_content_segmenting" class="form-control" required/>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSegBrg" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->

<!---tambah segmentasi barang Geografis-->
<div class="modal fade" id="modal-tambah-SegBarangGeo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-segbarang-geo') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Segmenting Geografis Untuk Barang : 
					 
					</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
                                <select class="form-control select2" style="width: 100%;" name="tahun" required>
                                   <option>Pilih Tahun Segmenting</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
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
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_content_segmenting" class="form-control" required/>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSegBrg" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->
<!---tambah segmentasi jasa Geografis -->
<div class="modal fade" id="modal-tambah-SegJasaGeo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-segjasa-geo') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Segmenting Geografis Untuk Jasa : 
					</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
                                <select class="form-control select2" style="width: 100%;" name="tahun" required>
                                   <option>Pilih Tahun Segmenting</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Nama Jasa</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                            @if(empty($data_jasa))
                               <option>Data jasa di menu Produk Belum di isi</option>
								@else
								<option>Pilih jasa</option>
                                @foreach($data_jasa as $jasa)
                                    <option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_content_segmenting" class="form-control" required/>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSegBrg" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->

<!---tambah segmentasi barang Psikografis-->

<div class="modal fade" id="modal-tambah-SegBarangPsi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-segbarang-psi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Segmenting Psikografis Untuk Barang : 
					 
					</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
                                <select class="form-control select2" style="width: 100%;" name="tahun" required>
                                   <option>Pilih Tahun Segmenting</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
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
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_content_segmenting" class="form-control" required/>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSegBrg" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->

<!---tambah segmentasi jasa Psikografis -->

<div class="modal fade" id="modal-tambah-SegJasaPsi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-segjasa-psi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Segmenting Psikografis Untuk Jasa : 
					</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
                                <select class="form-control select2" style="width: 100%;" name="tahun" required>
                                   <option>Pilih Tahun Segmenting</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Nama Jasa</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                            @if(empty($data_jasa))
                               <option>Data jasa di menu Produk Belum di isi</option>
								@else
								<option>Pilih jasa</option>
                                @foreach($data_jasa as $jasa)
                                    <option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_content_segmenting" class="form-control" required/>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSegBrg" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->

<!---ubah hasil segmenting Demografi barang & jasa---->
<div class="modal fade" id="modal-ubah-hasil-segmenting-demog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-hasilsg')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Hasil Segmenting</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting_ubah" class="form-control" required>
                        <input type="hidden" name="id_hasil_segmenting">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submithasilsegmenting" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---ubah hasil segmenting Geografis barang & jasa---->
<div class="modal fade" id="modal-ubah-hasil-segmenting-geog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-hasilsg')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Hasil Segmenting</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting_ubah" class="form-control" required>
                        <input type="hidden" name="id_hasil_segmenting">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submithasilsegmenting" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---ubah hasil segmenting Psikografis barang & jasa---->
<div class="modal fade" id="modal-ubah-hasil-segmenting-psi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-hasilsg')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Hasil Segmenting</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hasil Segmenting</label>
                        <input name="hasil_segmenting_ubah" class="form-control" required>
                        <input type="hidden" name="id_hasil_segmenting">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submithasilsegmenting" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->