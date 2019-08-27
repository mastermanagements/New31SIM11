@extends('user.marketing.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeliharaan Marketing - Delighting (Menjaga Loyalitas Konsumen)
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>
		
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><b>Tambah Delighting</b></a></li>
						<li><a href="#tab_2" data-toggle="tab"><b>Data Delighting</b></a></li>
					</ul>
                    <div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<div class="box box-default">
								<div class="box-header with-border">
									<h3 class="box-title">Fomulir Tambah Delighting</h3>
								</div>
								<form role="form" action="{{ url('store-delight') }}" method="post" enctype="multipart/form-data">
									<div class="box-body">
										@php($waktu_now = \Carbon\Carbon::now())		
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal Kegiatan</label>
												<input type="text" readonly="readonly" class="form-control" id="exampleInputEmail1" value="{{ $waktu_now->format('d-m-Y H:i:s') }}">
										</div>
											<label for="exampleInputEmail1">Nama Customer</label>
										@foreach($data_klien as $klien)
										<div class="form-group">
											<input type="checkbox" name="id_klien[]" value="{{ $klien->id }}">&nbsp;{{ $klien->nm_klien }}
										</div>
										@endforeach
											<small style="color: red">* Tidak Boleh Kosong, bisa pilih lebih dari satu customer</small>
										<div class="form-group">
											<label for="exampleInputFile">Tool Delighting</label>
											<select class="form-control select2" style="width: 100%;" name="tool_delight" required>
												<option>Pilih Tool Delighting </option>
												@foreach($tool_delight as $value)
													<option value="{{ $value}}">{{ $value}}</option>
												@endforeach
											</select>
											<small style="color: red">* Tidak boleh kosong</small>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Pesan Ke Customer</label>
												<textarea name="content_delight" class="form-control" required></textarea>
												<small style="color: red">* Tidak Boleh Kosong</small>
										</div>
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>			
						</div>
                        <!-- /.tab-1-pane -->
						<div class="tab-pane" id="tab_2">
							</br>
							<div class="col-md-12">
									<label style="font-size: 15px">Delighting Marketing Tahun {{now()->year }} </label>
							</div>
							</br></br>
	
							@if(!empty($data_rm))
								@foreach($data_rm->sortBy('id') as $rm)
								<div class="box box-default collapsed-box">
									<div class="box-header with-border">
										<h1 class="box-title">
											<b>{{ $rm->bulan}}</b>
										</h1>
											@if ((!empty ($rm->tahun) && ($rm->bulan)))
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="buka tutup isi"></i></button>				
												</div>
											@endif
									</div>
									<div class="box-body">	
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal</th>
													<th>Nama Customer</th>
													<th>Menghubungi Via</th>
													<th>Pesan Delight</th>
													<th>Respon Customer</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php($i=1)
												@foreach($data_delight as $delight)
												<tr>
													<td>{{ $i++ }}</td>
													<td>{{ date('d-m-Y h:i:s', strtotime($delight->created_at ))}} </td>
													<td>{{ $delight->getKlien->nm_klien }}</td>
													<td>{{ $delight->tool_delight }}</td>
													<td>{{ $delight->content_delight }}</td>
													<td><a href="{{ url('detail-delight/'.$delight->id) }}">
															<span class="badge bg-red">Lihat</span>
														</a>
													</td>
													<td>
														<button type="button" class="btn btn-primary" onclick="tambahResponD('{{ $delight->id }}');" title="Tambah Respon"><i class="fa  fa-sticky-note-o"></i></button>
														<a href="{{ url('ubah-delight/'.$delight->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
														<form action="{{ url('hapus-delight/'.$delight->id) }}" method="post">
														{{ csrf_field() }}
														<input type="hidden" name="_method" value="put"/>
														<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data delighting ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
														</form>
													</td>
												</tr>
												@endforeach
											</tbody>	
										</table>
									</div>
									<!-- /.box body -->
								</div>
								<!-- /.collapsed-box -->
								@endforeach
						@else
							<div>
								<p> Isi dulu data rencana marketing !!!</p>
							</div>
							@endif
                        </div>
                        <!-- /.tab-2-pane -->
					</div>
					<!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
			<!-- md-12 -->
        </div>
		<!-- /.raw -->
	</section>
</div>
<!-- /.content wrapper-->
	@include('user.marketing.section.delight.include.modal_delight')
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
	<script>
		$(function () {
            $('.select2').select2();
        });
		
		$(document).ready(function () {
            var ids;	
		
			tambahResponD = function (id) {
			//alert("test")
				$('[name="id_delight"]').val(id);
                $('#modal-tambah-ResponD').modal('show');
            };
		
		})		
		
	</script>
@stop
