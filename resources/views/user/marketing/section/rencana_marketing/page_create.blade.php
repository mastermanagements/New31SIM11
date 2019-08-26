@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rencana Marketing Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Data Rencana Marketing Perusahaan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table class="table table-striped">
								<tbody>
									<tr>
										<th style="width: 50px">Pilih Tahun Rencana Marketing</th>
									</tr>
									<tr>
								<form role="form" action="{{ url('store-rmb-onOff') }}" method="post">
										<td>
											<input type="hidden" name="off_on" value="{{ $off_on }}">
											<select class="form-control select2" style="width: 100%;" name="tahun" required>
												<option>Pilih Tahun</option>
													@foreach(Tahun() as $tahun)
														<option value="{{ $tahun }}">{{ $tahun }}</option>
													@endforeach 
											</select>
											<small style="color: red">* Tidak boleh kosong</small>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-striped">
							<p><b>Pilih Rencana Marketing Per Bulan Dalam 1 Tahun</b></p>
								<tbody>	
								@php($i=1)
									<tr>
										<th style="width: 10px">No</th>
										<th style="width: 60px">Bulan</th>
										<th style="width: 40px">Centang Pilihan</th>
									</tr>
									@foreach(Bulan() as $bulan)
									<tr>
										<td>{{ $i++ }}</td>
										<td> 
											{{ $bulan }}	
										</td>
										<td> 
											<input type="checkbox" name="bulan[]" value="{{ $bulan }}">
										</td>
									</tr>
									@endforeach		
					
								</tbody>
							</table>		
							
							<table class="table table-striped">
								<tbody>	
									<tr>
										<td align="right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary">Simpan</button>
										</td>
									</tr>
									</form>
								</tbody>
							</table>	
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop