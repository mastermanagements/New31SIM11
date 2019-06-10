
<div class="modal fade" id="modal-tambah-file-kontrak-kerja">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Unggah Dokumen Kontrak Kerja</h4>
            </div>
            <form action="{{ url('store-updok-kontrak-kerja') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body" id="content_modal">
                <p>Dokumen kontrak kerja yang akan diunggah adalah dokumen yang belum bertanda tangan</p>
                <div class="form-group">
                    <label>File Kontrak Kerja</label>
                    <input type="hidden" name="idKontrak" >
                    <input type="file" class="form-control pull-right"  name="file_kontrak" required >
                    <!-- /.input group -->
                    <small style="color: red"> *format file yang diizinkan rar atau zip</small>
                </div>
            </div>
            <div class="modal-footer">
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


<div class="modal fade" id="modal-ubah-file-kontrak-kerja">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Ubah Jenis Kontrak Kerja</h4>
            </div>
            <form action="{{ url('store-updok-kontrak-kerja-ttd') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body" id="content_modal">
                    <p>Dokumen kontrak kerja yang akan diunggah adalah dokumen yang telah bertanda tangan</p>
                    <div class="form-group">
                        <label>File Kontrak Kerja</label>
                        <input type="hidden" name="idKontrakTtd" >
                        <input type="file" class="form-control pull-right"  name="file_kontrakTtd" required >
                        <!-- /.input group -->
                        <small style="color: red"> *format file yang diizinkan rar atau zip</small>
                    </div>
                </div>
                <div class="modal-footer">
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