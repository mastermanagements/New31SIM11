<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<div class="modal fade" id="modal-tambah-sjp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-sjp') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Strategi Jangka Panjang</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama Strategi Jangka Panjang Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Strategi 5 Tahun pertama hit and run" name="nm_sjpg">
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Masukan Strategi Jangka Panjang Anda</label>
                        <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_sjpg" id="isi_sjpg" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="hidden" name="id_tjpg">
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitSJP" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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
                        <label for="exampleInputEmail1">Target Jangka Panjang</label>
					    <select class="form-control select2" style="width: 100%;" name="id_tjpg_ubah" required>
                            <option disabled>Pilih Target Jangka Panjang</option>
                            @foreach($target_jpg as $value)
                                <option value="{{ $value->id }}">{{ $value->nm_target_jpg }}</option>
                            @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama Strategi Jangka Panjang Perusahaan</label>
                        <input type="text" class="form-control"  name="nm_sjpg_ubah">
                        <small style="color: red" id="notify"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Target Jangka Panjang Perusahaan</label>
                        <textarea class="form-control"  name="isi_sjpg_ubah"  required></textarea>
                        <input type="hidden" name="id_sjps">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahSjpg" class="btn btn-primary">Simpan</button>
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
           CKEDITOR.replace( 'isi_sjpg',{
                height: 400
           } );
		   CKEDITOR.replace( 'isi_sjpg_ubah',{
                height: 400
           } );
       };
	  
</script>

