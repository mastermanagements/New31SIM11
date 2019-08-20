@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Positioning Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Data Positioning Perusahaan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-positioning') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
								<label for="exampleInputEmail1">Nama Kompetitor</label>
									<select class="form-control select2" style="width: 100%;" name="id_kompetitor" required>
									@if(empty($data_kompetitor))
										<option>Data Kompetitor Belum di isi</option>
										@else
										<option>Pilih Kompetitor</option>
										@foreach($data_kompetitor as $kompetitor)
										<option value="{{ $kompetitor->id }}">{{ $kompetitor->nm_kompetitor }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Barang</label>
									<select class="form-control select2" style="width: 100%;" name="id_barang" required>
									@if(empty($data_barang))
										<option>Data Barang Belum di isi</option>
										@else
										<option>Pilih Barang</option>
										@foreach($data_barang as $barang)
										<option value="{{ $barang->id }}">{{ $barang->nm_barang }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Kelebihan Produk Kompetitor</label>
								<textarea name="plus_produk_k" class="form-control" id="plus_produk_k" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Value Produk Kompetitor Bagi Konsumen</label>
								<textarea name="value_produk_k" class="form-control" id="value_produk_k" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Kekurangan Produk Kompetitor</label>
								<textarea name="minus_produk_k" class="form-control" id="minus_produk_k" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
								<label for="exampleInputEmail1">Posisi Kompetitor Dalam Target Pasar</label>
									<select class="form-control select2" style="width: 100%;" name="posisi_k" required>
									@if(empty($data_posisi_m))
										<option>Data Belum di isi</option>
										@else
										<option>Pilih Positioning Kompetitor</option>
										@foreach($data_posisi_m as $posisi_m)
										<option value="{{ $posisi_m->id }}">{{ $posisi_m->posisi_perusahaan }}</option>
										@endforeach
									@endif
									</select>
								<small style="color: red">* Tidak Boleh Kosong</small>
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Kelebihan Produk Perusahaan Anda</label>
								<textarea name="plus_produk_p" class="form-control" id="plus_produk_p" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Value Produk Anda Bagi Konsumen</label>
								<textarea name="value_produk_p" class="form-control" id="value_produk_p" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Kekurangan Produk Anda Di banding Kompetitor</label>
								<textarea name="minus_produk_p" class="form-control" id="minus_produk_p" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
								<label for="exampleInputEmail1">Posisi Perusahaan Anda Terhadap Kompetitor Dalam Target Pasar</label>
									<select class="form-control select2" style="width: 100%;" name="posisi_p" required>
									@if(empty($data_posisi_m))
										<option>Data Belum di isi</option>
										@else
										<option>Pilih Positioning Kompetitor</option>
										@foreach($data_posisi_m as $posisi_m)
										<option value="{{ $posisi_m->id }}">{{ $posisi_m->posisi_perusahaan }}</option>
										@endforeach
									@endif
									</select>
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
 <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();
		   
		CKEDITOR.replace( 'plus_produk_k',{
                height: 100
           } );
		CKEDITOR.replace( 'minus_produk_k',{
                height: 100
           } );
		CKEDITOR.replace( 'plus_produk_p',{
                height: 100
           } );  
		CKEDITOR.replace( 'minus_produk_p',{
                height: 100
           } );   
       })
    </script>
@stop