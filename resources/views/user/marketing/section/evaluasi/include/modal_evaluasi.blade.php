<div class="modal fade" id="modal-tambah-evaluasiM">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-evaluasi-marketing') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Formulir Tambah Data Evaluasi Marketing</h4>
                </div>
                <div class="modal-body">
					@php($waktu_now = \Carbon\Carbon::now())		
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Kegiatan</label>
								<input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Kriteria Evaluasi Marketing</label>
									<select class="form-control select2" style="width: 100%;" name="id_kriteria_evaluasi" required>
									@if(empty($kriteria_evaluasi))
										<option>Data Kriteria Belum di isi</option>
										@else
										<option>Pilih Kriteria Evaluasi</option>
										@foreach($kriteria_evaluasi as $value)
										<option value="{{ $value->id }}">{{ $value->kriteria_evaluasi }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small><br>
								<a href="#" onclick="tambahKE()">
                                    Klik Jika ingin menambah Kriteria Evaluasi
                                </a>
							</div>
							<div class="form-group">
                                <label for="exampleInputFile">Dimensi</label>
                                   <select class="form-control select2" style="width: 100%;" name="dimensi" required>
                                        <option>Pilih Dimensi Evaluasi</option>
                                         @foreach($dimensi as $value)
                                           <option value="{{ $value}}">{{ $value}}</option>
                                         @endforeach
                                    </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
								<label for="exampleInputEmail1">Indikator Evaluasi</label>
									<select class="form-control select2" style="width: 100%;" name="id_indikator_evaluasi" required>
									@if(empty($indikator_evaluasi))
										<option>Data indikator belum di isi</option>
										@else
										<option>Pilih Indikator Marketing</option>
										@foreach($indikator_evaluasi as $value)
										<option value="{{ $value->id }}">{{ $value->indikator_evaluasi }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small><br>
								<a href="#" onclick="tambahIE()">
                                    Klik Jika ingin menambah Indikator Evaluasi Marketing
                                </a>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Jenis Content</label>
									<input type="text" name="jenis_content" class="form-control" required>
									<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">URL content</label>
									<input type="text" name="link_url" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Solusi Marketing</label>
									<select class="form-control select2" style="width: 100%;" name="id_solusi_evaluasi" required>
									@if(empty($solusi_evaluasi))
										<option>Data Solusi Marketing belum di isi</option>
										@else
										<option>Tentukan Solusi Marketing</option>
										@foreach($solusi_evaluasi as $value)
										<option value="{{ $value->id }}">{{ $value->solusi }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small><br>
								<a href="#" onclick="tambahSE()">
                                    Klik Jika ingin menambah Solusi Marketing
                                </a>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Keterangan Tambahan</label>
									<input type="text" name="ket" class="form-control">
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
<div class="modal fade" id="modal-tambah-KEvaluasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('store-KEvaluasi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Tambah Kriteria Evaluasi</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama Kriteria Evaluasi</label>
							<input type="text" name="kriteria_evaluasi" class="form-control" required>
                    </div>
					<div class="modal-footer">
					{{ csrf_field() }}
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->
<div class="modal fade" id="modal-tambah-IEvaluasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('store-IEvaluasi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Tambah Indikator Evaluasi</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama Indikator Evaluasi</label>
							<input type="text" name="indikator_evaluasi" class="form-control" required>
                    </div>
					<div class="modal-footer">
					{{ csrf_field() }}
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->
<div class="modal fade" id="modal-tambah-SEvaluasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('store-SEvaluasi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Tambah Indikator Evaluasi</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama Solusi Marketing</label>
							<input type="text" name="solusi_evaluasi" class="form-control" required>
                    </div>
					<div class="modal-footer">
					{{ csrf_field() }}
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->