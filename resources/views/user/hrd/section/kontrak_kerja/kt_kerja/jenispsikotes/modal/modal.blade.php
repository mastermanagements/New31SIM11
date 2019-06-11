
<div class="modal fade" id="modal-tambah-jenis-psikotes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jenis Kontrak Kerja</h4>
            </div>
            <form action="{{ url('store-jenis-kontrak-kerja') }}" method="post">
            <div class="modal-body" id="content_modal">
                <div class="form-group">
                    <label>Jenis Kontrak Kerja</label>
                    <input type="text" class="form-control pull-right" placeholder="Jenis Kontrak Kerja" name="jenis_kontrak_kerja" >
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


<div class="modal fade" id="modal-ubah-jenis-psikotes">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Ubah Jenis Kontrak Kerja</h4>
            </div>
            <form action="{{ url('update-jenis-kontrak-kerja') }}" method="post">
                <div class="modal-body" id="content_modal">
                    <div class="form-group">
                        <label>Jenis Kontrak Kerja</label>
                        <input type="text" class="form-control pull-right" placeholder="Jenis Kontrak Kerja" name="jenis_kontrak_kerja_ubah" >
                        <!-- /.input group -->
                        <small style="color: red"> *Tidak Boleh Kosong</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_jenis_kontrak_kerja" >
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