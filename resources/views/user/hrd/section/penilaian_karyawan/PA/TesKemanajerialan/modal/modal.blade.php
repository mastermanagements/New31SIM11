
<div class="modal fade" id="modal-tesKemanajerial">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Penilaian Tes Manajerial</h4>
            </div>
            <form action="{{ url('store-tes-kmanajerial') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="thn_tes_km" required>
                    </div>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kompetensi Manajerial</label>
                    <select class="form-control select2"  name="id_kompetensi_m"style="width: 100%" required>
                        @foreach($hkm as $value)
                            <option value="{{ $value->id }}">{{ $value->nm_kompetensi_m }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Item Kompetensi Manajerial</label>
                    <select class="form-control select2" style="width: 100%" name="id_item_km" required>
                        @foreach($him as $value)
                            <option value="{{ $value->id }}">{{ $value->item_kompetensi_m }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Kompetensi 1</label>
                    <input type="number" name="nilai_km1" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Kompetensi 2</label>
                    <input type="number" name="nilai_km2" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Kompetensi 3</label>
                    <input type="number" name="nilai_km3" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Kompetensi 4</label>
                    <input type="number" name="nilai_km4" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Kompetensi 5</label>
                    <input type="number" name="nilai_km5" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <input type="hidden" name="id_ky" class="form-control" required>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">unggah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

