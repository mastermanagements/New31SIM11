
<div class="modal fade" id="modal-kpi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir KPI Karyawan</h4>
            </div>
            <form action="{{ url('store-kpi-karyawan') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="thn_kpi" required>
                    </div>
                    <!-- /.input group -->
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Karyawan</label>
                    <select class="form-control select2"  name="id_ky"style="width: 100%" required>
                        @foreach($ky as $value)
                            <option value="{{ $value->id }}">{{ $value->nama_ky }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
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
                    <label for="exampleInputEmail1">KPI</label>
                    <select class="form-control select2" style="width: 100%" name="id_kpi" required>
                        @foreach($kpi as $value)
                            <option value="{{ $value->id }}">{{ $value->nm_kpi }}</option>
                        @endforeach
                    </select>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Realisasi KPI</label>
                    <input type="number" name="realisasi_kpi" class="form-control" required>
                    <small style="color: red" >* Tidak Boleh Kosong</small>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputEmail1">Target KPI</label>--}}
{{--                    <input type="text" name="target_kpi" class="form-control" required>--}}
{{--                    <small style="color: red" >* Tidak Boleh Kosong</small>--}}
{{--                </div>--}}


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

