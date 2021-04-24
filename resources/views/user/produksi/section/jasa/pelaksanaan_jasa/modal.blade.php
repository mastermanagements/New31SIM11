<script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
<!--tambah jobdesc-->
<div class="modal fade" id="modal-tambah-doservice">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form action="{{ url('store-doservice') }}" method="post">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Formulir Pengerjaan Service</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Proses Bisnis</label>
                         <select class="form-control select2" style="width: 100%;" name="id_proses_bisnis" required>
                            @foreach($proses_bisnis as $probis)
                              <option value="{{ $probis->id }}" >{{ $probis->proses_bisnis }}</option>
                            @endforeach
                          </select>
                          <small style="color: red" id="notify"></small>
                          <input type="hidden" name="id_detail_oj">
                          <input type="hidden" name="yg_mengerjakan" value="{{ $karyawan}}"></input>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mulai Pekerjaan</label>
                    <input type="text" class="form-control" name="tgl_jam_mulai" value="{{ date('Y-m-d H:i:s') }}" readonly></input>
                    <small style="color: red" id="notify"></small>
                </div>
                <div class="modal-footer">
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" id="submitPL" class="btn btn-primary">Simpan</button>
                </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>

  <!--ubah PL awal-->
  <div class="modal fade" id="modal-ubah-PLAwal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form action="{{ url('update-PLAwal')}}" method="post">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Formulir Input Apa Yang Dikerjaan</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Apa Yang dikerjaan</label>
                          <textarea class="form-control"  name="what_do"  required></textarea>
                          <small style="color: red" id="notify"></small>
                          <input type="hidden" name="id_pl">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Mulai Pekerjaan</label>
                          <input type="text" readonly class="form-control" name="tgl_jam_do" value="{{ date('Y-m-d H:i:s') }}" required></input>
                      </div>
                  </div>
                  <div class="modal-footer">
                      {{ csrf_field() }}
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                      <button type="submit" id="submitPLAwal" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  	<!-- /.modal -->

  <div class="modal fade" id="modal-ubah-PLSelesai">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('update-PLSelesai')}}" method="post">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Formulir Input Hasil Pekerjaan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hasil Pekerjaan</label>
                            <textarea class="form-control"  name="what_result"  required></textarea>
                            <small style="color: red" id="notify"></small>
                            <input type="hidden" name="id_pl">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Selesai Pekerjaan</label>
                            <input type="text" readonly class="form-control" name="tgl_jam_finish" value="{{ date('Y-m-d H:i:s') }}" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" id="submitPLSelesai" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    	<!-- /.modal -->
      <!--./ubah confirm klien -->
      <div class="modal fade" id="modal-ubah-PLConfirm">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ url('update-PLConfirm')}}" method="post">
                        <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulir Input Konfirmasi Hasil Ke Klien</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Respon Klien</label>
                                <textarea class="form-control"  name="what_respon"  required></textarea>
                                <small style="color: red" id="notify"></small>
                                <input type="hidden" name="id_pl">
                                <input type="hidden" name="yg_mengkonfirmasi"></input>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Konfirmasi</label>
                                <input type="text" readonly class="form-control" name="tgl_jam_konfirm" value="{{ date('Y-m-d H:i:s') }}" required>
                            </div>


                        </div>
                        <div class="modal-footer">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                            <button type="submit" id="submitPLConfirm" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
          <!-- /.modal -->
          <!--./ubah status akhir service-->
          <div class="modal fade" id="modal-ubah-PLStatusAkhir">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ url('update-PLStatusAkhir')}}" method="post">
                            <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Formulir Input Status Service</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleInputFile">Status Service</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_target_superv_ubah" required>
                                          <option value="0">Pilih Status Service</option>
                                          @foreach($status_perproses as $index => $value)
                    												  @if(!empty($data_pl->status_service))
                    													<option value="{{ $index }}" {{ $index == $data_pl->status_service ? 'selected' : '' }}>
                                                  {{ $value }}
                                              </option>
                    												  @else
                    													<option value="{{ $index }}"}}>
                                                {{ $value }}
                                              </option>
                    												  @endif
                    											@endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="modal-footer">
                                {{ csrf_field() }}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="submit" id="submitPLStatusService" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
              <!-- /.modal -->
<script>
       window.onload = function() {
           CKEDITOR.replace( 'what_do',{
                height: 150
           } );
           CKEDITOR.replace( 'what_result',{
                height: 150
           } );
           CKEDITOR.replace( 'what_respon',{
                height: 150
           } );

       };

</script>
