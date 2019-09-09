<div class="tab-pane active" id="tab_1">
  <div class="row">
      <div class="col-md-12">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modal-transaksi-penerimaan">Catata Transaksi Penerimaan</button>
      </div>
       <div class="col-md-12" style="margin-top: 10px">
            <div class="box  box-danger box-solid">
                <form action="{{ url('store-jurnal') }}" method="post">{{ csrf_field() }}
                <div class="box-body" >
                    <div class="form-group">
                        <label for="exampleInputEmail1">Catatan transaksi</label>
                        <input type="hidden" name="id_ket_transaksi">
                        <select class="form-control select2" style="width: 100%" id="id_transaksi" required>
                            <option>Pilih Catatan Transaksi</option>
                            @foreach($keterangan as $value)
                                <option value="{{ $value->id }}"> {{ $value->nm_transaksi }}</option>
                            @endforeach
                        </select>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
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
                                <input type="text" class="form-control " name="no_transaksi" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Jurnal</label><br>
                        @foreach($jenis_jurnal as $key => $value)
                            <label>
                                <input type="radio" name="jenis_jurnal" class="minimal-red" value="{{ $key }}" required> {{ $value }}
                            </label>
                        @endforeach
                        <br>
                        <small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
                    <hr>
                    <table id="example_rincian" class="table table-bordered table-hover">
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
                    <button class="btn btn-success" ><i class="fa fa-plus"></i> Simpan</button>
                </div>
                </form>
            </div>
       </div>
  </div>

  @include('user.keuangan.section.transaksi.penerimaan.modal')

</div>