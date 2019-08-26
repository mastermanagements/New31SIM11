
<!---modal tambah RESPON ATTRACT--->
<div class="modal fade" id="modal-tambah-ResponConvert">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('store-respon-convert') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Respon Konsumen Hari Ini</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Kegiatan</label>
                        <input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Like </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="jum_like" value="0" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Comment</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="jum_comment" value="0" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Share</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="jum_share" value="0" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Follower</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="jum_follower" value="0" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Keterangan Tambahan </label>
                        <textarea class="form-control"  name="ket" id="ket"></textarea>
                    </div>
					<input type="hidden" name="id_pel_m">
					<div class="modal-footer">
						{{ csrf_field() }}
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
						<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>	
			</form>
		</div>
        <!-- /.modal-content -->
	</div>
    <!-- /.modal-dialog -->
</div>	
<!-- /.modal -->
