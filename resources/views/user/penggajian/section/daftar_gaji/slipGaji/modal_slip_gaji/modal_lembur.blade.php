
<div class="modal fade" id="modal-lembur">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Lembur</h4>
            </div>
            <form action="{{ url('store-lembur') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Jumlah Lembur</label>
                    <input type="text" class="form-control pull-right" name="jum_lembur" required>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                    <label>Total Uang Lembur</label>
                    <input type="number" class="form-control pull-right" name="jum_besaran_lembur" required>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak boleh kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_lembur">
                <input type="hidden" name="id_ky" value="{{ $data_slip->karyawan->id }}">
                <input type="hidden" name="id_slip" value="{{ $data_slip->id }}">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

