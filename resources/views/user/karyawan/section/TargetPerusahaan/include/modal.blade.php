
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

 
<!---modal ubah tjp --->
<div class="modal fade" id="modal-ubah-tjp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-tjp')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Target Jangka Panjang Perusahaan</h4>
                </div>
                <div class="modal-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Strategi Jangka Panjang Perusahaan</label>
							<input type="text" class="form-control"  name="nm_tjp_ubah">
							<small style="color: red" id="notify"></small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Periode</label>
							<input type="text" class="form-control"  name="periode_ubah">
							<small style="color: red" id="notify"></small>
						</div>
                       
						<div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tahun Mulai</label>
					    <select class="form-control select2" style="width: 100%;" name="thn_mulai_ubah" required>
                            <option disabled>Pilih </option>
                            @foreach(Tahun() as $tahun)
                               <option value="{{ $tahun }}" >
							   {{ $tahun }}
							   </option>
                            @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
						</div>
						<div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tahun Selesai</label>
					    <select class="form-control select2" style="width: 100%;" name="thn_selesai_ubah" required>
                            <option disabled>Pilih </option>
                            @foreach(Tahun() as $tahun)
                               <option value="{{ $tahun }}" >
							   {{ $tahun }}
							   </option>
                            @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Isi Target Jangka Panjang</label>
							<textarea class="form-control"  name="isi_tjp_ubah"  required></textarea>
							<small style="color: red" id="notify"></small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Id_tjp</label>
							<input type="text" name="id_mtjp">
						</div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahtjp" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!---modal tambah target tahunan--->
<div class="modal fade" id="tambah-target-tahunan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-target-tahunan') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Target Tahunan Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tahun Target Perusahaan</label>
						<select class="form-control select2" style="width: 100%;" name="tahun" required>
										<option>Tahun</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach
                 
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Departemen</label>
                        <select class="form-control select2" style="width: 100%;" name="id_bagian_p" required>
                            @if(empty($bagian_p))
                               <option>Departemen Perusahaan Belum di Isi</option>
								@else
								<option>Pilih Departemen</option>
                                @foreach($bagian_p as $bagian)
                                    <option value="{{ $bagian->id }}">{{ $bagian->nm_bagian }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputFile">Divisi</label>
                        <select class="form-control select2" style="width: 100%;" name="id_divisi_p" required>
                              <option>Pilih Divisi</option>
                               </select>
                               <small style="color: red">* Tidak boleh kosong</small>
                    </div>					
					<div class="form-group">
                        <label for="exampleInputEmail1">Jabatan</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jabatan_p" required>
                            @if(empty($jabatan_p))
                                <option>Nama Jabatan Perusahaan Belum di Isi</option>
                                @else
								<option>Pilih Jabatan</option>
                                @foreach($jabatan_p as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nm_jabatan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Masukan Target Tahunan</label>
                        <textarea class="form-control" placeholder="Masukan Strategi Anda" name="target_tahunan" id="target_tahunan" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="text" name="id_tjp">
					</div>
					
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitTJP" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!---end tambah target tahunan--->

<!--ubah target tahunan-->
<div class="modal fade" id="modal-ubahTtahunan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-Ttahunan')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Target Tahunan Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Pilih Target Jangka Panjang Perusahaan</label>
					    <select class="form-control select2" style="width: 100%;" name="id_tjp_ubah" required>
                            <option disabled>Pilih Target Jangka Panjang</option>
                            @foreach ($data_tjp as $tjp)
                                <option value="{{ $tjp->id }}">{{ $tjp->nm_tjp }}</option>
                            @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Tahun Target</label>
						<select class="form-control select2" style="width: 100%;" name="tahun_ubah" required>
										<option>Tahun</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Departemen</label>
                        <select class="form-control select2" style="width: 100%;" name="id_bagian_p_ubah" required>
                            @if(empty($bagian_p))
                               <option>Departemen Perusahaan Belum di Isi</option>
								@else
								<option>Pilih Departemen</option>
                                @foreach($bagian_p as $bagian)
                                    <option value="{{ $bagian->id }}">{{ $bagian->nm_bagian }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputFile">Divisi</label>
                        <select class="form-control select2" style="width: 100%;" name="id_divisi_p_ubah" required>
                              <option>Pilih Divisi</option>
                               </select>
                               <small style="color: red">* Tidak boleh kosong</small>
                    </div>					
					<div class="form-group">
                        <label for="exampleInputEmail1">Jabatan</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jabatan_p_ubah" required>
                            @if(empty($jabatan_p))
                                <option>Nama Jabatan Perusahaan Belum di Isi</option>
                                @else
								<option>Pilih Jabatan</option>
                                @foreach($jabatan_p as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nm_jabatan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Tahunan</label>
                        <textarea class="form-control"  name="target_tahunan_ubah"  required></textarea>
                         <input type="text" name="id_Ttahunan">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahStahunan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

 <!---modal tambah target bulanan--->
<div class="modal fade" id="tambah-target-bulanan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-target-bulanan') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Target Bulanan Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Pilih Bulan </label>
						<select class="form-control select2" style="width: 100%;" name="bulan" required>
										<option>Bulan</option>
                                        @foreach(Bulan() as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                        @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Masukan Target Bulan ini</label>
                        <textarea class="form-control" placeholder="Masukan Target Anda" name="target_bulanan" id="target_tahunan" required></textarea>
                        <small style="color: red">* Tidak boleh kosong</small>
						<input type="text" name="id_target_tahunan">
					</div>
					
					<div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitTJP" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!---end tambah target bulanan--->  

<!--ubah target bulanan-->
<div class="modal fade" id="modal-ubah-tTbulanan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-Tbulanan')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Target Bulanan Perusahaan</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label for="exampleInputEmail1">Pilih Target Tahunan Perusahaan</label>
					    <select class="form-control select2" style="width: 100%;" name="id_tt_ubah" required>
                            <option disabled>Pilih Target Tahunan</option>
                            @foreach ($data_tt as $Ttahunan)
                                <option value="{{ $Ttahunan->id }}">{{ $Ttahunan->tahun }}</option>
                            @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Bulan Target</label>
						<select class="form-control select2" style="width: 100%;" name="bulan_ubah" required>
										<option>Bulan</option>
                                        @foreach(Bulan() as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                        @endforeach
                        </select>
                        <small style="color: red" id="notify"></small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Target Bulanan</label>
                        <textarea class="form-control"  name="target_bulanan_ubah"  required></textarea>
                         <input type="text" name="id_Tbulanan">
                        <small style="color: red" id="notify"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitUbahTbulanan" class="btn btn-primary">Simpan</button>
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
		   
           CKEDITOR.replace( 'isi_tjp_ubah',{
                height: 300
           } );
		   CKEDITOR.replace( 'target_tahunan',{
                height: 300
           } );
		   CKEDITOR.replace( 'target_tahunan_ubah',{
                height: 300
           } );
		   CKEDITOR.replace( 'target_bulanan',{
                height: 300
           } );
		   CKEDITOR.replace( 'target_bulanan_ubah',{
                height: 300
           } );
		   
		   //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
			
			$('[name="id_bagian_p"]').change(function () {
               $.ajax({
                   url:"{{ url('getDivisi') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option>Pilih Divisi</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nm_devisi+"</option>";
                       });
                       $('[name="id_divisi_p"]').html(option);
                   }
               })
			})
			
			$('[name="id_bagian_p_ubah"]').change(function () {
               $.ajax({
                   url:"{{ url('getDivisi') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option>Pilih Divisi</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nm_devisi+"</option>";
                       });
                       $('[name="id_divisi_p_ubah"]').html(option);
                   }
               })
			})
       };
	    
		
</script>

