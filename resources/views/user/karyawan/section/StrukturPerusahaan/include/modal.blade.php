
<div class="modal fade" id="modal-tambah-bagan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Bagan Perusahaan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Parent ID</label>
                    <select class="form-control select2" style="width: 100%;" name="parentId" required>
                        <option value="null">Tingkat tertinggi</option>
                        @foreach($parentID as $value)
                            <option value="{{ $value->id }}">{{ $value->getKaryawan->nama_ky }}</option>
                       @endforeach
                    </select>
                    <small style="color: orange" id="notify"> Biarkan kosong jika jabatan tertinggi </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Karyawan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_karyawan" required>
                        <option disabled>Pilih Karyawan</option>
                        @foreach($data_karyawan as $value)
                            <option value="{{ $value->id }}">{{ $value->nama_ky }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" id="notify">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_jabatan" required>
                        <option disabled>Pilih Jabatan</option>
                        @foreach($jabatan as $value)
                            <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" id="notify">* Tidak boleh kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" id="storeBagan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-ubah-bagan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Bagan Perusahaan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Parent ID</label>
                    <select class="form-control select2" style="width: 100%;" name="parentId_ubah" required>
                        <option value="null">Tingkat tertinggi</option>
                        @foreach($parentID as $value)
                            <option value="{{ $value->id }}">{{ $value->getKaryawan->nama_ky }}</option>
                        @endforeach
                    </select>
                    <small style="color: orange" id="notify"> Biarkan kosong jika jabatan tertinggi </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Karyawan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_karyawan_ubah" required>
                        <option disabled>Pilih Karyawan</option>
                        @foreach($data_karyawan as $value)
                            <option value="{{ $value->id }}">{{ $value->nama_ky }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" id="notify">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_jabatan_ubah" required>
                        <option disabled>Pilih Jabatan</option>
                        @foreach($jabatan as $value)
                            <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" id="notify">* Tidak boleh kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" id="updateBagan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
