<div class="modal fade" id="modal-data-investasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Data Investas</h4>
            </div>
            <form action="{{ url('store-investasi') }}" method="post" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">File KTP</label>
                    <input type="text" class="form-control" id="datepicker"  name="tgl_invest" required>
                    <small style="color: red" >*Tidak boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Periode Investasi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_periode_invest" required>
                        @if(empty($periode_inves))
                            <option>Periode Investasi Masih Kosong</option>
                        @else
                            @foreach($periode_inves as $value)
                                <option value="{{ $value->id }}" @if($value->dataInvetasi->sum('jumlah_saham')==$value->saham_real->jum_saham) disabled="disabled" @endif> {{ str_limit($value->nm_periode,40) }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red" >*Tidak boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Investor</label>
                    <select class="form-control select2" style="width: 100%;" name="id_investor" required>
                        @if(empty($data_investor))
                            <option>Investor Masih Kosong</option>
                        @else
                            @foreach($data_investor as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_investor }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red" >*Tidak boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Saham</label>
                     <input type="number" name="jumlah_saham" class="form-control" required>
                    <small style="color: red" >*Tidak boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bentuk Investasi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_bentuk_invest" required>
                        @if(empty($bentuk_investor))
                            <option>Bentuk Investasi</option>
                        @else
                            @foreach($bentuk_investor as $value)
                                <option value="{{ $value->id }}" >{{ $value->bentuk_investasi }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red" >*Tidak boleh Kosong</small>
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
