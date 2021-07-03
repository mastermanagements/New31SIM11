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
                Halaman Ubah Investor
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Investor</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-investor/'.$data_investor->id) }}" enctype="multipart/form-data">
                            <div class="box-body">

                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Investor</label>
                                        <input name="nm_investor" class="form-control" placeholder="Nama Investor" value="{{ $data_investor->nm_investor }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor.KTP</label>
                                        <input name="no_ktp" class="form-control" placeholder="Nomor. KTP" value="{{ $data_investor->no_ktp }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan Password baru anda,Password Minimal 6 karakter" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat</label>
                                        <textarea name="alamat" class="form-control" placeholder="Nomor KTP" required>{{ $data_investor->alamat }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Provinsi</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                                            <option>Pilih Provinsi</option>
                                            @foreach($provinsi as $value)
                                                <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Kabupaten</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_kabupaten" required>
                                            <option>Pilih Kabupaten</option>
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor. Handphone</label>
                                        <input name="hp" class="form-control" placeholder="Nomor. Handphone" value="{{ $data_investor->hp }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor. Whatshapp</label>
                                        <input name="wa" class="form-control" placeholder="Nomor. Whatshapp" value="{{ $data_investor->wa }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jumlah Saham</label>
                                        <input name="jum_saham" class="form-control" placeholder="Jumlah Saham Investor" value="{{ $data_investor->jum_saham }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File Scan KTP</label>
                                        <input type="file" id="exampleInputFile" name="file_ktp">
                                        <input type="hidden" id="exampleInputFile"  value="{{ $data_investor->file_ktp }}"  name="file_ktp_old">
                                        <small>Nama file scan ktp anda {{ $data_investor->file_ktp }}</small>
                                        <p class="help-block" style="color:red">*Format file yang disarankan .jpg, png, gif</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Ahli Waris</label>
                                        <input name="nm_ahli_waris" class="form-control" placeholder="Nama Ahli Waris" value="{{ $data_investor->nm_ahli_waris }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Nomor. Handphone Ahli Waris</label>
                                        <input name="no_hp_aw" class="form-control" placeholder="Nama Ahli Waris" value="{{ $data_investor->no_hp_aw }}" required>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat Ahli Waris</label>
                                        <textarea name="alamat_aw" class="form-control" placeholder="Nomor KTP" required> {{ $data_investor->alamat_aw }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id_usaha" value="{{ $id_usaha }}">
                                        <input type="hidden" name="_method" value="put">
                                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">

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