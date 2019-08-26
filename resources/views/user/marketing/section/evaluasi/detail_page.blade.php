@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Histori Closing Per Customer Per Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- Profile Image -->
               <div class="box box-primary">
                   <div class="box-body box-profile">
						<table>
							<tr>
							<h3 class="profile-username text-left">
								<font color="#24ABCF">
								<th>Nama Customer&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</th>
								<td>{{ $closing->getKlien->nm_klien }}</td>
							
							</tr>
							<tr>
								@if($closing->id_barang !== NULL )
								<th>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</th>
								<td>{{ $closing->getBarang->nm_barang }} </td>
								@else
								<th>Nama Layanan&nbsp;&nbsp;:&nbsp;</th>
								<td>{{ $closing->getJasa->nm_jasa }} </td>	
								@endif
								</font>	</h3>
							</tr>
						</table></br>
						<table id="example11" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
									<th>Tanggal</th>
                                    <th>Closing Via</th>
                                    <th>Pesan Closing</th>
                                    <th>Respon Customer</th>
                                    <th>Hasil Closing</th>
									<th>Follow up Ke</th>
                                    <th>Status </th>
                                    <th>Keterangan</th>   
                                    <th>Aksi</th>   
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
								@foreach($status_closing as $st_closing)
                                    <tr>
                                        <td>{{ $i++ }}</td>
										<td>{{ date('d-m-Y h:i:s', strtotime($st_closing->created_at ))}} </td>
                                        <td>{{ $st_closing->tool_closing }}</td>
                                        <td>{{ $st_closing->content_closing }}</td>
										<td>{{ $st_closing->respon_klien }}</td>
									    <td>{{ $st_closing->hasil_akhir }}</td>
										<td> 
											@if($st_closing->id_bagian !== 0) 
											 Departemen : &nbsp;	
											{{ $st_closing->getBagian->nm_bagian }},&nbsp;
											 @endif
											 @if($st_closing->id_divisi !== 0 AND $st_closing->id_divisi !== NULL) 
											 Divisi : 	
											 
											{{ $st_closing->getDivisi->nm_devisi }}
											@endif	
										</td>
										<td>
											@if($st_closing->status_closing == 'Close')
											<font color="red">{{ $st_closing->status_closing }}</font>
											@else
												<font color="35C30F">{{ $st_closing->status_closing }}</font>
											@endif
										</td>
										<td>{{ $st_closing->ket }}</td>	
										<td><a href="{{ url('ubah-closing/'.$st_closing->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a></td>	
                                    </tr>
								@endforeach
                                </tbody>
                            </table>	
						
                   </div>
                   <!-- /.box-body -->
               </div>
               <!-- /.box -->
           </div>

       </div>
    </section>
    <!-- /.content -->
</div>
@stop
