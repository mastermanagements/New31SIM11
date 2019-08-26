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
                Halaman Ubah Positioning Perusahaan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Positioning Perusahaan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-positioning/'.$data_posisi_p->id) }}" enctype="multipart/form-data">
                            <div class="box-body">

                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
								
                                <div class="col-md-12">
                                    <div class="form-group">
										<label for="exampleInputEmail1">Nama Kompetitor</label>
											<select class="form-control select2" style="width: 100%;" name="id_kompetitor" required>
												@if(empty($data_kompetitor))
                                            <option>Data Kompetitor Masih Kosong</option>
											@else
												@foreach($data_kompetitor as $value)
                                                <option value="{{ $value->id }}" 
												@if($value->id == $data_posisi_p->id_kompetitor) selected @endif>
												{{ $value->nm_kompetitor }}
												</option>
												@endforeach
											@endif
											</select>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Nama Barang</label>
											<select class="form-control select2" style="width: 100%;" name="id_barang" required>
												@if(empty($data_barang))
                                            <option>Data Barang Masih Kosong</option>
											@else
												@foreach($data_barang as $value)
                                                <option value="{{ $value->id }}" 
												@if($value->id == $data_posisi_p->id_barang) selected @endif>
												{{ $value->nm_barang }}
												</option>
												@endforeach
											@endif
											</select>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Kelebihan Produk Kompetitor</label>
										<textarea class="form-control"  name="plus_produk_k" id="plus_produk_k"> {!! $data_posisi_p->plus_produk_k !!}
										</textarea>
										<small style="color: red" id="notify"></small>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Value Produk Kompetitor Bagi Konsumen</label>
										<textarea class="form-control"  name="value_produk_k" id="value_produk_k"> {!! $data_posisi_p->value_produk_k !!}
										</textarea>
										<small style="color: red" id="notify"></small>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Kekurangan Produk Kompetitor</label>
										<textarea class="form-control"  name="minus_produk_k" id="minus_produk_k"> {!! $data_posisi_p->minus_produk_k !!}</textarea>
										<small style="color: red" id="notify"></small>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Posisi Kompetitor Dalam Target Pasar</label>
											<select class="form-control select2" style="width: 100%;" name="posisi_k" required>
												@if(empty($data_posisi_m))
                                            <option>Data Positioning Masih Kosong</option>
											@else
												@foreach($data_posisi_m as $value)
                                                <option value="{{ $value->id }}" 
												@if($value->id == $data_posisi_p->id_posisi_k) selected @endif>
												{{ $value->posisi_perusahaan }}
												</option>
												@endforeach
											@endif
											</select>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Kelebihan Produk Perusahaan Anda</label>
										<textarea class="form-control"  name="plus_produk_p" id="plus_produk_p"> {!! $data_posisi_p->plus_produk_p !!}
										</textarea>
										<small style="color: red" id="notify"></small>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Value Produk Anda Bagi Konsumen</label>
										<textarea class="form-control"  name="value_produk_p" id="value_produk_p"> {!! $data_posisi_p->value_produk_p !!}
										</textarea>
										<small style="color: red" id="notify"></small>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Kekurangan Produk Anda Di banding Kompetitorr</label>
										<textarea class="form-control"  name="minus_produk_p" id="minus_produk_p"> {!! $data_posisi_p->minus_produk_p !!}</textarea>
										<small style="color: red" id="notify"></small>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Posisi Perusahaan Anda Terhadap Kompetitor Dalam Target Pasar</label>
											<select class="form-control select2" style="width: 100%;" name="posisi_p" required>
												@if(empty($data_posisi_m))
                                            <option>Data Positioning Masih Kosong</option>
											@else
												@foreach($data_posisi_m as $value)
                                                <option value="{{ $value->id }}" 
												@if($value->id == $data_posisi_p->id_posisi_p) selected @endif>
												{{ $value->posisi_perusahaan }}
												</option>
												@endforeach
											@endif
											</select>
									</div>
									
									<div class="form-group">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="put">
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
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