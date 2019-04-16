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
            Daftar Inventaris Peralatan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Inventaris Peralatan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-peralatan') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
						<div class="form-group">
                                <label for="exampleInputEmail1">Nama Peralatan</label>
                                <input name="nm_alat" class="form-control" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                         </div>
						<div class="form-group">
                                <label for="exampleInputEmail1">Satuan</label>
                                <input name="satuan" class="form-control" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                         </div>
						<div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Peralatan</label>
                                <input name="jumlah_alat" class="form-control" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                        </div>
						<div class="form-group">
                                <label for="exampleInputEmail1">Merk</label>
                                <input name="merk" class="form-control"/>
                        </div>
						 <div class="form-group">
                                <label for="exampleInputEmail1">Tipe</label>
                                <input name="tipe" class="form-control"/>
                        </div>       
                         
						<div class="form-group">
                                <label for="exampleInputEmail1">Tahun Buat</label>
                                <input name="thn_buat" class="form-control"/>
						</div>
                         
						 <div class="form-group">
                                <label>Tanggal Pembelian</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Pembelian" name="tgl_beli" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                         </div>
						 <div class="form-group">
                                <label for="exampleInputEmail1">Kondisi Peralatan</label>
                                <input name="kondisi_alat" class="form-control" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                         </div>
						 <div class="form-group">
                                <label for="exampleInputEmail1">Bukti Kepemilikan</label>
                                <input name="bukti_kepemilikan" class="form-control"/>
                                
                         </div>
                         <div class="form-group">
                                          <label for="exampleInputFile">File Bukti Kepemilikan</label>
                                          <input type="file" id="exampleInputFile" name="file_bukti" required>
                                          <p class="help-block" style="color:red">* Tidak Boleh Kosong, Format file yang disarankan .jpg, .jpeg, .png, .gif</p>
                         </div>
						
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
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

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop