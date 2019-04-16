@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Peralatan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Peralatan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-peralatan/'. $data_alat->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

							<div class="form-group">
                                    <label for="exampleInputEmail1">Nama Alat</label>
                                    <input type="text" name="nm_alat" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->nm_alat }}" required>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Satuan</label>
                                    <input type="text" name="satuan" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->satuan }}" required>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Alat</label>
                                    <input type="text" name="jumlah_alat" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->jumlah_alat }}" required>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Merk</label>
                                    <input type="text" name="merk" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->merk }}">       
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Tipe</label>
                                    <input type="text" name="tipe" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->tipe }}">       
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Tahun Pembuatan</label>
                                    <input type="text" name="thn_buat" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->thn_buat }}">       
                            </div>
							<div class="form-group">
                                    <label>Tanggal Pembelian</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Pembelian" value="{{ date('d-m-Y', strtotime($data_alat->tgl_beli)) }}" name="tgl_beli">
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak boleh kosong</small>
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Kondisi Peralatan</label>
                                    <input type="text" name="kondisi_alat" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->kondisi_alat }}">       
                            </div>
							<div class="form-group">
                                    <label for="exampleInputEmail1">Bukti Kepemilikan</label>
                                    <input type="text" name="bukti_kepemilikan" class="form-control" id="exampleInputEmail1" value="{{ $data_alat->bukti_kepemilikan }}">       
                            </div>
                            <div class="form-group">
                                          <label for="exampleInputFile">File Bukti Kepemilikan</label>
                                          <input type="file" id="exampleInputFile" name="file_bukti">
                                          <input type="hidden" id="exampleInputFile" name="file_bukti_old" value="{{ $data_alat->file_bukti }}">
                                          <small>Anda telah meng-unggah berkas anda dengan nama: {{$data_alat->file_bukti }}</small>
                                          <p class="help-block" style="color:red">*Format file yang disarankan .jpg, jpeg, png, gif</p>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
//        $('#datepicker1').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop