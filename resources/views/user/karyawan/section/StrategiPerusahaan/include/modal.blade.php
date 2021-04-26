<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<!---modal ubah sjp--->
<div class="modal fade" id="modal-ubah-sjp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-sjp')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Jangka Panjang Perusahaan</h4>
                </div>
              <div class="modal-body">
                <div class="form-group">
    							<label for="exampleInputEmail1">Strategi Jangka Panjang Perusahaan</label>
    							<textarea class="form-control"  name="isi_ubah" id="isi_ubah"  required></textarea>
    							<small style="color: red" id="notify"></small>
                  <input type="hidden" name="id_tjpg_ubah">
                  <input type="hidden" name="id_sjp_ubah">
    						</div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSJP" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          <!-- /.modal-body -->
          </form>
      </div>
     <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---modal ubah sekutif--->
<div class="modal fade" id="modal-ubah-sekutif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-sekutif')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Eksekutif Perusahaan</h4>
                </div>
              <div class="modal-body">
                <div>
                    <label>Nama Strategi Eksekutf</label>
                    <input type="text" name="nama_ubah" class="form-control" required></input>
                    <small style="color: red" id="notify"></small>
                </div>
                <div class="form-group">
    							 <label for="exampleInputEmail1">Strategi Eksekutif Perusahaan</label>
    							 <textarea class="form-control"  name="isi_eks_ubah" id="isi_eks_ubah"  required></textarea>
    							 <small style="color: red" id="notify"></small>
                   <input type="hidden" name="id_teks_ubah">
                   <input type="hidden" name="id_seks_ubah">
    						</div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSekutif" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          <!-- /.modal-body -->
          </form>
      </div>
     <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---modal ubah manager--->
<div class="modal fade" id="modal-ubah-man">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-sman')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Manager Perusahaan</h4>
                </div>
              <div class="modal-body">
                <div>
                    <label>Nama Strategi Manager</label>
                    <input type="text" name="nama_ubah" class="form-control" required></input>
                    <small style="color: red" id="notify"></small>
                </div>
                <div class="form-group">
    							 <label for="exampleInputEmail1">Strategi Manager Perusahaan</label>
    							 <textarea class="form-control"  name="isi_man_ubah" id="isi_man_ubah"  required></textarea>
    							 <small style="color: red" id="notify"></small>
                   <input type="hidden" name="id_tman_ubah">
                   <input type="hidden" name="id_sman_ubah">
    						</div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSman" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          <!-- /.modal-body -->
          </form>
      </div>
     <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---modal ubah supervisor--->
<div class="modal fade" id="modal-ubah-sup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-ssup')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Supervisor Perusahaan</h4>
                </div>
              <div class="modal-body">
                <div>
                    <label>Nama Strategi Supervisor</label>
                    <input type="text" name="nama_ubah" class="form-control" required></input>
                    <small style="color: red" id="notify"></small>
                </div>
                <div class="form-group">
    							 <label for="exampleInputEmail1">Strategi Supervisor Perusahaan</label>
    							 <textarea class="form-control"  name="isi_sup_ubah" id="isi_sup_ubah"  required></textarea>
    							 <small style="color: red" id="notify"></small>
                   <input type="hidden" name="id_tsup_ubah">
                   <input type="hidden" name="id_ssup_ubah">
    						</div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSsup" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          <!-- /.modal-body -->
          </form>
      </div>
     <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---modal ubah supervisor--->
<div class="modal fade" id="modal-ubah-staf">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-sstaf')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Strategi Staf Perusahaan</h4>
                </div>
              <div class="modal-body">
                <div>
                    <label>Nama Strategi Staf</label>
                    <input type="text" name="nama_ubah" class="form-control" required></input>
                    <small style="color: red" id="notify"></small>
                </div>
                <div class="form-group">
    							 <label for="exampleInputEmail1">Strategi Staf Perusahaan</label>
    							 <textarea class="form-control"  name="isi_staf_ubah" id="isi_staf_ubah"  required></textarea>
    							 <small style="color: red" id="notify"></small>
                   <input type="hidden" name="id_tstaf_ubah">
                   <input type="hidden" name="id_sstaf_ubah">
    						</div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSstaf" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          <!-- /.modal-body -->
          </form>
      </div>
     <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
       window.onload = function() {
           CKEDITOR.replace( 'isi_ubah',{
                height: 200
           } );
           CKEDITOR.replace( 'isi_eks_ubah',{
                height: 200
           } );
           CKEDITOR.replace( 'isi_man_ubah',{
                height: 200
           } );
           CKEDITOR.replace( 'isi_sup_ubah',{
                height: 200
           } );
           CKEDITOR.replace( 'isi_staf_ubah',{
                height: 200
           } );
       };

</script>
