
<div class="modal fade" id="modal-timproyek">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Tim Proyek</h4>
            </div>
            <form action="{{ url('store-tim-project') }}" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Karyawan</label>
                        <select class="form-control select2" style="width: 100%;" name="id_ky" required>
                            @if(empty($karyawan))
                                <option>Karyawan masih kosong</option>
                            @else
                                @foreach($karyawan as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama_ky }}</option>
                                @endforeach
                            @endif
                        </select>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jabatan Karyawan Dalam Proyek</label>
                        <input type="text" class="form-control" placeholder="Contoh: Project Manager, Programer Front End, dll" name="jabatan_proyek" required>
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>

                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_proyek">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitTimProyek" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
