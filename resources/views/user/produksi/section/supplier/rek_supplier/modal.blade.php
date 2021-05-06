
<!--tambah jobdesc-->
<div class="modal fade" id="modal-tambah-rekSupplier">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Formulir Tambah Rekening Supplier</h4>
        </div>
          <form action="{{ url('RekSupplier') }}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Bank</label>
                <input name="nama_bank" class="form-control" placeholder="Nama Bank" required>
                <small style="color: red">* Tidak boleh kosong</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">No Rekening</label>
                <input name="no_rek" class="form-control" placeholder="No. Rekening" required>
                <small style="color: red">* Tidak boleh kosong</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Atas Nama</label>
                <input name="atas_nama" class="form-control" placeholder="Pemilik Rekening Atas Nama Siapa" required>
                <small style="color: red">* Tidak boleh kosong</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kantor Cabang</label>
                <input type="text" name="kcp" class="form-control" placeholder="Kantor Cabang">
                <input type="hidden" name="id_supplier">

            </div>
                <div class="modal-footer">
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" id="submitPL" class="btn btn-primary">Simpan</button>
                </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
