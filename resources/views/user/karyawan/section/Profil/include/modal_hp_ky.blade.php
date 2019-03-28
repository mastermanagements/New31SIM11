<div class="modal fade" id="modal-tambah-handphone">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir No. Handphone</h4>
            </div>
            <form action="{{ url('tambah-alamat-handphone-ky') }}" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">No. Handphone</label>
                    <input type="text" class="form-control" placeholder="+62 82199219950" name="hp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No. Handphone bisa dihubungi dengan</label>
                    <input type="text" class="form-control" placeholder="Wa, Telegram, Telp, Sms" name="status_hp" required>
                </div>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
