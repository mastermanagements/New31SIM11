
<div class="modal fade" id="modal-tambah-file-cover-proposal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('upload-cover-proposal') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Unggah Cover Proposal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile">File cover proposal</label>
                        <input type="file" id="exampleInputFile" name="cover_prop" required>
                        <input type="hidden" name="id_cover_proposal">
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


<div class="modal fade" id="modal-tambah-file-doc-proposal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('upload-doc-proposal') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Unggah Dokumen Proposal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile">File Dokumen Proposal</label>
                        <input type="file" id="exampleInputFile" name="doc_prop" required>
                        <input type="hidden" name="id_doc_proposal">
                        <small id="cek_file"></small>
                        <p class="help-block" style="color:red">*Format file yang disarankan .rar</p>
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