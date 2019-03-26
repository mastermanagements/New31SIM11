<div class="modal fade" id="modal-ubah-alamat-asal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Alamat Asal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat Asal</label>
                        <textarea class="form-control" name="alamat_asal"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Provinsi</label>
                        <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                            <option>Pilih Provinsi</option>
                            @foreach($provinsi as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kabupaten</label>
                        <select class="form-control select2" style="width: 100%;" name="id_kabupaten" required>
                            <option>Pilih Kabupaten</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="button" id="submitAlamatAsal" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
