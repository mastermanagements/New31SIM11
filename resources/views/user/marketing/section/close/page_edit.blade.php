@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Halaman Ubah Data Closing Marketing
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Closing Marketing</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-closing/'.$status_closing->id) }}" enctype="multipart/form-data">
                            <div class="box-body">

                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <div class="col-md-12">
									<div class="form-group">
                                        <label for="exampleInputFile">Leads/Customer</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                            <option>Pilih Customer</option>
                                            @foreach($klien as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $data_closing_e->id_klien ? 'selected' : '' }}>
												@if($value->jenis_klien =='1')
													Leads
												@else
													Customer 
												@endif
												--
												{{ $value->nm_klien }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									@if($data_closing_e->id_jasa == NULL)
										<div class="form-group">
											<label for="exampleInputFile">Barang</label>
											<select class="form-control select2" style="width: 100%;" name="id_barang" required>
												<option>Pilih Barang</option>
												@foreach($barang as $value)
													<option value="{{ $value->id }}" {{ $value->id == $data_closing_e->id_barang ? 'selected' : '' }}>{{ $value->nm_barang }}</option>
												@endforeach
											</select>
											<small style="color: red">* Tidak boleh kosong</small>
										</div>
									@elseif($data_closing_e->id_barang == NULL)
										<div class="form-group">
											<label for="exampleInputFile">Jasa</label>
												<select class="form-control select2" style="width: 100%;" name="id_jasa" required>
													<option>Pilih Jasa</option>
													@foreach($jasa as $value)
														<option value="{{ $value->id }}" {{ $value->id == $data_closing_e->id_jasa ? 'selected' : '' }}>{{ $value->nm_jasa }}</option>
													@endforeach
												</select>
												<small style="color: red">* Tidak boleh kosong</small>
										</div>
									@endif
									
									<div class="form-group">
										<label for="exampleInputFile">Tool Closing</label>
											<select class="form-control select2" style="width: 100%;" name="tool_closing" required>
											@foreach($tool_closing as $values)
													<option value="{{ $values }}" {{ $values == $status_closing->tool_closing ? 'selected' : '' }}>{{ $values }}</option>
											@endforeach
											</select>
										<small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Pesan Closing</label>
                                        <textarea name="content_closing" class="form-control" placeholder="Pesan Closing" required>{{ $status_closing->content_closing }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Respon Customer</label>
                                        <textarea name="respon_klien" class="form-control" placeholder="Respon Customer">{{ $status_closing->respon_klien }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
										<label for="exampleInputFile">Hasil Closing</label>
											<select class="form-control select2" style="width: 100%;" name="hasil_akhir" required>
											@foreach($hasil_akhir as $values)
													<option value="{{ $values }}" {{ $values == $status_closing->hasil_akhir ? 'selected' : '' }}>{{ $values }}</option>
											@endforeach
											</select>
										<small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputFile">Departemen</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_bagian_p">
                                            <option value="0">Pilih Departemen</option>
                                            @foreach($bagian_p as $value)
												@if(!empty($status_closing->id_bagian))
													<option value="{{ $value->id }}" {{ $value->id == $status_closing->id_bagian ? 'selected' : '' }}>{{ $value->nm_bagian }}</option>
												@else
													<option value="{{ $value->id }}"}}>{{ $value->nm_bagian }}</option>
												@endif
											@endforeach
                                        </select>
										 
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Divisi</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_divisi_p">
                                            <option value="0">Pilih Divisi</option>
											@foreach($divisi_p as $value)
											@if(!empty($status_closing->id_divisi))
                                                <option value="{{ $value->id }}" {{ $value->id == $status_closing->id_divisi ? 'selected' : '' }}>{{ $value->nm_devisi }}</option>
                                            @else
												<option value="{{ $value->id }}">{{ $value->nm_devisi }} </option>
											@endif
											@endforeach
                                        </select>
                                    </div>
									<div class="form-group">
										<label for="exampleInputFile">Status Closing</label>
											<select class="form-control select2" style="width: 100%;" name="status_closing" required>
											@foreach($status_closing_f as $values)
													<option value="{{ $values }}" {{ $values == $status_closing->status_closing ? 'selected' : '' }}>{{ $values }}</option>
											@endforeach
											</select>
										<small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Keterangan</label>
                                        <textarea name="ket" class="form-control" placeholder="Content Closing" required>{{ $status_closing->ket }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
									<input type="text" name="id_closing" value="{{ $status_closing->id_closing }}">
									<div class="form-group">
                                        {{csrf_field()}}
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
    <script>
	window.onload = function() {
		 
		$('[name="id_bagian_p"]').change(function () {
               $.ajax({
                   url:"{{ url('getDivisi') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option value='0'>Pilih Divisi</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nm_devisi+"</option>";
                       });
                       $('[name="id_divisi_p"]').html(option);
                   }
               })
			})
	};
	
	</script>
@stop