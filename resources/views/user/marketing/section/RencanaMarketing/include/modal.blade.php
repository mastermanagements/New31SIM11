<!---modal tambah RMB--->
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<div class="modal fade" id="modal-tambah-RMB">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rmb') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Pemasaran Barang</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Klien Beli</label>
                        <input name="target_klien_beli" class="form-control" disabled="disabled"/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Barang Terjual</label>
                        <input name="target_brg_terjual" class="form-control" disabled="disabled"/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Promo Ke Klien Lama</label></br>
						<small style="color: red">Target Promo Ke Klien Minimal 3 x Target Barang Terjual</small>
                        <input name="jum_klien_lama" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Promo Ke Calon Klien</label>
						<small style="color: red">Target Promo Ke Klien Minimal 3 x Target Barang Terjual</small>
                        <input name="jum_klien_baru" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control"  name="ket" id="ket" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
					</div>
					<input type="hidden" name="id_rencana_pend_brg">
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
<div class="modal fade" id="modal-ubahRMB">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-rmb')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Rencana Marketing Barang</h4>
                </div>
                <div class="modal-body">								
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Promo Ke Klien Lama</label>
                        <input type="text" class="form-control"  name="jum_klien_lama_ubah"  required>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control"  name="ket_ubah"  required></textarea>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Promo Ke Calon Klien</label>
                        <input type="text" class="form-control"  name="jum_klien_baru_ubah"  required>
							<input type="text" name="id_rmb">
							<input type="text" name="id_rencana_pend_brg_ubah">
                        <small style="color: red" id="notify"></small>
                    </div>
					
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahRMB" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---modal tambah RMJ--->
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<div class="modal fade" id="modal-tambah-RMJ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rmj') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Pemasaran Jasa</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Klien Beli</label>
                        <input name="target_klien_beli" class="form-control" disabled="disabled"/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Jasa Terjual</label>
                        <input name="target_jasa_terjual" class="form-control" disabled="disabled"/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Promo Ke Klien Lama</label></br>
						<small style="color: red">Target Promo Ke Klien Minimal 3 x Target Jasa Terjual</small>
                        <input name="jum_klien_lama" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Promo Ke Calon Klien</label>
						<small style="color: red">Target Promo Ke Klien Minimal 3 x Target Jasa Terjual</small>
                        <input name="jum_klien_baru" class="form-control" required/>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control"  name="ket" id="ket_jasa" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
					</div>
					<input type="text" name="id_rencana_pend_jasa">
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitRMJ" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>	
<!-- /.modal -->
<script>
       window.onload = function() {
           CKEDITOR.replace( 'ket',{
                height: 150
           } );
		   CKEDITOR.replace( 'ket_ubah',{
                height: 150
           } );
		   CKEDITOR.replace( 'ket_jasa',{
                height: 150
           } );
       };
	  
</script>