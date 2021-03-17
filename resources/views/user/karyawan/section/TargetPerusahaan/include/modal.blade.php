
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

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
							<label for="exampleInputEmail1">Jangka Waktu </label>
							<input type="number" max="50" class="form-control"  name="periode_ubah">
							<small style="color: red" id="notify"></small>
						</div>
            <div class="form-group">
                <label>Tahun Mulai</label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right"  name="thn_mulai_ubah" required>
                </div>
                <!-- /.input group -->
              <small style="color: red">* Tidak Boleh Kosong</small>
            </div>
            <div class="form-group">
                <label>Tahun Mulai</label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right"  name="thn_selesai_ubah" required>
                </div>
                <!-- /.input group -->
              <small style="color: red">* Tidak Boleh Kosong</small>
            </div>
						<div class="form-group">
							<label for="exampleInputEmail1">Target Jangka Panjang</label>
							<textarea class="form-control"  name="target_puncak_ubah" id="target_puncak_ubah"  required></textarea>
							<small style="color: red" id="notify"></small>
						</div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Target</label>
              <input type="number" class="form-control"  name="jumlah_target_ubah">
              <small style="color: red" id="notify"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Satuan Target</label>
              <input type="text" class="form-control"  name="satuan_target_ubah">
              <small style="color: red" id="notify"></small>
              <input type="hidden" name="id_tjp_ubah">
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

<!---modal ubah target Eksekutif--->
<div class="modal fade" id="modal-ubah-target_eks">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-target-eks')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Target Eksekutif Perusahaan</h4>
                </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Tahun </label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right"  name="tahun_ubah" required>
                </div>
                <!-- /.input group -->
              <small style="color: red">* Tidak Boleh Kosong</small>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Departemen</label>
                    <select class="form-control select2" style="width: 100%;" name="id_bagian_p_ubah">
                      <option value="0">Pilih Departemen</option>
                      @foreach($bagian_p as $value)
												  @if(!empty($target_eks->id_bagian_p))
													<option value="{{ $value->id }}" {{ $value->id == $target_eks->id_bagian_p ? 'selected' : '' }}>{{ $value->nm_bagian }}</option>
												  @else
													<option value="{{ $value->id }}"}}>{{ $value->nm_bagian }}</option>
												  @endif
											@endforeach
                    </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputFile">Jabatan</label>
                      <select class="form-control select2" style="width: 100%;" name="id_jabatan_p_ubah">
                        <option value="0">Pilih Jabatan</option>
                        @foreach($jabatan_p as $jabatan)
  												  @if(!empty($target_eks->id_jabatan_p))
  													<option value="{{ $jabatan->id }}" {{ $jabatan->id == $target_eks->id_jabatan_p ? 'selected' : '' }}>{{ $value->nm_jabatan }}</option>
  												  @else
                               @if($jabatan->level_jabatan == 0)
  													<option value="{{ $jabatan->id }}"}}>{{ $jabatan->nm_jabatan }}</option>
                               @endif
  												  @endif
  											@endforeach
                      </select>
                </div>
						<div class="form-group">
							<label for="exampleInputEmail1">Target Eksekutif</label>
							<textarea class="form-control"  name="target_eksekutif_ubah" required></textarea>
							<small style="color: red" id="notify"></small>
						</div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Target</label>
              <input type="number" class="form-control"  name="jumlah_target_ubah">
              <small style="color: red" id="notify"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Satuan Target</label>
              <input type="text" class="form-control"  name="satuan_target_ubah">
              <small style="color: red" id="notify"></small>
              <input type="hidden" name="id_teks_ubah">
            </div>
        </div>
        <div class="modal-footer">
            {{ csrf_field() }}
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" id="submitUbahtargetEks" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---modal ubah target manager--->
<div class="modal fade" id="modal-ubah-target_man">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-target-man')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Target Manager Perusahaan</h4>
                </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputFile">Target Eksekutif</label>
                    <select class="form-control select2" style="width: 100%;" name="id_target_eks_ubah">
                      <option value="0">Pilih Target Eksekutif</option>
                      @foreach($target_eks as $value)
												  @if(!empty($target_man->id_target_eks))
													<option value="{{ $value->id }}" {{ $value->id == $target_eks->id_target_eks ? 'selected' : '' }}>{{ $value->$target_eksekutif }}</option>
												  @else
													<option value="{{ $value->id }}"}}>{{ $value->target_eksekutif }}</option>
												  @endif
											@endforeach
                    </select>
              </div>
            <div class="form-group">
                <label>Tahun </label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right"  name="tahun_ubah" required>
                </div>
                <!-- /.input group -->
              <small style="color: red">* Tidak Boleh Kosong</small>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Departemen</label>
                    <select class="form-control select2" style="width: 100%;" name="id_bagian_p_ubah">
                      <option value="0">Pilih Departemen</option>
                      @foreach($bagian_p as $value)
												  @if(!empty($target_man->id_bagian_p))
													<option value="{{ $value->id }}" {{ $value->id == $target_eks->id_bagian_p ? 'selected' : '' }}>{{ $value->nm_bagian }}</option>
												  @else
													<option value="{{ $value->id }}"}}>{{ $value->nm_bagian }}</option>
												  @endif
											@endforeach
                    </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputFile">Jabatan</label>
                      <select class="form-control select2" style="width: 100%;" name="id_jabatan_p_ubah">
                        <option value="0">Pilih Jabatan</option>
                        @foreach($jabatan_p as $jabatan)
  												  @if(!empty($target_man->id_jabatan_p))
  													<option value="{{ $jabatan->id }}" {{ $jabatan->id == $target_man->id_jabatan_p ? 'selected' : '' }}>{{ $value->nm_jabatan }}</option>
  												  @else
                              @if($jabatan->level_jabatan == 1)
  													<option value="{{ $jabatan->id }}"}}>{{ $jabatan->nm_jabatan }}</option>
                              @endif
  												  @endif
  											@endforeach
                      </select>
                </div>
						<div class="form-group">
							<label for="exampleInputEmail1">Target Manager</label>
							<textarea class="form-control"  name="target_manager_ubah" required></textarea>
							<small style="color: red" id="notify"></small>
						</div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Target</label>
              <input type="number" class="form-control"  name="jumlah_target_ubah">
              <small style="color: red" id="notify"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Satuan Target</label>
              <input type="text" class="form-control"  name="satuan_target_ubah">
              <small style="color: red" id="notify"></small>
              <input type="hidden" name="id_tman_ubah">
            </div>
        </div>
        <div class="modal-footer">
            {{ csrf_field() }}
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" id="submitUbahtargetMan" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---modal ubah target Supervisor--->
<div class="modal fade" id="modal-ubah-target_sup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('update-target-sup')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Ubah Target Supervisor Perusahaan</h4>
                </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputFile">Target manager</label>
                    <select class="form-control select2" style="width: 100%;" name="id_target_man_ubah">
                      <option value="0">Pilih Target Manager</option>
                      @foreach($target_man as $value)
												  @if(!empty($target_sup->id_target_man))
													<option value="{{ $value->id }}" {{ $value->id == $target_man->id_target_eks ? 'selected' : '' }}>{{ $value->$target_manager }}</option>
												  @else
													<option value="{{ $value->id }}"}}>{{ $value->target_manager }}</option>
												  @endif
											@endforeach
                    </select>
              </div>
            <div class="form-group">
                <label>Tahun </label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right"  name="tahun_ubah" required>
                </div>
                <!-- /.input group -->
              <small style="color: red">* Tidak Boleh Kosong</small>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Divisi</label>
                    <select class="form-control select2" style="width: 100%;" name="id_divisi_p_ubah">
                      <option value="0">Pilih Divisi</option>
                      @foreach($bagian_p as $value)
												  @if(!empty($target_sup->id_divisi_p))
													<option value="{{ $value->id }}" {{ $value->id == $target_man->id_divisi_p ? 'selected' : '' }}>{{ $value->nm_bagian }}</option>
												  @else
													<option value="{{ $value->id }}"}}>{{ $value->nm_devisi }}</option>
												  @endif
											@endforeach
                    </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputFile">Jabatan</label>
                      <select class="form-control select2" style="width: 100%;" name="id_jabatan_p_ubah">
                        <option value="0">Pilih Jabatan</option>
                        @foreach($jabatan_p as $jabatan)
  												  @if(!empty($target_sup->id_jabatan_p))
  													<option value="{{ $jabatan->id }}" {{ $jabatan->id == $target_sup->id_jabatan_p ? 'selected' : '' }}>{{ $value->nm_jabatan }}</option>
  												  @else
                              @if($jabatan->level_jabatan == 2)
  													<option value="{{ $jabatan->id }}"}}>{{ $jabatan->nm_jabatan }}</option>
                              @endif
  												  @endif
  											@endforeach
                      </select>
                </div>
						<div class="form-group">
							<label for="exampleInputEmail1">Target Supervisor</label>
							<textarea class="form-control"  name="target_supervisor_ubah" required></textarea>
							<small style="color: red" id="notify"></small>
						</div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Target</label>
              <input type="number" class="form-control"  name="jumlah_target_ubah">
              <small style="color: red" id="notify"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Satuan Target</label>
              <input type="text" class="form-control"  name="satuan_target_ubah">
              <small style="color: red" id="notify"></small>
              <input type="hidden" name="id_tsup_ubah">
            </div>
        </div>
        <div class="modal-footer">
            {{ csrf_field() }}
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" id="submitUbahtargetSup" class="btn btn-primary">Simpan</button>
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

  CKEDITOR.replace( 'target_puncak_ubah',{
                height: 100
    } );


  };

</script>
