
<!---modal tambah RMB--->
<div class="modal fade" id="modal-tambah-RMB">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rmb') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Marketing Barang</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label>Tanggal Terbit</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Rencana Terbit" name="tgl_rencana_terbit" required>
                         </div>
                          <small style="color: red">* Tidak boleh kosong</small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Fase Marketing</label>
                        <select class="form-control select2" style="width: 100%;" name="fase_marketing" required>
                            @if(empty($fase_rm))
                               <option>Data Belum di isi</option>
								@else
								<option>Pilih Fase Marketing</option>
                                @foreach($fase_rm as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					
					<div class="form-group" id="md_0">
                    <label for="exampleInputEmail1">Media Marketing</label>
                        <select class="form-control select2" style="width: 100%;" id="select_md0" name="id_media_marketing" required>
                            @if(empty($data_mm_off))
                               <option>Data Belum di isi</option>
								@else
								<option value="0">Pilih Media Marketing</option>
                                @foreach($data_mm_off as $media_m)
                                    <option value="{{ $media_m->id }}">{{ $media_m->media_marketing }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					
					<div class="form-group" id="md_1">
							<label for="exampleInputEmail1">Media Marketing</label>
							<select class="form-control select2" style="width: 100%;" id="select_md1" name="id_media_marketing" required>
								@if(empty($data_mm_on))
									<option>Data Belum di isi</option>
									@else
									<option value="0">Pilih Media Marketing</option>
									@foreach($data_mm_on as $media_m)
                                    <option value="{{ $media_m->id }}">{{ $media_m->media_marketing }}</option>
									@endforeach
								@endif
							</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
						
					<div class="form-group">
					<label for="exampleInputEmail1">sub Media Marketing</label>
                        <select class="form-control select2" style="width: 100%;" name="id_submedia_marketing" required>
                            @if(empty($data_submm))
                               <option>Data Belum di isi</option>
								@else
								<option>Pilih sub Media Marketing</option>
                                @foreach($data_submm as $submm)
                                    <option value="{{ $submm->id }}">{{ $submm->submedia_marketing }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputFile">Content Marketing</label>
                            <select class="form-control select2" style="width: 100%;" name="id_content_marketing">
                                <option value="0">Pilih Content Marketing</option>
                            </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Barang</label>
                        <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                            @if(empty($data_barang))
                               <option>Data Belum di isi</option>
								@else
								<option value="0">Pilih Nama Barang</option>
                                @foreach($data_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nm_barang }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Sasaran Konsumen</label>
                            <div class="form-group">
								@foreach($sasaran_m as $values)
									<label>
										<input type="checkbox" name="sasaran_klien[]" value="{{ $values }}">&nbsp;&nbsp;{{ $values}}
									</label>
									<br>
								@endforeach
								<p></p>
							</div>
							<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_rm">
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
</div>	
<!-- /.modal -->

<!---modal tambah RMJ--->
<div class="modal fade" id="modal-tambah-RMJ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-rmj') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Rencana Marketing Jasa</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label>Tanggal Terbit</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker4" placeholder="Tanggal Rencana Terbit" name="tgl_rencana_terbit" required>
                         </div>
                          <small style="color: red">* Tidak boleh kosong</small>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Fase Marketing</label>
                        <select class="form-control select2" style="width: 100%;" name="fase_marketing" required>
                            @if(empty($fase_m))
                               <option>Data Belum di isi</option>
								@else
								<option>Pilih Fase Marketing</option>
                                @foreach($fase_m as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group" id="md_00">
                    <label for="exampleInputEmail1">Media Marketing</label>
                        <select class="form-control select2" style="width: 100%;" name="id_media_marketing" required>
                            @if(empty($data_mm_off))
                               <option>Data Belum di isi</option>
								@else
								<option>Pilih Media Marketing</option>
                                @foreach($data_mm_off as $media_m)
                                    <option value="{{ $media_m->id }}">{{ $media_m->media_marketing }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					
					<div class="form-group" id="md_11">
							<label for="exampleInputEmail1">Media Marketing</label>
							<select class="form-control select2" style="width: 100%;" name="id_media_marketing" required>
								@if(empty($data_mm_on))
									<option>Data Belum di isi</option>
									@else
									<option>Pilih Media Marketing</option>
									@foreach($data_mm_on as $media_m)
                                    <option value="{{ $media_m->id }}">{{ $media_m->media_marketing }}</option>
									@endforeach
								@endif
							</select>
							<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					<div class="form-group">
					<label for="exampleInputEmail1">sub Media Marketing</label>
                        <select class="form-control select2" style="width: 100%;" name="id_submedia_marketing" required>
                            @if(empty($data_submm))
                               <option>Data Belum di isi</option>
								@else
								<option>Pilih sub Media Marketing</option>
                                @foreach($data_submm as $submm)
                                    <option value="{{ $submm->id }}">{{ $submm->submedia_marketing }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<div class="form-group">
                        <label for="exampleInputFile">Content Marketing</label>
                            <select class="form-control select2" style="width: 100%;" name="id_content_marketing">
                                <option value="0">Pilih Content Marketing</option>
                            </select>
                    </div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Jasa</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                            @if(empty($data_jasa))
                               <option>Data Belum di isi</option>
								@else
								<option>Pilih Nama Layanan</option>
                                @foreach($data_jasa as $jasa)
                                    <option value="{{ $jasa->id }}">{{ $jasa->nm_jasa }}</option>
                                @endforeach
                            @endif
                        </select>
						<small style="color: red">* Tidak Boleh Kosong</small>
					</div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Sasaran Konsumen</label>
                            <div class="form-group">
								@foreach($sasaran_m as $values)
									<label>
										<input type="checkbox" name="sasaran_klien[]" value="{{ $values }}">&nbsp;&nbsp;{{ $values}}
									</label>
									<br>
								@endforeach
								<p></p>
							</div>
                    </div>
					<input type="hidden" name="id_rm">
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
</div>	
<!-- /.modal -->

<!---modal tambah Target Audience--->
<div class="modal fade" id="modal-tambah-TargetAudience">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('store-target-audience') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Target Audience</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                    <label for="exampleInputEmail1">Demografi</label>
                        <div class="form-group">
							@foreach ($hasil_targeting as  $targeting)
							@foreach($data_hasilsg_brg as $hasilsg_brg)	
								@if($hasilsg_brg->id == $targeting->id_hasil_segmenting )
								@if($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->getSegmenting->id == 1)
								
								<label>
								<input type="checkbox" name="id_targeting[]" value="{{ $targeting->id }}">&nbsp;&nbsp;
								
									{{ $hasilsg_brg->getBarang->nm_barang }} =>
									@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting))
									{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->getSubSegmenting->item_sub_segmenting }}
									@endif
									@if(!empty($hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting))
									->{{$hasilsg_brg->getContentSegmenting->getSubSubSegmenting->item_subsub_segmenting }}
									@endif
									@if(!empty($hasilsg_brg->getContentSegmenting->content_segmenting))
									-> {{ $hasilsg_brg->getContentSegmenting->content_segmenting }}
									@endif
									-> {{ $hasilsg_brg->hasil_segmenting }}</br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pola Targeting: 
									{{ $targeting->getPolaTargeting->nm_pola_targeting }}
									
								</label>
								<br>
								
								@endif
								@endif
							@endforeach
							@endforeach
							<p></p>
						</div>
						<small style="color: red">* Tidak Boleh Kosong</small>
                    </div>
					<input type="hidden" name="id_rm">
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
</div>	
<!-- /.modal -->

<!--<script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>-->
<script>
       window.onload = function() {
		   
			$('[name="id_media_marketing"]').change(function () {
               $.ajax({
                   url:"{{ url('getSubMedia') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option value='0'>Pilih Sub Media</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.submedia_marketing+"</option>";
                       });
                       $('[name="id_submedia_marketing"]').html(option);
                   }
               })
			})
			
			$('[name="id_submedia_marketing"]').change(function () {
               $.ajax({
                   url:"{{ url('getContentMarketing') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option value='0'>Pilih Content Marketing</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.content_marketing+"</option>";
                       });
                       $('[name="id_content_marketing"]').html(option);
                   }
               })
			})
			
			
       };
	    
		
</script>

