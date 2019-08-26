
<div class="modal fade" id="modal-upload-ktp-inves">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Unggah Foto KTP</h4>
            </div>
            <form action="{{ url('upload-ktp-invest') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">File KTP</label>
                    <input type="file" class="form-control" name="file_ktp" required>
                    <small style="color: red" >* format file .jpg, .png, .jpeg, .gif</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                {{ csrf_field() }}
                <input type="hidden" name="id_inves">
                <button type="submit" class="btn btn-primary">unggah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-upload-photo-inves">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Unggah Pas Foto KTP</h4>
            </div>
            <form action="{{ url('upload-photo-invest') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">File KTP</label>
                        <input type="file" class="form-control" name="file_pas_foto" required>
                        <small style="color: red" >* format file .jpg, .png, .jpeg, .gif</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    {{ csrf_field() }}
                    <input type="hidden" name="id_invess">
                    <button type="submit" class="btn btn-primary">unggah</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->