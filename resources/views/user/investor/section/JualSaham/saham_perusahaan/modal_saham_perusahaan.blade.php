<div class="modal fade" id="modal-jual-saham-perusahaan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Saham Perdana</h4>
            </div>
            <form action="{{ url('store-jual-saham-perusahaan') }}" method="post" enctype="multipart/form-data" id="formulir">
            <div class="modal-body">
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
                    <label for="exampleInputEmail1">Lembar Saham</label>
                    <input type="number" class="form-control" name="jumlah_persen_saham" required>
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
