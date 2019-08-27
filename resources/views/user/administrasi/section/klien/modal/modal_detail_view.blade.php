
<div class="modal fade" id="modal-detail-klien">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Detail Data Customer</b></h4>
            </div>
            <div class="modal-body">    
                <div class="form-group">
					<label for="exampleInputEmail1">Nama</label>
						<input type="text" class="form-control"  name="nm_klien" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Alamat</label>
						<input type="text" class="form-control"  name="alamat" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Pekerjaan</label>
						<input type="text" class="form-control"  name="pekerjaan" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Hp</label>
						<input type="text" class="form-control"  name="hp" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">WA</label>
						<input type="text" class="form-control"  name="wa" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Telegram</label>
						<input type="text" class="form-control"  name="teleg" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">IG</label>
						<input type="text" class="form-control"  name="ig" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">FB</label>
						<input type="text" class="form-control"  name="fb" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Twitter</label>
						<input type="text" class="form-control"  name="twiter" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
						<input type="text" class="form-control"  name="email" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Perusahaan</label>
						<input type="text" class="form-control"  name="nm_perusahaan" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Alamat Perusahaan</label>
						<input type="text" class="form-control"  name="alamat_perusahaan" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Telp</label>
						<input type="text" class="form-control"  name="hp" disabled>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Jabatan</label>
						<input type="text" class="form-control"  name="jabatan" disabled>
				</div>
			</div>	
			<!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-ganti-leads">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('ganti-jenis-klien-leads') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pindah Jenis Customer Ke</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                                <label>
                                     <input type="radio"  name="jenis_klien" class="minimal" value="0" required> Customer
                                </label>
                            <p></p>
                            <small style="color: red">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                </div>
				
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_ubah">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit"  class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->