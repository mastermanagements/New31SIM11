
<div class="modal fade" id="modal-tambah-devisi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('store-divisi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Divisi Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Divisi Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Manager HRD" name="nm_devisi" required>
                        <small style="color: red" id="notify">*Tidak boleh kosong</small>
                        <input type="hidden" name="id_bagian">
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitDevisi" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-ubah-divisi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('update-divisi') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Divisi Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Bagian Perusahaan</label>
                        <select class="form-control select2" style="width: 100%;" name="id_bagian_ubah" required>
                            <option disabled>Pilih Bagian</option>
                            @foreach($Bagian as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_bagian }}</option>
                            @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Divisi Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Manager HRD" name="nm_divisi_ubah">
                        <input type="hidden" name="id_devisi">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahBagian" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
