
<div class="modal fade" id="modal-subcf">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Sub Compansable Factors</h4>
            </div>
            <form action="{{ url('store-sub-cf') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Sub Compansable Factors </label>
                    <input type="text" class="form-control"  name="sub_faktor" required>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">definisi</label>
                    <textarea class="form-control" name="definisi" required></textarea>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bobot</label>
                    <input type="number" class="form-control "  name="bobot_subcf" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
                <input type="hidden" name="id_cf">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">unggah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

