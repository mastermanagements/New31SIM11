
<div class="modal fade" id="modal-tambah-file-spk">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('upload-file-spk') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Unggah SPK</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile">File SPK</label>
                        <input type="file" id="exampleInputFile" name="file_kotrak" required>
                        <input type="hidden" name="id_spk">
                        <small id="cek_file"></small>
                        <p class="help-block" style="color:red">*Format file yang disarankan .rar atau .zip</p>
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


<div class="modal fade" id="modal-tambah-file-scan-spk">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('upload-scan-spk') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Unggah Scan Proposal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile">File Scan Spk</label>
                        <input type="file" id="exampleInputFile" name="file_scan" required>
                        <input type="hidden" name="id_file_scan">
                        <small id="cek_file"></small>
                        <p class="help-block" style="color:red">*Format file yang disarankan .rar atau .zip</p>
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