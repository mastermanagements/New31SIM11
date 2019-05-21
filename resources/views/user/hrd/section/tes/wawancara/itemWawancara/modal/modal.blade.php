
<div class="modal fade" id="modal-tambah-item-wawancara">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Item Wawancara</h4>
            </div>
            <form action="{{ url('store-item-wawancara') }}" method="post">
            <div class="modal-body" id="content_modal">
                <div class="form-group">
                    <label>Nama Item Wawancara</label>
                    <input type="text" class="form-control pull-right" placeholder="Item Wawancara" name="item_wawancara" >
                    <!-- /.input group -->
                    <small style="color: red"> *Tidak Boleh Kosong</small>
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


<div class="modal fade" id="modal-ubah-item-wawancara">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Ubah Item Wawancara</h4>
            </div>
            <form action="{{ url('update-item-wawancara') }}" method="post">
                <div class="modal-body" id="content_modal">
                    <div class="form-group">
                        <label>Nama Item Wawancara</label>
                        <input type="text" class="form-control pull-right" placeholder="Nama Item Wawancara" name="item_wawancara_ubah" >
                        <!-- /.input group -->
                        <small style="color: red"> *Tidak Boleh Kosong</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_item_wawancara" >
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