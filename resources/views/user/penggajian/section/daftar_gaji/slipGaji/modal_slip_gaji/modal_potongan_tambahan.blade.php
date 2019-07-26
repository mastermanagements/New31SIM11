
<div class="modal fade" id="modal-potongan-tambahan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Potongan Tambahan</h4>
            </div>
            <form action="{{ url('store-potongan-tambahan') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control pull-right" name="keterangan" required></textarea>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                    <label>Jumlah Potongan</label>
                    <input type="number" class="form-control pull-right" name="jumlah_potongan" required>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak boleh kosong</small>
                </div>
            </div>
            <div class="modal-footer">
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

