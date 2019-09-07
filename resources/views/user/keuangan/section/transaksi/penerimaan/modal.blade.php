<div class="modal fade" id="modal-transaksi-penerimaan">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Transaksi Penerimaan</h4>
            </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box box-danger box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar Transaksi</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-hover table_transaksi" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <!-- Loading (remove the following to stop the loading)-->
                                {{--<div class="overlay">--}}
                                    {{--<i class="fa fa-refresh fa-spin"></i>--}}
                                {{--</div>--}}
                                <!-- end loading -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-8">
                            <div class="box box-success box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Formulir Transaksi Penerimaan</h3>
                                </div>
                                <form action="#" id="form-penerimaan">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{ csrf_field() }}
                                        <label for="exampleInputEmail1">Nama Keteragan</label>
                                        <input type="hidden" name="id_ket_transaksi">
                                        <input type="text" class="form-control" name="nm_transaksi" required>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                        <table id="example3" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Kode Akun/Nama Akun</th>
                                                    <th>Posisi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <button class="btn btn-primary pull-right" type="button" id="addRow"><i class="fa fa-plus"></i> Tambah Akun</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-success" id="simpan" type="button"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                                </form>
                                <!-- /.box-body -->
                                <!-- Loading (remove the following to stop the loading)-->
                                {{--<div class="overlay">--}}
                                    {{--<i class="fa fa-refresh fa-spin"></i>--}}
                                {{--</div>--}}
                                <!-- end loading -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
