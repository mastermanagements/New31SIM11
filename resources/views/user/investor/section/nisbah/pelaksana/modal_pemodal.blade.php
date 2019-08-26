<div class="modal fade" id="modal-i-pelaksana">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Nisbah Pelaksana</h4>
            </div>
            <form action="{{ url('store-nisbah-pelaksana') }}" method="post" enctype="multipart/form-data" id="formulirs1">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pelaksana</label>
                        <select class="form-control select2" style="width: 100%;" name="id_pelaksana" required>
                            @if(empty($pelaksana))
                                <option>Pelaksana Masih Kosong</option>
                            @else
                                @foreach($pelaksana as $value)
                                    <option value="{{ $value->id }}" style="padding-left: 300px">
                                        {{ $value->karyawan->nama_ky }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Bulan Dividen</label>
                        <select class="form-control select2" style="width: 100%;" name="id_bulan_dividen" required>
                            @if(empty($BDM))
                                <option>Bulan Dividen Masih Kosong</option>
                            @else
                                @foreach($BDM as $key=> $value)
                                    <optgroup label="Tahun {{ $key }}" style="background-color: green">
                                        @php($index=0)
                                        @foreach($value->groupBy('id_periode_invest') as $periode => $data_periode)
                                            <optgroup style="color: cornflowerblue;" label="Periode :{{ $data_periode[$index++]->periode_invest->nm_periode }}"> </optgroup>
                                            @foreach($data_periode as $per => $values)
                                                <option value="{{ $values->id }}">Bulan {{ $ymd->month->semua_bulan[$values->bln_dividen] }} - Net Kas: <label>{{ $values->net_kas }}</label> </option>
                                            @endforeach
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @endif
                        </select>
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

