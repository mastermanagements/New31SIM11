@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Halaman Ubah Data Delighting Marketing
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Delighting Marketing</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-delight/'.$delight->id)}}" enctype="multipart/form-data">
                            <div class="box-body">

                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <div class="col-md-12">
									<div class="form-group">
                                        <label for="exampleInputFile">Customer</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                            <option>Pilih Customer</option>
                                            @foreach($klien as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $delight->id_klien ? 'selected' : '' }}>
												{{ $value->nm_klien }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									<div class="form-group">
										<label for="exampleInputFile">Tool Delighting</label>
											<select class="form-control select2" style="width: 100%;" name="tool_delight" required>
											@foreach($tool_delight as $values)
													<option value="{{ $values }}" {{ $values == $delight->tool_delight ? 'selected' : '' }}>{{ $values }}</option>
											@endforeach
											</select>
										<small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Pesan Delight</label>
                                        <textarea name="content_delight" class="form-control" placeholder="Pesan Delight">{{ $delight->content_delight }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Respon Customer</label>
										@if(!empty($respon_delight->respon_klien))
											<textarea name="respon_klien" class="form-control" placeholder="Respon Customer">{{ $respon_delight->respon_klien }}</textarea>
                                        @else
											<textarea name="respon_klien" class="form-control" placeholder="Respon Customer"></textarea>
										@endif
										<small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputFile">Departemen</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_bagian_p">
                                            <option value="0">Pilih Departemen</option>
                                            @foreach($bagian_p as $value)
												@if(!empty($respon_delight->id_bagian))
													<option value="{{ $value->id }}" {{ $value->id == $respon_delight->id_bagian ? 'selected' : '' }}>{{ $value->nm_bagian }}</option>
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
											@if(!empty($respon_delight->id_divisi))
                                                <option value="{{ $value->id }}" {{ $value->id == $respon_delight->id_divisi ? 'selected' : '' }}>{{ $value->nm_devisi }}</option>
                                            @else
												<option value="{{ $value->id }}">{{ $value->nm_devisi }} </option>
											@endif
											@endforeach
                                        </select>
                                    </div>
					
									<input type="hidden" name="id_delight" value="{{ $respon_delight->id_delight }}">
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