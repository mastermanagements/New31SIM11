<div class="modal fade" id="modal-sub-akun">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Ubah Sub Akun</h4>
            </div>
            <form action="#" method="post" id="formulir_sub">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Akun</label>
                        <input type="text" class="form-control" name="kode_sub" required>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Akun</label>
                        <input type="text" class="form-control" name="nm_sub" required>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Posisi Saldo</label>
                        <select class="form-control" name="posisi_saldo" required>
                            <option about="">Pilih Posisi saldo</option>
                            @foreach($posisi as $key=> $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    {{ csrf_field() }}
                    <input type="hidden" name="id_sub">
                    <input type="hidden" name="id_akun_ukm">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="modal-sub-sub-akun">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Sub Sub Akun</h4>
            </div>
            <form action="#" method="post" id="formulir_sub_sub">
                <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Akun</label>
                            <input type="text" class="form-control" name="kode_sub_sub" required>
                            <small style="color: red">* Tidak Boleh Kosong</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Akun</label>
                            <input type="text" class="form-control" name="nm_sub_sub" required>
                            <small style="color: red">* Tidak Boleh Kosong</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi Saldo</label>
                            <select class="form-control" name="posisi_saldo" required>
                                <option about="">Pilih Posisi saldo</option>
                                @foreach($posisi as $key=> $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <small style="color: red">* Tidak Boleh Kosong</small>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    {{ csrf_field() }}
                    <input type="hidden" name="id_sub_sub">
                    <input type="hidden" name="id_sub_akun_ukm">
                    <button type="submit" class="btn btn-primary">Simpanw</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->