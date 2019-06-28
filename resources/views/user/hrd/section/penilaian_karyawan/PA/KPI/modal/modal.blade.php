
<div class="modal fade" id="modal-kpi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir KPI</h4>
            </div>
            <form action="{{ url('store-kpi') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Area Kinerja utama</label>
                    <select class="form-control select2" style="width: 100%" name="id_aku" required>
                        @foreach($H_aku as $value)
                            <option value="{{ $value->id }}">{{ $value->nm_aku }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama KPI</label>
                    <input type="text" name="nm_kpi" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bobot KPI</label>
                    <input type="number" name="bobot_kpi" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Target KPI</label>
                    <input type="number" name="target_kpi" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Satuan KPI</label>
                    <select class="form-control select2"  name="id_satuan"style="width: 100%" required>
                        @foreach($satuanKPi as $value)
                            <option value="{{ $value->id }}">{{ $value->satuan_kpi }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jenis KPI</label>
                    <select class="form-control select2" name="id_jenis_kpi" style="width: 100%" required>
                        @foreach($jenisKpi as $value)
                            <option value="{{ $value->id }}">{{ $value->jenis_kpi }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
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

