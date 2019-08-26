
<div class="modal fade" id="modal-bonus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Tambahan Pendapatan</h4>
            </div>
            <form action="{{ url('store-bonus-gaji') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Proyek</label>
                    <select class="form-control select2" style="width: 100%;" name="id_proyek">

                        @if(empty($proyek))
                            <option>sub Cf Masih Kosong</option>
                        @else
                            <option value="null">Pilih Proyek</option>
                            @foreach($proyek as $value)
                                <option value="{{ $value->id }}">{{ $value->spk->nm_spk }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: orange">*Pilih Proyek jika bonus berasal dari proyek</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Klasifikasi Proyek</label>
                    <select class="form-control select2" style="width: 100%;" name="id_kelas">
                        @if(empty($klasifikasi))
                            <option>sub Cf Masih Kosong</option>
                        @else
                            <option value="null">Pilih Klasifikasi</option>
                            @foreach($klasifikasi as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_kelas }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: orange">*Pilih klasifikasi proyek jika bonus berasal dari proyek</small>
                </div>
                <div class="form-group">
                    <label>Nama Bonus</label>
                    <input class="form-control pull-right" name="nm_bonus" required>
                    <!-- /.input group -->
                    <small style="color: orange">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                    <label>Besaran Bonus Proyek</label>
                    <input type="number"  class="form-control pull-right" name="jumlah_bonus" required>
                    <!-- /.input group -->
                    <small style="color: orange">* Tidak boleh kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_ky" value="{{ $data_slip->karyawan->id }}">
                <input type="hidden" name="id_slip" value="{{ $data_slip->id }}">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

