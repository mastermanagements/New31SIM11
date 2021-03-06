@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Leads
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Data Leads</h3>
                        <h5 class="pull-right"><a href="{{ url('Klien')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-leads') }}" method="post">

                        <div class="box-body">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama </label>&nbsp;<strong style="color: red">*</strong>
                                <input type="text" name="nm_klien" class="form-control" id="exampleInputEmail1" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat </label>
                                <textarea class="form-control"  name="alamat" id="alamat" ></textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" id="exampleInputEmail1" >

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone</label>
                                <input type="text" name="hp"  class="form-control" id="exampleInputEmail1" >

                            </div>

                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Whatshapp</label>
                                <input type="text" name="wa"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telegram</label>
                                <input type="text" name="teleg"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Instagram</label>
                                <input type="text" name="ig"  class="form-control" id="exampleInputEmail1">
                            </div>

                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook</label>
                                <input type="text" name="fb"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Twitter</label>
                                <input type="text" name="twiter"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perusahaan</label>
                                <input type="text" name="nm_perusahaan"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Perusahaan</label>
                                <textarea class="form-control"  name="alamat_perusahaan" id="alamat_perusahaan"></textarea>
                            </div>

                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telp Perusahaan</label>
                                <input type="text" name="telp_perusahaan" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1">
                                <input type="hidden" name="jenis_klien" value="1" class="form-control" id="exampleInputEmail1">
                            </div>
              							<div class="form-group">
                  							<label for="exampleInputEmail1" >Info Customer Dari</label>
                  								<select class="form-control select2" style="width: 100%;" name="id_sdk" >
                  								@if(empty($SDK))
                  									<option>Sumber Data Klien Belum di Isi</option>
                  								@else
                  									<option value="0">Pilih</option>
                  									@foreach($SDK as $sdk)
                                      <option value="{{ $sdk->id }}">{{ $sdk->sumber_media }}</option>
                  									@endforeach
                  								@endif
                  								</select>
              							</div>
              							<div class="form-group">
              								<label for="exampleInputFile">Penanda</label>
              								<select class="form-control select2" style="width: 100%;" name="id_penanda_sdk">
              									<option value="0">Pilih</option>
              								</select>

              							</div>
            							  <div class="form-group">
                                <label for="exampleInputEmail1">Ket Tambahan Info Customer</label>
                                <input type="text" name="tambahan_sdk" class="form-control" id="exampleInputEmail1">
                            </div>
                          </div>
                        <div class="col-md-12">
                          <div class="box-footer">
                            <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                          </div>
            							<div class="box-footer">
            								{{ csrf_field() }}
            								<button type="submit" class="btn btn-primary">Simpan</button>
            							</div>
                        </div>
                      </div>
                      <!-- /.box-body -->
					         </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
	@include('user.administrasi.section.klien.modal.modal_detail_view')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.klien.modal.JS')
@stop
