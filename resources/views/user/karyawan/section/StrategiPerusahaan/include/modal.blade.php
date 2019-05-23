<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<!---modal tambah strategi tahunan--->
<div class="modal fade" id="modal-tambah-SJP">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-sjp') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Strategi Jangka Panjang Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Masukan Strategi Jangka Panjang</label>
                        <textarea class="form-control"  name="isi_sjp" id="isi_sjp" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="text" name="id_tjp">
					</div>
					
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
<!---end modal tambah strategi tahunan--->

<!---modal ubah sjp--->
<div class="modal fade" id="modal-ubah-SJP">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-sjp')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Jangka Panjang Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Isi Strategi Jangka Panjang Perusahaan</label>
                        <textarea class="form-control"  name="isi_sjp_ubah"  required></textarea>
                         <input type="text" name="id_sjp">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSJP" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---end modal ubah sjp--->

<!---modal tambah strategi tahunan --->
<div class="modal fade" id="modal-tambah-Stahunan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-stahunan') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Strategi Tahunan Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Masukan Strategi Tahunan</label>
                        <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_stahunan" id="isi_stahunan" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="text" name="id_sjp">
						<input type="text" name="id_target_tahunan">
					</div>
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitStahunan" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>	
</div>
<!-- /.modal -->
<!---end modal tambah strategi tahunan --->

<!---modal ubah strategi tahunan--->
<div class="modal fade" id="modal-ubah-Stahunan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-stahunan')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Tahunan Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Isi Strategi Tahunan</label>
                        <textarea class="form-control"  name="isi_stahunan_ubah"  required></textarea>
                        <input type="text" name="id_stahunan">
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
<!---end modal ubah strategi tahunan--->

<!---modal tambah strategi bulanan--->
<div class="modal fade" id="modal-tambah-Sbulanan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-sbulanan') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Strategi Bulanan Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Masukan Strategi Bulanan</label>
                        <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_sbulanan" id="isi_sbulanan" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="text" name="id_target_bulanan">
						<input type="text" name="id_stahunan">
					</div>
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
<!---end modal tambah strategi bulanan--->
<!---modal ubah strategi bulanan--->
<div class="modal fade" id="modal-ubah-Sbulanan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-sbulanan')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Bulanan Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Isi Strategi Bulanan</label>
                        <textarea class="form-control"  name="isi_sbulanan_ubah"  required></textarea>
                        <input type="text" name="id_sbulanan">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSbulanan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---end modal ubah strategi bulanan--->
<script>

       window.onload = function() {
           CKEDITOR.replace( 'isi_sjp',{
                height: 400
           } );
		   CKEDITOR.replace( 'isi_sjp_ubah',{
                height: 400
           } );
		   CKEDITOR.replace( 'isi_stahunan',{
                height: 300
           } );
		   CKEDITOR.replace( 'isi_stahunan_ubah',{
                height: 200
           } );
		   CKEDITOR.replace( 'isi_sbulanan',{
                height: 300
           } );
		   CKEDITOR.replace( 'isi_sbulanan_ubah',{
                height: 200
           } );
       };
	  
</script>

