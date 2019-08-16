<div class="modal fade" id="modal-pelaksana">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Mudharib (pelaksana)</h4>
            </div>
            <form action="{{ url('store-pelaksana') }}" method="post" enctype="multipart/form-data" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Karyawan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_ky" required>
                        @if(empty($data_ky))
                            <option>Data Karyawan Masih Kosong</option>
                        @else
                            @foreach($data_ky as $value)
                                <option value="{{ $value->id }}" >{{ $value->nama_ky }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Periode Investasi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_periode_invest" required>
                        @if(empty($data_pi))
                            <option>Bentuk Investasi Masih Kosong</option>
                        @else
                            @foreach($data_pi as $value)
                                <option value="{{ $value->id }}" style="padding-left: 300px" @if(!empty($value->dataPelaksana)) @if($value->dataPelaksana->sum('persen_saham') == 100) disabled="disabled" @endif @endif>
                                    {{ $value->nm_periode }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bentuk Investasi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_bentuk_invest" required>
                        @if(empty($data_bi))
                            <option>Bentuk Investasi Masih Kosong</option>
                        @else
                            @foreach($data_bi as $value)
                                <option value="{{ $value->id }}" style="padding-left: 300px">
                                    {{ $value->bentuk_investasi }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Persen Saham</label>
                    <input type="number" min="0" max="100"  class="form-control" name="persen_saham">
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="return window.location.reload()">Batal</button>
                {{ csrf_field() }}
                <input type="hidden" name="id">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
