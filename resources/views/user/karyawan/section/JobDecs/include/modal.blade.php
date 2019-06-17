<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<div class="modal fade" id="modal-tambah-jobdesc">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('store-jobdesc') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Jobdesc</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Job Desc</label>
                        <textarea class="form-control"  name="job_desc" id="job_desc" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="text" name="id_jabatan_p">
					</div>
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
<!-- /.modal -->
<div class="modal fade" id="modal-ubah-Jobdesc">
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
                        <label for="exampleInputEmail1">Isi Job Desc</label>
                        <textarea class="form-control"  name="jobdesc_ubah"  required></textarea>
                        <input type="text" name="id_jobdesc">
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
<script>

       window.onload = function() {
           CKEDITOR.replace( 'job_desc',{
                height: 75
           } );
		   
		    CKEDITOR.replace( 'jobdesc_ubah',{
                height: 75
           } );
       };
	  
</script>