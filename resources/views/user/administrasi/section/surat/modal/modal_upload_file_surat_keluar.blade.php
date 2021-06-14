 
<div class="modal fade" id="modal-tambah-file-surat-keluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('upload-surat-keluar') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir unggah surat keluar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile">File scan surat keluar</label>
                        <input type="file" id="exampleInputFile" name="file_surat" required>
                        <input type="hidden" id="exampleInputFile" name="id">
                        <small id="cek_file"></small>
                        <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png, .gif</p>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
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


<div class="modal fade" id="modal-ubah-status-surat">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('upload-status-surat-keluar') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Status Surat</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status Kirim Surat</label>
                        <div class="form-group">
                                <label>
                                    <input type="radio"  name="status_surat" class="minimal" value="0" required> Belum Terkirim
                                </label>
                                <label>
                                    <input type="radio"  name="status_surat" class="minimal" value="1" required> Sudah Terkirim
                                </label>
                            <p></p>
                            <small style="color: red">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
					<div class="form-group">
                                <label>Tanggal surat dikirim</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal surat dikirim" name="tgl_dikirim" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
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
