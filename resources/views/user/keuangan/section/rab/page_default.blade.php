@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            RAB
        </h1>
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Rencana Penjualan Barang(RPB)</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Rencana Penjualan Jasa (RPJ)</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Rencana Pengeluaran</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="{{ url('tambah-klien') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah RPB </a>
                            <p></p>
                            
                        </div>
						
						<div class="tab-pane" id="tab_2">
							<a href="{{ url('tambah-klien') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah RPJ </a>
                            <p></p>
						</div>
						
                        
                        
                    </div>
                    <!-- /.tab-content -->
					
					
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@stop

