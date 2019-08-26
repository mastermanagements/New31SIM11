
<div class="modal fade" id="modal-tesKemanajerial">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Penilaian Tes Kompetensi Teknis</h4>
            </div>
            <form action="{{ url('store-tes-kteknis') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="thn_tes_kt" required>
                    </div>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kompetensi Teknis</label>
                    <select class="form-control select2"  name="id_kompetensi_t"style="width: 100%" required>
                        @foreach($kt as $value)
                            <option value="{{ $value->id }}">{{ $value->nm_kompetensi_t }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Item Kompetensi Teknis</label>
                    <select class="form-control select2" style="width: 100%" name="id_item_kt" required>
                        @foreach($hit as $value)
                            <option value="{{ $value->id }}">{{ $value->item_kompetensi_t }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Kompetensi</label>
                    <input type="number" name="nilai_kt" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
               <input type="hidden" name="id_ky" class="form-control" value="{{ $ky->id }}" required>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
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

