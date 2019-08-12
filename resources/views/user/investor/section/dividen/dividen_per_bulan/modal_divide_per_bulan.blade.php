<div class="modal fade" id="modal-divide-perbulan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Dividen Per Bulan</h4>
            </div>
            <form action="{{ url('store-dividen-per-bulan') }}" method="post" enctype="multipart/form-data" id="formulir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tahun dividen</label>
                    <input type="text" class="form-control" name="thn" id="datepicker" required>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bulan Dividen</label>
                    <input type="text" class="form-control" name="bln_dividen" id="datepicker2" required>
                    <small style="color: red">* Tidak Boleh Kosong</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Laba Rugi</label>
                    <input type="number" class="form-control" name="laba_rugi" required>
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
