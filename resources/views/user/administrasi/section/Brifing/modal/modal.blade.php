
<div class="modal fade" id="modal-tambah-jenis-surat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jenis Rapat</h4>
            </div>
            <form action="{{ url('store-jenis-rapat') }}" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukan Jenis Rapat</label>
                    <input type="text" class="form-control" placeholder="Contoh: Briefing, Rapat harian, Rapat Mingguan, dll" name="jenis_rapat" required>
                    <small style="color: red" id="notify"></small>
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


<div class="modal fade" id="modal-ubah-jenis-surat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jenis Rapat</h4>
            </div>
            <form action="{{ url('update-jenis-rapat') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Masukan Jenis Rapat</label>
                        <input type="text" class="form-control" placeholder="Contoh: Briefing, Rapat harian, Rapat Mingguan, dll" name="jenis_rapat_ubah" required>
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id">
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
