@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Ubah Karyawan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Karyawan</h3>
                       <h5 class="pull-right"><a href="{{ url('pengguna-karyawan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('update-karyawan/'.$data_karyawan->id) }}" enctype="multipart/form-data">
                   <div class="box-body">

                              @if(!empty(session('message_success')))
                                  <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                              @elseif(!empty(session('message_fail')))
                                  <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                              @endif
                          <div class="col-md-6">
                              <!--<div class="form-group">
                                  <label for="exampleInputEmail1">NIK</label>
                                  <input name="nik" class="form-control" placeholder="Nomor Induk Karyawan" value="{{ $data_karyawan->nik }}" required>
                                  <small style="color: red">* Tidak boleh kosalesng</small>
                              </div>-->
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Karyawan</label>
                                  <input name="nama_ky" class="form-control" placeholder="Nama Karyawan" value="{{ $data_karyawan->nama_ky }}" required>
                                  <small style="color: red">* Tidak boleh kosalesng</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Username</label>
                                  <input name="username" class="form-control" placeholder="Username" value="{{ $data_karyawan->username }}" required>
                                  <small style="color: red">* Tidak boleh kosalesng</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Password</label>
                                  <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru Anda" required>
                                  <small style="color: red">* Tidak boleh kosalesng</small>
                              </div>

                                    <!--  <div class="form-group">
                                          <label for="exampleInputEmail1">Nomor KTP</label>
                                          <input name="no_ktp" class="form-control" placeholder="Nomor KTP" value="{{ $data_karyawan->no_ktp }}" required>
                                          <small style="color: red">* Tidak boleh kosalesng</small>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputFile">File Scan KTP</label>
                                          <input type="file" id="exampleInputFile" name="file_ktp">
                                          <input type="hidden" id="exampleInputFile" name="file_ktp_old" value="{{ $data_karyawan->file_ktp }}">
                                          <small>Anda telah meng-unggah berkas anda dengan nama: {{$data_karyawan->file_ktp }}</small>
                                          <p class="help-block" style="color:red">*Format file yang disarankan .jpg, png, gif</p>
                                      </div>-->
                                    <!--<div class="form-group">
                                          <label for="exampleInputEmail1">Tempat Lahir</label>
                                          <input type="text" name="tmp_lahir" class="form-control" placeholder="Tempat Lahir karyawan" value="{{ $data_karyawan->tmp_lahir }}" required>
                                          <small style="color: red">* Tidak boleh kosalesng</small>
                                      </div>
                                      <div class="form-group">
                                          <label>Tanggal Lahir</label>

                                          <div class="input-group date">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Lahir Karyawan" name="tgl_lahir" value="{{ date('d-m-Y', strtotime($data_karyawan->tgl_lahir)) }}" required>
                                          </div>
                                          <!-- /.input group -->
                                        <!--  <small style="color: red">* Tidak boleh kosalesng</small>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Jenis Kelamin</label>
                                          <div class="form-group">
                                              @foreach($jenis_kelamin as $key => $jengkel)
                                                  <label>
                                                      <input type="radio"  name="jenis_kel" class="minimal" @if($key==$data_karyawan->jenis_kel) checked @endif value="{{ $key }}" required>
                                                      {{ $jengkel }}
                                                  </label>
                                              @endforeach
                                              <p></p>
                                              <small style="color: red">* Tidak Boleh Kosalesng</small>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Agama</label>
                                          <div class="form-group">
                                              @foreach($agama as $key => $agama)
                                                  <label>
                                                      <input type="radio"  name="agama" class="minimal" @if($agama==$data_karyawan->agama) checked @endif value="{{ $agama }}" required>
                                                      {{ $agama }}
                                                  </label>
                                              @endforeach
                                              <p></p>
                                              <small style="color: red">* Tidak Boleh Kosalesng</small>
                                          </div>
                                      </div>-->
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Status Kerja</label>
                                          <div class="form-group">
                                              @foreach($status_kerja as $key => $status)
                                                  <label>
                                                      <input type="radio"  name="status_kerja" class="minimal" @if($key==$data_karyawan->status_kerja) checked @endif value="{{ $key }}" required>
                                                      {{ $status }}
                                                  </label>
                                              @endforeach
                                              <p></p>
                                              <small style="color: red">* Tidak Boleh Kosalesng</small>
                                          </div>
                                      </div>

                            </div>

                            <!--<div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Golongan Darah</label>
                                          <div class="form-group">
                                              @foreach($gol_darah as  $gol)
                                                  <label>
                                                      <input type="radio"  name="gol_darah" class="minimal" @if($gol==$data_karyawan->gol_darah) checked @endif  value="{{ $gol }}" required>
                                                      {{ $gol }}
                                                  </label>
                                              @endforeach
                                              <p></p>
                                              <small style="color: red">* Tidak Boleh Kosalesng</small>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputFile"> File Scan CV Karyawan</label>
                                          <input type="file" id="exampleInputFile" name="cu_vitae">
                                          <input type="hidden" name="cu_vitae_old" value="{{ $data_karyawan->cu_vitae }}">
                                          <small>Anda telah meng-unggah berkas anda dengan nama: {{ $data_karyawan->cu_vitae }}</small>
                                          <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png, .gif</p>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputFile">Pas Foto</label>
                                          <input type="file" id="exampleInputFile" name="pas_foto">
                                          <input type="hidden" name="pas_foto_old" value="{{ $data_karyawan->pas_foto }}">
                                          <small>Anda telah meng-unggah berkas anda dengan nama: {{ $data_karyawan->pas_foto  }}</small>
                                          <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png, .gif</p>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Nama Bank</label>
                                          <input name="nm_bank" class="form-control" placeholder="Contoh: Mandiri, BCA, BRI, Dll." value="{{ $data_karyawan->nm_bank }}" required>
                                          <small style="color: red">* Tidak boleh kosalesng</small>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">No. Rek</label>
                                          <input name="no_rek" class="form-control" placeholder="Nomor Rekening Tabungan" value="{{ $data_karyawan->no_rek }}">
                                          <small style="color: red">* Tidak boleh kosalesng</small>
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                                          <input name="pend_akhir" class="form-control" placeholder="" value="{{ $data_karyawan->pend_akhir }}" >
                                          <small style="color: orange">* Isi jika perlu</small>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Program Studi</label>
                                          <input name="program_studi" class="form-control" placeholder="" value="{{ $data_karyawan->program_studi }}" >
                                          <small style="color: orange">* Isi jika perlu</small>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Perguruan Tinggi</label>
                                          <input name="pt" class="form-control" placeholder="" value="{{ $data_karyawan->pt }}" >
                                          <small style="color: orange">* Isi jika perlu</small>
                                      </div>
                                      <div class="form-group">
                                          <label>Tanggal Masuk</label>

                                          <div class="input-group date">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Masuk Kerja" name="tgl_masuk" value="{{ date('d-m-Y', strtotime($data_karyawan->tgl_lahir)) }}" required>
                                          </div>

                                          <small style="color: red">* Tidak boleh kosalesng</small>
                                      </div>
                                  </div>-->
                            </div>
                   <div class="box-footer">
                       {{csrf_field()}}
                       <input type="hidden" name="id_usaha" value="{{ $id_usaha }}">
                       <input type="hidden" name="_method" value="put">
                       <button type="submit" class="btn btn-primary pull-left">Simpan</button>
                   </div>
                   </form>
               </div>
               <!-- /.box -->
           </div>
       </div>


    </section>
    <!-- /.content -->
</div>
@stop


@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>


        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();

           //Date picker
           $('#datepicker').datepicker({
               autoclose: true,
               format: 'dd-mm-yyyy'
           });
         $('#datepicker1').datepicker({
               autoclose: true,
               format: 'dd-mm-yyyy'
           });

           //iCheck for checkbox and radio inputs
           $('input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           })

       })
    </script>
@stop
