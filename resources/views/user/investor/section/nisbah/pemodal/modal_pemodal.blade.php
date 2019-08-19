<div class="modal fade" id="modal-pemodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Pemodal</h4>
            </div>
            <form action="{{ url('store-pemodal') }}" method="post" enctype="multipart/form-data" id="formulirs">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Investasi</label>
                    <input type="text" class="form-control" name="tgl_invest" id="datepicker"  required>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Periode Investasi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_periode_invest" required>
                        @if(empty($data_pi))
                            <option>Bentuk Investasi Masih Kosong</option>
                        @else
                            @foreach($data_pi as $value)
                                <option value="{{ $value->id }}" style="padding-left: 300px"
                                        {{--@if(!empty($value->dataPelaksana)) @if($value->dataPelaksana->sum('persen_saham') == 100) disabled="disabled" @endif @endif--}}
                                >
                                    {{ $value->nm_periode }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Investor</label>
                    <select class="form-control select2" style="width: 100%;" name="id_investor" required>
                        @if(empty($data_idi))
                            <option>Investor Masih Kosong</option>
                        @else
                            @foreach($data_idi as $value)
                                <option value="{{ $value->id }}" style="padding-left: 300px" >
                                    {{ $value->nm_investor }}
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
                    <input type="number" class="form-control" name="persen_saham" required>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="exampleInputEmail1">Nilai Saham</label>--}}
                    {{--<input type="number" class="form-control" name="nilai_saham" required>--}}
                    {{--<small style="color: red">* Tidak Boleh Kosong</small>--}}
                {{--</div>--}}
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
