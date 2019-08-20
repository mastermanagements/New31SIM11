@extends('user.marketing.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Evaluasi Marketing
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><b>Evaluasi Marketing (Google Analytic)</b></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
							</br>
							<div class="col-md-12">
									<label style="font-size: 15px">Evaluasi Marketing Tahun {{now()->year }} </label>
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
													<button type="button" class="btn btn-box-tool" onclick="tambahevaluasiM()" title="Tambah Evaluasi Marketing"><i class="fa fa-plus"></i></button>
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
													<th>Item Evaluasi</th>
													<th>Dimensi</th>
													<th>Indikator</th>
													<th>Jenis Content</th>
													<th>Link URL</th>
													<th>Solusi</th>
													<th>Keterangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php($i=1)
												@foreach($data_evaluasi as $evaluasi)
													@foreach($kriteria_evaluasi as $k_evaluasi)
													@foreach($indikator_evaluasi as $i_evaluasi)
													@foreach($solusi_evaluasi as $s_evaluasi)
														@if(($evaluasi->id_kriteria_evaluasi == $k_evaluasi->id) AND 
															($evaluasi->id_indikator_evaluasi == $i_evaluasi->id) AND 
															($evaluasi->id_solusi_evaluasi == $s_evaluasi->id))
														<tr>
															<td>{{ $i++ }}</td>
															<td>{{ date('d-m-Y h:i:s', strtotime($evaluasi->created_at ))}} </td>
															<td>{{ $evaluasi->getKevaluasi->kriteria_evaluasi }}</td>
															<td>{{ $evaluasi->dimensi }}</td>
															<td>{{ $evaluasi->getIevaluasi->indikator_evaluasi }}</td>
															<td>{{ $evaluasi->jenis_content }}</td>
															<td><a href="{{ $evaluasi->link_url }}">{{ $evaluasi->link_url }}</a></td>
															<td>{{ $evaluasi->getSevaluasi->solusi }}</td>
															<td>{{ $evaluasi->ket}}</td>
															<td>
																<form action="{{ url('hapus-evaluasi/'.$evaluasi->id) }}" method="post">
																<a href="{{ url('ubah-evaluasi/'.$evaluasi->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
																{{ csrf_field() }}
																<input type="hidden" name="_method" value="put"/>
																<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data evaluasi marketing ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
																</form>
															</td>
														</tr>
														@endif
														@endforeach
														@endforeach
													@endforeach
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
                        <!-- /.tab-1-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
	@include('user.marketing.section.evaluasi.include.modal_evaluasi')
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
		
			tambahevaluasiM = function () {
                $('#modal-tambah-evaluasiM').modal('show');
            };
			tambahKE = function () {
                $('#modal-tambah-KEvaluasi').modal('show');
            };
			tambahIE = function () {
                $('#modal-tambah-IEvaluasi').modal('show');
            };
			tambahSE = function () {
                $('#modal-tambah-SEvaluasi').modal('show');
            };
		
		})		
		
	</script>
@stop