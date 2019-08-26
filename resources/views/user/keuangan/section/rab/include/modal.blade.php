<!---modal tambah RPB--->
<div class="modal fade" id="modal-tambah-RPB">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rpb') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Penjualan Barang</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                    <label for="exampleInputEmail1">Barang</label>
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
                        <label for="exampleInputEmail1">Jumlah Barang Terjual</label>
                        <input name="target_brg_terjual" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Klien Yang Beli</label>
                        <input name="target_klien_beli" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="bulan">
					<input type="hidden" name="tahun">
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSJP" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>	
<!-- /.modal -->
<!----edit RPB-->
<div class="modal fade" id="modal-ubahRPB">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-rpb')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Rencana Penjualan Barang</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Tahun </label>
						<select class="form-control select2" style="width: 100%;" name="tahun_ubah" required>
								<option>Tahun</option>
                                    @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Bulan</label>
						<select class="form-control select2" style="width: 100%;" name="bulan_ubah" required>
								<option>Bulan</option>
                                    @foreach(Bulan() as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                    @endforeach
                        </select>
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
									
					<div class="form-group">
                        <label for="exampleInputEmail1">Barang</label>
                        <select class="form-control select2" style="width: 100%;" name="id_barang_ubah" required>
                            @if(empty($data_barang))
                                <option>Data Baang Belum di Isi</option>
                                @else
								<option>Pilih Nama Barang</option>
                                @foreach($data_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nm_barang }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Barang Terjual</label>
                        <input type="text" class="form-control"  name="target_brg_terjual_ubah"  required>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Klien Yang Beli</label>
                        <input type="text" class="form-control"  name="target_klien_beli_ubah"  required>
                         <input type="hidden" name="id_rpb">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahStahunan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---modal tambah RPJ--->
<div class="modal fade" id="modal-tambah-RPJ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rpj') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Penjualan Jasa</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                    <label for="exampleInputEmail1">Jasa</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                            @if(empty($data_jasa))
                               <option>Data Jasa Belum di isi</option>
								@else
								<option>Pilih Jasa</option>
                                @foreach($data_jasa as $jasa)
                                    <option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Jasa Terjual</label>
                        <input name="target_jasa_terjual" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Jumlah Klien</label>
                        <input name="target_klien_beli" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="bulan">
					<input type="hidden" name="tahun">
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSJP" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>	
<!-- /.modal -->
<!----edit RPJ-->
<div class="modal fade" id="modal-ubahRPJ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-rpj')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Rencana Pendapatan Jasa</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Tahun </label>
						<select class="form-control select2" style="width: 100%;" name="tahun_ubah" required>
								<option>Tahun</option>
                                    @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Bulan</label>
						<select class="form-control select2" style="width: 100%;" name="bulan_ubah" required>
								<option>Bulan</option>
                                    @foreach(Bulan() as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                    @endforeach
                        </select>
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
									
					<div class="form-group">
                        <label for="exampleInputEmail1">Jasa</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jasa_ubah" required>
                            @if(empty($data_jasa))
                                <option>Data Jasa Belum di Isi</option>
                                @else
								<option>Pilih Nama Layanan</option>
                                @foreach($data_jasa as $jasa)
                                    <option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Jasa Terjual</label>
                        <input type="text" class="form-control"  name="target_jasa_terjual_ubah"  required>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Klien Yang Beli</label>
                        <input type="text" class="form-control"  name="target_klien_beli_ubah"  required>
                         <input type="hidden" name="id_rpj">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahStahunan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---tambah ROUT--->
<div class="modal fade" id="modal-tambah-ROUT">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rout') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Pengeluaran Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                    <label for="exampleInputEmail1">Nama Pengeluaran</label>
                        <select class="form-control select2" style="width: 100%;" name="id_subsub_akun" required>
                            @if(empty($data_subsub_akun))
                               <option>Data pengeluaran di pengaturan akun Belum di isi</option>
								@else
								<option>Pilih Pengeluaran</option>
                                @foreach($data_subsub_akun as $subsubakun)
                                    <option value="{{ $subsubakun->id }}">{{ $subsubakun->nm_subsub_akun }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Pengeluaran</label>
                        <input name="jumlah_pengeluaran" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="bulan">
					<input type="hidden" name="tahun">
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitROUT" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>	
<!-- /.modal -->
<!----edit R-OUT-->
<div class="modal fade" id="modal-ubahROUT">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-rout')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Rencana Pengeluaran Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Tahun </label>
						<select class="form-control select2" style="width: 100%;" name="tahun_ubah" required>
								<option>Tahun</option>
                                    @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Bulan</label>
						<select class="form-control select2" style="width: 100%;" name="bulan_ubah" required>
								<option>Bulan</option>
                                    @foreach(Bulan() as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                    @endforeach
                        </select>
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
									
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama Pengeluaran</label>
                        <select class="form-control select2" style="width: 100%;" name="id_subsub_akun_ubah" required>
                            @if(empty($data_barang))
                                <option>Data Akun Belum di Isi</option>
                                @else
								<option>Pilih Nama Pengeluaran</option>
                                @foreach($data_subsub_akun as $akun_beban)
                                    <option value="{{ $akun_beban->id }}">{{ $akun_beban->nm_subsub_akun }}</option>
                                @endforeach
                            @endif
                        </select>
						<input type="hidden" name="id_rout">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Pengeluaran</label>
                        <input type="text" class="form-control"  name="jumlah_pengeluaran_ubah"  required>
                        <small style="color: red" id="notify"></small>
                    </div>
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
<!-- /.modal -->