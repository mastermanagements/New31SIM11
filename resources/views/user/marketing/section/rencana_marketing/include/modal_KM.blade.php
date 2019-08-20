<!---modal tambah KM--->
<div class="modal fade" id="modal-tambah-KM">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-keg-marketing') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Kegiatan Marketing Barang</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Kegiatan</label>
                        <input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
                    </div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">Kegiatan Marketing</label>
						<div class="form-group" id="id_keg_marketing">
						
						<p></p>
					</div>
							<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
		
							<div class="form-group">
                                <label for="exampleInputEmail1">Tema Campaign</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="tema_content" required>
                            </div>
							
							<input type="hidden" name="id_rm_fase">
					
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