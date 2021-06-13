
<div class="modal fade" id="modal-tambah-jabatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jabatan Karyawan</h4>
            </div>
            <form action="{{ url('store-jabatan-ky') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body" >

                    <div class="form-group">
                        <label for="exampleInputEmail1">Jabatan</label>
                        <input type="hidden" name="id_ky">
                        <select class="form-control select2" style="width: 100%;" name="id_jabatan_p" required>
                            @if(empty($jabatan))
                                <option>Pokok Cf Masih Kosong</option>
                            @else
                                @foreach($jabatan as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai Menjabat</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Mulai Menjabat" name="mulai_menjabat" required>
                        </div>
                        <!-- /.input group -->
                        <small style="color: red">* Tidak boleh kosong</small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Berakhir Menjabat</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Selesai menjabatan" name="selesai_menjabat">
                        </div>
                        <!-- /.input group -->
                        <small style="color: red">* Tidak boleh kosong</small>
                    </div>
                    <div class="form-group">
                        <label>Status Jabatan</label>
                        <p>
                            <input type="radio" name="status_jabatan" value="aktif"> Masih Menjabatan <br>
                            <input type="radio" name="status_jabatan" value="non aktif"> Jabatan berakhir <br>
                        </p>
                        <!-- /.input group -->
                        <small style="color: red">* Tidak boleh kosong</small>
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
