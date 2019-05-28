
<div class="modal fade" id="modal-upload-rekruimen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Bagian Perusahaan</h4>
            </div>
            <form action="{{ url('upload-loker') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">File Rekruitmen</label>
                    <input type="file" class="form-control" name="file_loker" required>
                    <small style="color: red" >* format file .jpg, .png, .jpeg, .gif</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                {{ csrf_field() }}
                <input type="hidden" name="idLoker">
                <button type="submit" class="btn btn-primary">unggah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-ubah-bagian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Bagian Perusahaan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Bagian Perusahaan</label>
                    <input type="text" class="form-control" placeholder="Contoh: Manager HRD" name="nm_bagian_ubah">
                    <small style="color: red" id="notify"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" id="submitUbahBagian" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->