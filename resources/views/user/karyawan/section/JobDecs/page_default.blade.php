@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Job Description
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
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
                                    <button type="button" class="btn btn-box-tool" onclick="tambahJobdesc({{ $jabatan->id }})" title="tambah"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul>
								@if(!empty($jobdesc= $jabatan->getJobdesc))
									@foreach($jobdesc as $daftar_jobdesc)
									<a href="#" onclick="hapusJobdesc({{ $daftar_jobdesc->id }})" class="pull-right" title="hapusJobdesc" style="padding-left: 1%">
											<i class="fa fa-trash"></i></a> 
									<a href="#" onclick="ubahJobdesc({{ $daftar_jobdesc->id }})" class="pull-right" title="ubah">
											<i class="fa fa-pencil"></i></a> 
                                            <li>{!! $daftar_jobdesc->job_desc !!} </li>
											
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
	 @include('user.karyawan.section.JobDecs.include.modal')
@stop

@section('plugins')
  <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
	$(function () {
            $('.select2').select2();
        });
		$(document).ready(function () {
            var ids;
			
			tambahJobdesc  = function (id) {
                $('[name="id_jabatan_p"]').val(id);
				
                $('#modal-tambah-jobdesc').modal('show');
            };
			
			ubahJobdesc = function (id) {
                $.ajax({
                    url: '{{ url('ubah-jobdesc') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
                        $('[name="id_jobdesc"]').val(result.data_jobdesc.id);
						CKEDITOR.instances.jobdesc_ubah.setData(result.data_jobdesc.job_desc);
						
                        $('#modal-ubah-Jobdesc').modal('show');
                    }
                })
			};
			
			hapusJobdesc = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusJobdesc') }}/'+id,
                        type : 'post',
                        data :{
                            '_method': 'put',
                            '_token' : '{{ csrf_token() }}'
                        },
                        success:function (result) {
                            alert(result.message);
                            window.location.reload()
                        }
                    })
                }else {
                    alert("Data ini tidak jadi dihapus");
                }
			}
		})
		
		
  </script>
@stop