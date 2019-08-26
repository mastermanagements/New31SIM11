<div class="modal fade" id="modal-jual-saham-investor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Jual Saham Investor</h4>
            </div>
            <form action="{{ url('store-jual-saham-investor') }}" method="post" enctype="multipart/form-data" id="formulir_inves">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Jual</label>
                    <input type="text" class="form-control" name="tgl_jual_s" id="datepicker" required>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Periode Investasi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_periode_invest" required>
                        @if(empty($periode_inves))
                            <option>Periode Investasi Masih Kosong</option>
                        @else
                            @foreach($periode_inves as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_periode }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Investor Penjual</label>
                    <select class="form-control select2" style="width: 100%;" name="id_investor_penjual" required>
                        @if(empty($investor))
                            <option>Investor Masih Kosong</option>
                        @else
                            @foreach($investor as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_investor }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah dijual</label>
                    <input type="number" class="form-control" name="jumlah_dijual" required>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Investor Pembeli</label>
                    <select class="form-control select2" style="width: 100%;" name="id_investor_pembeli" required>
                        @if(empty($investor))
                            <option>Investor Masih Kosong</option>
                        @else
                            @foreach($investor as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_investor }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
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
