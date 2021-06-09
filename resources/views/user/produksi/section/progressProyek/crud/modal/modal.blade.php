
<div class="modal fade" id="modal-tambah-progress-proyek">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Progress Proyek dsdsd</h4>
            </div>
            <form action="{{ url('store-progress-proyek') }}" method="post">
            <div class="modal-body" id="content_modal">
				<div class="col-md-6">
					<div class="form-group">
						<label>Tanggal Dikerjakan </label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal dikerjakan" name="tgl_dikerjakan" >
						</div>

						<!-- /.input group -->
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					<div class="form-group">
						<label>Masalah</label>
						<textarea id="masalah" name="masalah" required></textarea>
						<!-- /.input group -->
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Solusi</label>
						<textarea id="solusi" name="solusi" required></textarea>
						<!-- /.input group -->
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					<div class="form-group">
						<label>Rincian Pekerjaan</label>
						<textarea id="rincian_pekerjaan" name="rincian_pekerjaan" required></textarea>
						<!-- /.input group -->
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_jadwal_proyek" value="{{ $id_jadwal_proyek }}">
                {{ csrf_field() }}
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" id="submitBagian" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-ubah-progress-proyek">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Progress Proyek Ubah</h4>
            </div>
            <form action="{{ url('update-progress-proyek') }}" method="post">
                <div class="modal-body" id="content_modal_update">
					<div class="col-md-6">
						<div class="form-group">
							<label>Tanggal Dikerjakan </label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal dikerjakan" name="tgl_dikerjakan_ubah" >
							</div>

							<!-- /.input group -->
							<small style="color: red">* Tidak Boleh Kosong</small>
						</div>
						<div class="form-group">
							<label>Masalah</label>
							<textarea id="masalah_ubah" name="masalah_ubah" required></textarea>
							<!-- /.input group -->
							<small style="color: red">* Tidak Boleh Kosong</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Solusi</label>
							<textarea id="solusi_ubah" name="solusi_ubah" required></textarea>
							<!-- /.input group -->
							<small style="color: red">* Tidak Boleh Kosong</small>
						</div>
						<div class="form-group">
							<label>Rincian Pekerjaan</label>
							<textarea id="rincian_pekerjaan_ubah" name="rincian_pekerjaan_ubah" required></textarea>
							<!-- /.input group -->
							<small style="color: red">* Tidak Boleh Kosong</small>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_jadwal_proyek" value="{{ $id_jadwal_proyek }}">
                    <input type="hidden" name="id_progress_proyek">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitBagian" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->