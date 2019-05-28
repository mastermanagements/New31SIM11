@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Job Desc
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-job-decs') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> Tambah Job decs</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @foreach($data_jabatan as $jabatan)
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"> {{ $jabatan->nm_jabatan }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" onclick="tambahDevisi({{ $jabatan->id }})" title="tambah"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul>
                                    @if(!empty($jobdesc= $jabatan->getJobdesc))
                                        @foreach($jobdesc as $daftar_jobdesc)
                                            <li>{{ $daftar_jobdesc->job_desc }} 
											<a href="#" onclick="hapus({{ $daftar_jobdesc->id }})" class="pull-right" title="hapus" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
											<a href="#" onclick="ubah({{ $daftar_jobdesc->id }})" class="pull-right" title="ubah"><i class="fa fa-pencil"></i>  </a> </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
            @endforeach
        </div>
    </section>
    <!-- /.content -->
</div>
@stop