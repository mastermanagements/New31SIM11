@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
     <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Surat keluar
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir surat keluar</h3>
						<h5 class="pull-right"><a href="{{ url('Surat')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-surat-keluar') }}" method="post">
                        <div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Jenis Surat</label>
									<select class="form-control select2" style="width: 100%;" name="jenis_surat" required>
										@if(empty($jenis_surat))
											<option>Jabatan masih kosong</option>
										@else
											@foreach($jenis_surat as $value)
												<option value="{{ $value->id }}">{{ $value->jenis_surat_keluar }}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">No Surat </label>
									<input type="text" name="no_surat_keluar" class="form-control" id="exampleInputEmail1" required>
									<small style="color: red">* Tidak Boleh Kosong</small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Hal </label>
									<input type="text" name="hal" class="form-control" id="exampleInputEmail1" required>
									<small style="color: red">* Tidak Boleh Kosong</small>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Ditujukan Ke </label>
									<input type="text" name="ditujukan" class="form-control" id="exampleInputEmail1" required>
									<small style="color: red">* Tidak Boleh Kosong</small>
								</div>
							</div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Isi Surat </label>
                                <textarea name="isi_surat" class="form-control" id="isi_surat" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
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
        $('#datepicker1').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $(function () {
            $('.select2').select2()
        });

        window.onload = function() {
            CKEDITOR.replace('isi_surat',{
                height: 500
            } );
        };
    </script>
@stop