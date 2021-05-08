  <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
<!--tambah jobdesc-->
<div class="modal fade" id="modal-tambah-jobdesc">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form action="{{ url('store-jobdesc') }}" method="post">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Formulir Tambah Jobdesc</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Atasan</label>
                         <select class="form-control select2" style="width: 100%;" name="atasan" required>
                                <option>Pilih Atasan</option>
                                @foreach($data_jabatan as $jabatan)
                                   <option value="{{ $jabatan->id }}" >{{ $jabatan->nm_jabatan }}</option>
                                @endforeach
                            </select>
                              <small style="color: red" id="notify"></small>
                </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Ruang Lingkup</label>
                      <textarea class="form-control"  name="ruang_lingkup" id="ruang_lingkup" required></textarea>
                      <small style="color: red">* Tidak boleh kosong</small>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Hubungan Ke Dalam</label>
                      <input type="text" class="form-control" name="hub_kedalam" required>
                      <small style="color: red">* Tidak boleh kosong</small>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Hubungan Ke Luar</label>
                      <input type="text" class="form-control" name="hub_keluar" required>
                      <small style="color: red">* Tidak boleh kosong</small>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Pelimpahan Wewenang</label>
                      <input type="text" class="form-control" name="limpahan_wewenang" required>
                      <small style="color: red">* Tidak boleh kosong</small>
                      <input type="hidden" name="id_jabatan_p">
                  </div>


        <div class="modal-footer">
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" id="submitJObdesc" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>

<!--tambah tugas jobdesc-->
<div class="modal fade" id="modal-tambah-tugas">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form action="{{ url('store-tugas') }}" method="post">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Formulir Tambah Tugas</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tugas Pekerjaan</label>
                      <input type="text" class="form-control" name="item_tugas" required>
                      <small style="color: red">* Tidak boleh kosong</small>
                      <input type="hidden" name="id_jobdesc">
                  </div>
        <div class="modal-footer">
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" id="submitTugas" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
</div>
<!--tambah tanggung tambahTanggungjawab jobdesc-->
<div class="modal fade" id="modal-tambah-tanggungjawab">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form action="{{ url('store-tanggungjawab') }}" method="post">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Formulir Tambah Tanggung Jawab Pekerjaan</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tanggung Jawab Pekerjaan</label>
                      <input type="text" class="form-control" name="item_tjb" required>
                      <small style="color: red">* Tidak boleh kosong</small>
                      <input type="hidden" name="id_jobdesc">
                  </div>
        <div class="modal-footer">
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" id="submitTanggungJ" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
</div>
<!--tambah wewenang jobdesc-->
<div class="modal fade" id="modal-tambah-wewenang">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form action="{{ url('store-wewenang') }}" method="post">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Formulir Tambah Wewenang Pekerjaan</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Wewenang Pekerjaan</label>
                      <input type="text" class="form-control" name="item_wewenang" required>
                      <small style="color: red">* Tidak boleh kosong</small>
                      <input type="hidden" name="id_jobdesc">
                  </div>
        <div class="modal-footer">
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" id="submitWewenang" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
</div>

<!--ubah jobdesc-->
<div class="modal fade" id="modal-ubah-jobdesc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-jobdesc')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Jobdesc Perusahaan</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                       <label for="exampleInputEmail1">Atasan</label>
                       <select class="form-control select2" style="width: 100%;" name="atasan_ubah" required>
                           @if(empty($data_jabatan))
                               <option>Nama Jabatan Perusahaan Belum di Isi</option>
                               @else
                                      <option>Pilih Jabatan</option>
                               @foreach($data_jabatan as $jabatan)
                                   <option value="{{ $jabatan->id }}">{{ $jabatan->nm_jabatan }}</option>
                               @endforeach
                           @endif
                       </select>
                   </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Isi Ruang Lingkup Perkerjaan</label>
                        <textarea class="form-control"  name="ruanglingkup_ubah"  required></textarea>
                        <small style="color: red" id="notify"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hubungan Kedalam</label>
                        <input type="text" class="form-control"  name="hub_kedalam_ubah"  required></input>
                        <small style="color: red" id="notify"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hubungan Keluar</label>
                        <input type="text" class="form-control"  name="hub_keluar_ubah"  required></input>
                        <small style="color: red" id="notify"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">limpahan Wewenang</label>
                        <input type="text" class="form-control"  name="limpahan_wewenang_ubah"  required></input>
                        <input type="hidden" name="id_jobdesc">
                        <input type="hidden" name="id_jabatan_p">
                        <small style="color: red" id="notify"></small>
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahJobdesc" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
	<!-- /.modal -->

  <!--ubah tugas-->
  <div class="modal fade" id="modal-ubah-tugas">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form action="{{ url('update-tugas')}}" method="post">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Formulir Ubah Tugas Pekerjaan</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Item Tugas</label>
                          <input type="text" class="form-control"  name="item_tugas_ubah"  required></input>
                          <small style="color: red" id="notify"></small>
                          <input type="hidden" name="id_tugas">
                          <input type="hidden" name="id_jobdesc">
                      </div>
                  </div>
                  <div class="modal-footer">
                      {{ csrf_field() }}
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                      <button type="submit" id="submitUbahTugas" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  	<!-- /.modal -->

    <!--ubah tanggungjawab-->
    <div class="modal fade" id="modal-ubah-tanggungjawab">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('update-tanggungjawab')}}" method="post">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Formulir Ubah Tanggung Jawab Pekerjaan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Item Tanggung Jawab</label>
                            <input type="text" class="form-control"  name="item_tjb_ubah"  required></input>
                            <small style="color: red" id="notify"></small>
                            <input type="hidden" name="id_tjb">
                            <input type="hidden" name="id_jobdesc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" id="submitUbahTJB" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
   <!-- /.modal -->

   <!--ubah wewenang-->
   <div class="modal fade" id="modal-ubah-wewenang">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <form action="{{ url('update-wewenang')}}" method="post">
                   <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title">Formulir Ubah Wewenang Pekerjaan</h4>
                   </div>
                   <div class="modal-body">
                       <div class="form-group">
                           <label for="exampleInputEmail1">Item Wewenang</label>
                           <input type="text" class="form-control"  name="item_wewenang_ubah"  required></input>
                           <small style="color: red" id="notify"></small>
                           <input type="hidden" name="id_wewenang">
                           <input type="hidden" name="id_jobdesc">
                       </div>
                   </div>
                   <div class="modal-footer">
                       {{ csrf_field() }}
                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                       <button type="submit" id="submitUbahWewenang" class="btn btn-primary">Simpan</button>
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
           CKEDITOR.replace( 'ruang_lingkup',{
                height: 75
           } );

           CKEDITOR.replace( 'ruanglingkup_ubah',{
                height: 75
           } );


       };

</script>
