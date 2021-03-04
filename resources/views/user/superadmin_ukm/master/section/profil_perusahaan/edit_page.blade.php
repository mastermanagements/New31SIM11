@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Ubah Usaha
        </h1>
    </section>
    <!--main content-->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Ubah Usaha</h3>
                </div>
                <!-- /.box-header -->

				         <!-- form start -->
                <form role="form" method="post" action="{{ url('update-usaha/'.$usaha->id) }}" enctype="multipart/form-data">

                    <div class="box-body">
                        @if(!empty(session('message_success')))
                            <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                        @elseif(!empty(session('message_fail')))
                            <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif

							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Perusahaan</label>
									<input type="text" class="form-control" placeholder="Masukan Nama Usaha Anda" name="nm_usaha" value="{{ $usaha->nm_usaha }}" required>
									<small style="color: red">* Tidak boleh kosong</small>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Singkatan Usaha</label>
									<input type="text" class="form-control" placeholder="Masukan Singkatan Usaha Anda" name="singkatan_usaha" value="{{ $usaha->singkatan_usaha }}">
								</div>
								 <div class="form-group">
									 <label for="exampleInputPassword1">Alamat</label>
									 <!--<textarea class="form-control" placeholder="Masukan alaman usaha anda" name="alamat" value="{{ $usaha->alamat }}" required></textarea>-->
									 <input type="text" class="form-control" placeholder="Masukan alaman usaha anda" name="alamat" value="{{ $usaha->alamat }}" required>
									 <small style="color: red">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
									<label for="exampleInputFile">Provinsi</label>
										@if(empty($usaha->id_prov))
											<select class="form-control select2" style="width: 100%;" name="id_provinsi">
												<option>Pilih Provinsi</option>
												@foreach($provinsi as $value)
													<option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
												@endforeach
											</select>
										@else
											<select class="form-control select2" style="width: 100%;" name="id_provinsi">
												<option>Pilih Provinsi </option>
												@foreach($provinsi as $value)
												<option value="{{ $value->id }}" @if($usaha->getProvinsi->id == $value->id) selected @endif>{{ $value->nama_provinsi }}</option>
												@endforeach
											</select>
										@endif
										<small style="color:red;">* Tidak boleh kosong</small>
								 </div>

								 <div class="form-group">
									 <label for="exampleInputFile">Kabupaten</label>
										@if(empty($usaha->id_prov))
											<select class="form-control select2" style="width: 100%;" name="id_kabupaten">
												<option>Pilih Kabupaten</option>
											</select>
										@else
											<select class="form-control select2" style="width: 100%;" name="id_kabupaten">
												<option>Pilih Kabupaten</option>
												@foreach($kabupaten as $value)
												<option value="{{ $value->id }}" @if($usaha->getKabupaten->id == $value->id) selected @endif>{{ $value->nama_kabupaten }}</option>
												@endforeach
											</select>
										@endif
										<small style="color:red;">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Kode Pos</label>
									 <input type="text" class="form-control" placeholder="Masukan Kode pos" name="kd_pos" value="{{ $usaha->kode_pos }}">
									  <small style="color: orange">* Isi Jika Ada</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Telepon</label>
									 <input type="text" class="form-control" name="telp" placeholder="Masukan Nomor Telepon Perusahaan" value="{{ $usaha->telp }}">
									 <small style="color: orange">* Isi Jika Ada</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1"> Handphone</label>
									 <input type="text" class="form-control" name="hp" placeholder="Masukan Nomor Handphone Perusahaan" required value="{{ $usaha->hp }}">
									 <small style="color: red">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Whatshapp</label>
									 <input type="text" class="form-control" name="wa" placeholder="Masukan Nomor Whatshap Perusahaan" required value="{{ $usaha->wa }}">
									 <small style="color: red">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Telegram</label>
									 <input type="text" class="form-control" name="teleg" placeholder="Masukan Telegram Perusahaan" value="{{ $usaha->teleg }}">
									 <small style="color: orange">* Isi Jika Ada</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Fans Page FB</label>
									 <input type="text" class="form-control" name="fp" placeholder="Masukan fans page Perusahaan" value="{{ $usaha->fp }}">
									 <small style="color: orange">* Isi Jika Ada</small>
								 </div>
              </div>
							<!-- /.col -->

							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">IG</label>
									<input type="text" class="form-control" name="ig" placeholder="Masukan Instagram Perusahaan" value="{{ $usaha->ig }}">
									<small style="color: orange">* Isi Jika Ada</small>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Twitter</label>
									<input type="text" class="form-control" name="twitter" placeholder="Masukan twitter Perusahaan" value="{{ $usaha->twitter }}">
									<small style="color: orange">* Isi Jika Ada</small>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Tiktok</label>
									<input type="text" class="form-control" name="tiktok" placeholder="Masukan tiktok Perusahaan" value="{{ $usaha->tiktok }}">
									<small style="color: orange">* Isi Jika Ada</small>
								</div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Email</label>
									 <input type="text" class="form-control" name="email" placeholder="Masukan Email Perusahaan" required value="{{ $usaha->email }}">
									 <small style="color: red">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Website</label>
									 <input type="text" class="form-control" name="web" placeholder="Masukan Nama Website anda" value="{{ $usaha->web }}">
									 <small style="color: orange">* isi jika ada</small>
								 </div>
								 <div class="form-group">
									<label for="exampleInputEmail1">Badan Usaha</label>
									<div class="form-group">
									  @foreach($badan_usaha as $index=> $value)
									  <label>
										<input type="radio" name="badan_usaha" class="minimal" @if($index == $usaha->badan_usaha) checked  @endif value="{{ $index }}" required >&nbsp;{{ $value }}
									  </label>
									  @endforeach
									  <br>
									  <small style="color: red">* Tidak boleh kosong</small>
									</div>
								 </div>
								 <div class="form-group">
									<label for="exampleInputEmail1">Jenis Usaha</label>
									<div class="form-group">
									  <label>
										@foreach($jenis_usaha as $index=> $value)
									  <label>
										<input type="radio" name="jenis_usaha" class="minimal" @if($index == $usaha->jenis_usaha) checked  @endif value="{{ $index }}" required >&nbsp;{{ $value }}
									  </label>
									    @endforeach
									  <br>
									  <small style="color: red">* Tidak boleh kosong</small>
									</div>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Bidang Usaha</label>
									 <input type="text" class="form-control" name="bidang_usaha" placeholder="Bidang Usaha (mis: Kesehatan, Elektronik, Bangunan, kuliner,dll)" required value="{{ $usaha->bidang_usaha }}">
									 <small style="color: red">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
									 <label for="exampleInputEmail1">Spesifikasi Usaha</label>
									 <input type="text" class="form-control" name="spesifik_usaha" placeholder="Spesifikasi Usaha (mis: Laundry, toko komputer, notaris, toko bangunan, dll)" required value="{{ $usaha->spesifik_usaha }}">
									 <small style="color: red">* Tidak boleh kosong</small>
								 </div>
								 <div class="form-group">
								   <label for="exampleInputEmail1">Jenis Jasa</label>
								   <div class="form-group">
									<label>
										@foreach($jenis_jasa as $index=>$value)
									   <input type="radio"  name="jenis_jasa" class="minimal" @if($index == $usaha->jenis_jasa) checked @endif value="{{ $index}}" required>&nbsp; {{ $value }}
									</label>
										@endforeach
									 <br>
									 <small style="color: orange">*Jasa murni, misal: notaris, desain grafis. Jasa & barang misalnya service komputer, jasa laundry, dll.</small>
								   </div>
                  </div>
                  <div class="form-group">
 								   <label for="exampleInputEmail1">Jenis Kantor</label>
 								   <div class="form-group">
 									<label>
 										@foreach($jenis_kantor as $index=>$value)
 									   <input type="radio"  name="jenis_kantor" class="minimal" @if($index == $usaha->jenis_kantor) checked @endif value="{{ $index}}" required>&nbsp; {{ $value }}
 									</label>
 										@endforeach
 									 <br>
 									 <small style="color: orange">* Isi Jika ada</small>
 								   </div>
                   </div>
								   <div class="form-group">
									   <label for="exampleInputFile">Logo Usaha</label>
									   <input type="file" id="exampleInputFile" name="logo" required>
									  <small style="color: red">* Tidak boleh kosong</small>
								   </div>
                </div>
							  <!-- /.col -->
                  <div class="box-footer">
                      {{csrf_field()}}
                    <input type="hidden" name="_method" value="put"/>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>
              </form>
					</div>
					<!-- /.box-body -->
        </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
     <!-- /.row -->
	</section>
	<!-- /.content -->
</div>
@stop


@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();

           //iCheck for checkbox and radio inputs
           $('input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           });

           $('[name="id_provinsi"]').change(function () {
               $.ajax({
                   url:"{{ url('getKabupaten') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option>Pilih Kabupaten</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
                       });
                       $('[name="id_kabupaten"]').html(option);
                   }
               })
           })
       })
    </script>
@stop
