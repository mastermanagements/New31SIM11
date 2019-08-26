
<!---tambah follow up-->
<div class="modal fade" id="modal-tambah-ResponD">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-respon-delight') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
				
                    <h4 class="modal-title">Formulir Tambah Follow up Closing</h4>
                </div>
                <div class="modal-body">
					@php($waktu_now = \Carbon\Carbon::now())		
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Kegiatan</label>
								<input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Respon Customer</label>
								<textarea name="respon_klien" class="form-control" id="respon_klien"></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div>
							Apakah perlu di follow up oleh departemen dan divisi lain?
							</div></br>
							<div class="form-group">
								<label for="exampleInputEmail1">Departemen</label>
									<select class="form-control select2" style="width: 100%;" name="id_bagian_p">
										@if(empty($bagian_p))
											<option>Departemen Perusahaan Belum di Isi</option>
										@else
											<option value="0">Pilih Departemen</option>
											@foreach($bagian_p as $bagian)
												<option value="{{ $bagian->id }}">{{ $bagian->nm_bagian }}</option>
											@endforeach
										@endif
									</select>
									<small style="color:#35C30F">* Isi Jika Perlu Follow up ke departemen lain</small>
							</div>
							<div class="form-group">
								<label for="exampleInputFile">Divisi</label>
									<select class="form-control select2" style="width: 100%;" name="id_divisi_p">
										<option value="0">Pilih Divisi</option>
									</select>
									<small style="color: green">* Isi Jika Perlu Follow up ke divisi lain</small>
							</div>
								<input type="hidden" name="id_delight" class="form-control" required/>
							<div class="modal-footer">
								{{ csrf_field() }}
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
								<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
							</div>
				</form>
			</div>
        <!-- /.modal-content -->
		</div>
    <!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal-->
<script>
	window.onload = function() {
		 
		$('[name="id_bagian_p"]').change(function () {
               $.ajax({
                   url:"{{ url('getDivisi') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option value='0'>Pilih Divisi</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nm_devisi+"</option>";
                       });
                       $('[name="id_divisi_p"]').html(option);
                   }
               })
			})
	};
	
</script>