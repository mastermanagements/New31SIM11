
<div class="modal fade" id="modal-tambah-item-keahlian">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jenis Psikotes</h4>
            </div>
            <form action="{{ url('store-item-keahlian') }}" method="post">
            <div class="modal-body" id="content_modal">
                <div class="form-group">
                    <label>Masukan Item item Keahlian yang anda inginkan dibawah ini:</label>
                    <textarea id="item_keahlian" name="item_keahlian" required></textarea>
                    <input type="hidden" name="id_jabatan_p"/>
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


<div class="modal fade" id="modal-ubah-item-keahlian">
    <div class="modal-dialog modal-lg"  style="width: 90%" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Ubah Jenis Psikotes</h4>
            </div>
            <form action="{{ url('update-item-keahlian') }}" method="post">
                <div class="modal-body" id="content_modal">
                    <div class="form-group">
                        <label>Masukan Item item Keahlian yang anda inginkan dibawah ini:</label>
                        <textarea id="item_ubah_keahlian" name="item_keahlian_ubah" required></textarea>
                        <input type="hidden" name="id_item_keahlian"/>
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