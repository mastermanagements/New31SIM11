<div class="modal fade" id="modal-pelaksana">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Mudharib (pelaksana)</h4>
            </div>
            <form action="{{ url('store-divinden-investor') }}" method="post" enctype="multipart/form-data" id="formulirss">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Karyawan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_ky" required>
                        @if(empty($data_investasi))
                            <option>Data Investor Masih Kosong</option>
                        @else
                            @foreach($data_investasi as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_investor }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Dividen Bulanan</label>
                    <select class="form-control select2" style="width: 100%;" name="id_bentuk_invest" required>
                        @if(empty($dividen_bulanan))
                            <option>Dividen Masih Kosong</option>
                        @else
                            @foreach($dividen_bulanan as $value)
                                <option value="{{ $value->id }}" style="padding-left: 300px">
                                    <label >{{ date('M', strtotime($value->bln_dividen)) }} {{ $value->thn_dividen }} - Net kas: {{ $value->net_kas }}</label>
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
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
