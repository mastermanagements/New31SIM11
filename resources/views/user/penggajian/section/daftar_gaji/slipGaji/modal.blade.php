
<div class="modal fade" id="modal-slip">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Buat Slip</h4>
            </div>
            <form action="{{ url('store-slip-gaji') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Masukan tanggal Gajian</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker"  name="periode" required>
                    </div>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak boleh kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
                <input type="hidden" name="id_ky" value="{{ $id_ky }}">
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

