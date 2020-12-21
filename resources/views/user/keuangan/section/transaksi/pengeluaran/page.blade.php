<div class="tab-pane active" id="tab_1">
  <div class="row">
      {{--<div class="col-md-12">--}}
          {{--<button class="btn btn-danger" data-toggle="modal" data-target="#modal-transaksi-pengeluaran">Catata Transaksi Pengeluaran</button>--}}
      {{--</div>--}}
      <div class="col-md-12">
          @if(!empty(session('message_success')))
              <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
          @elseif(!empty(session('message_fail')))
              <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
          @endif
      </div>
       <div class="col-md-12" style="margin-top: 10px">
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
                                   <th>Aksi</th>
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
                           <h3 class="box-title">Formulir Transaksi Pengeluaran</h3>
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

  {{--@include('user.keuangan.section.transaksi.pengeluaran.modal')--}}

</div>