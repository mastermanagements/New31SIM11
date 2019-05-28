@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Strategi Jangka Panjang Perusahaan
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

            @foreach($target_jpg as $tjpg)
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"> {{ $tjpg->nm_target_jpg }}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" onclick="tambahsjp({{ $tjpg->id }})" title="tambah"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-close" title="hidden isi"></i></button>                                       
								</div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul>
                                    @if(!empty($sjp= $tjpg->getSJP))
                                        @foreach($sjp as $daftar_sjp)
										
											<a href="#" onclick="hapus({{ $daftar_sjp->id }})" class="pull-right" title="hapus" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
											<a href="#" onclick="ubah({{ $daftar_sjp->id }})" class="pull-right" title="ubah"><i class="fa fa-pencil"></i>  </a> </li>
											<h4 class="box-title"> {!! $daftar_sjp->nm_sjpg !!}</h4>
											{!! $daftar_sjp->isi_sjpg !!} 
											
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
    @include('user.karyawan.section.SJP.include.modal')
@stop

@section('plugins')

    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });

        $(document).ready(function () {
            var ids;
            tambahsjp  = function (id) {
                $('[name="id_tjpg"]').val(id);
                $('#modal-tambah-sjp').modal('show');
            };
            
            ubah = function (id) {
                $.ajax({
                    url: '{{ url('ubah-sjp') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    CKEDITOR.instances.isi_sjpg_ubah.setData(result.data_sjps.isi_sjpg);
                        $('[name="id_tjpg_ubah"]').val(result.data_sjps.id_tjpg).trigger('selected');
						$('[name="nm_sjpg_ubah"]').val(result.data_sjps.nm_sjpg);
                        $('[name="id_sjps"]').val(result.data_sjps.id);
                        $('#modal-ubah-sjp').modal('show');
                    }
                })
            };

            hapus = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusSJP') }}/'+id,
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