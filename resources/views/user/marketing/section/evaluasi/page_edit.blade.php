@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Halaman Ubah Data Evaluasi Marketing
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Evaluasi Marketing</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('update-evaluasi/'.$data_evaluasi->id) }}" enctype="multipart/form-data">
                            <div class="box-body">

                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <div class="col-md-12">
									<div class="form-group">
                                        <label for="exampleInputFile">Kriteria Evaluasi</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_kriteria_evaluasi" required>
                                            <option>Pilih Kriteria Evaluasi</option>
                                            @foreach($kriteria_evaluasi as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $data_evaluasi->id_kriteria_evaluasi ? 'selected' : '' }}>
													{{ $value->kriteria_evaluasi }}
												</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									<div class="form-group">
										<label for="exampleInputFile">Dimensi Evaluasi</label>
											<select class="form-control select2" style="width: 100%;" name="dimensi" required>
											@foreach($dimensi as $values)
													<option value="{{ $values }}" {{ $values == $data_evaluasi->dimensi ? 'selected' : '' }}>{{ $values }}</option>
											@endforeach
											</select>
										<small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputFile">Indikator Evaluasi</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_indikator_evaluasi" required>
                                            <option>Pilih Indikator Evaluasi</option>
                                            @foreach($indikator_evaluasi as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $data_evaluasi->id_indikator_evaluasi ? 'selected' : '' }}>
													{{ $value->indikator_evaluasi }}
												</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Content</label>
                                        <input name="jenis_content" class="form-control" placeholder="Jenis Content" value="{{ $data_evaluasi->jenis_content }}">
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Link URL</label>
                                        <input name="link_url" class="form-control" placeholder="Link URL" value="{{ $data_evaluasi->link_url }}">
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
									<div class="form-group">
                                        <label for="exampleInputFile">Solusi Marketing</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_solusi_evaluasi" required>
                                            <option>Tentukan Solusi Marketing</option>
                                            @foreach($solusi_evaluasi as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $data_evaluasi->id_solusi_evaluasi ? 'selected' : '' }}>
													{{ $value->solusi }}
												</option>
											@endforeach
                                        </select>
                                        <small style="color: red">* Tidak boleh kosong</small>
                                    </div>
									<div class="form-group">
                                        <label for="exampleInputEmail1">Keterangan</label>
                                        <textarea name="ket" class="form-control" placeholder="Keterangan" required>{{ $data_evaluasi->ket }}</textarea>
                                        <small style="color: red">* Tidak boleh kosong</small>
									</div>
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
