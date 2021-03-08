
<div class="modal fade" id="modal-tambah-jabatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jabatan Perusahaan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Jabatan Perusahaan</label>
                    <input type="text" class="form-control" placeholder="Contoh: Direktur" name="nm_jabatan">
                    <small style="color: red" id="notify"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Level Jabatan</label>
                    <div class="form-group">
                        <label>
                            <input type="radio"  name="level_jabatan" class="minimal" value="0" required>
                            Direksi/Eksekutif/C Level &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="level_jabatan" class="minimal" value="1">
                            Manager &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="level_jabatan" class="minimal" value="2">
                            Supervisor &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="level_jabatan" class="minimal" value="3">
                            Staf / Operator
                        </label>
                        <small style="color: red" id="notify"></small>
                    </div>

                </div>

            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" id="submitJabatan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-ubah-jabatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jabatan Perusahaan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Jabatan Perusahaan</label>
                    <input type="text" class="form-control" placeholder="Contoh: Manager HRD" name="nm_jabatan_ubah">
                    <small style="color: red" id="notify"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" id="submitUbahJabatan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
