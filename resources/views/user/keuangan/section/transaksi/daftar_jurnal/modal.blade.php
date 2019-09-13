<div class="modal fade" id="modal-transaksi-jurnal">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Ubah Jurnal</h4>
            </div>

                <div class="modal-body">
                          <div class="box  box-danger box-solid">
                            <form action="{{ url('update-jurnal') }}" method="post" onsubmit="return isValidForm()">{{ csrf_field() }}
                                <div class="box-body" >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tanggal</label>
                                                <input type="text" class="form-control " id="datepicker" name="tgl_jurnal" required>
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nomor Transaksi</label>
                                                <input type="text" class="form-control " name="no_transaksi" required readonly>
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Jurnal</label><br>
                                        @foreach($jenis_jurnal as $key => $value)
                                            <label>
                                                <input type="radio" name="jenis_jurnal" id="radio_{{ $key }}" class="minimal-red" value="{{ $key }}" required> {{ $value }}
                                            </label>
                                        @endforeach
                                        <br>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <hr>
                                    <table id="example_rincians" class="table table-bordered table-hover" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Kode Akun</th>
                                            <th>Keterangan Transaksi</th>
                                            <th>Posisi</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th colspan="3">Balance</th>
                                            <th><input id="debit_total"  type="text" readonly class="form-control" style="width: 100%"></th>
                                            <th><input id="kredit_total" type="text" readonly class="form-control" style="width: 100%"></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <hr>
                                    <button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Simpan</button> <label id="notif" style="color: red"></label>
                                </div>
                            </form>
                        </div>
                 </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
