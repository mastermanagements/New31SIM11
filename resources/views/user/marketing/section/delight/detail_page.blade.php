@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Histori Delighting Per Customer
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
								<td>{{ $delight->getKlien->nm_klien }}</td>
							
							</tr>
							<tr>
								<th>Tool Delighting&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</th>
								<td>{{ $delight->tool_delight }}</td>
							</tr>
							<tr>
								<th>Pesan Ke Customer&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</th>
								<td>{{ $delight->content_delight }}</td>
								</font>	</h3>
							</tr>
						</table></br>
						<table id="example11" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
									<th>Tanggal</th>
                                    <th>Respon Customer</th>
									<th>Follow up Ke</th>  
                                    <th>Aksi</th>   
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
								@foreach($respon_delight as $res_delight)
                                    <tr>
                                        <td>{{ $i++ }}</td>
										<td>{{ date('d-m-Y h:i:s', strtotime($res_delight->created_at ))}} </td>
										<td>{{ $res_delight->respon_klien }}</td>
										<td> 
											@if($res_delight->id_bagian !== 0) 
											 Departemen : &nbsp;	
											{{ $res_delight->getBagian->nm_bagian }},&nbsp;
											 @endif
											 @if($res_delight->id_divisi !== 0 AND $res_delight->id_divisi !== NULL) 
											 Divisi : 	
											 
											{{ $res_delight->getDivisi->nm_devisi }}
											@endif	
										</td>	
										<td><a href="{{ url('ubah-delight/'.$res_delight->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a></td>	
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
