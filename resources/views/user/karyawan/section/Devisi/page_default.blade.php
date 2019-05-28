@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Divisi Perusahaan
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

            @foreach($Bagian as $bagians)
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Bagian {{ $bagians->nm_bagian }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" onclick="tambahDevisi({{ $bagians->id }})" title="tambah"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
								
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul>
                                    @if(!empty($divisi= $bagians->getDevisi))
                                        @foreach($divisi as $daftar_divisi)
                                            <li>{{ $daftar_divisi->nm_devisi }} 
											<a href="#" onclick="hapus({{ $daftar_divisi->id }})" class="pull-right" title="hapus" style="padding-left: 1%"><i class="fa fa-trash"></i></a> 
											<a href="#" onclick="ubah({{ $daftar_divisi->id }})" class="pull-right" title="ubah"><i class="fa fa-pencil"></i>  </a> </li>
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
    @include('user.karyawan.section.Devisi.include.modal')
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
            tambahDevisi  = function (id) {
                $('[name="id_bagian"]').val(id);
                $('#modal-tambah-devisi').modal('show');
            };
            
            ubah = function (id) {
                $.ajax({
                    url: '{{ url('Divisi') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
						
                        $('[name="nm_divisi_ubah"]').val(result.data_devisi.nm_devisi);
                        $('[name="id_bagian_ubah"]').val(result.data_devisi.id_bagian_p).trigger('selected');
                        $('[name="id_devisi"]').val(result.data_devisi.id);
                        $('#modal-ubah-divisi').modal('show');
                    }
                })
            };

            hapus = function (id) {
                if(confirm("Apakah anda akan menghapus divisi ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusDivisi') }}/'+id,
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
                    alert("Divisi tidak jadi dihapus");
                }
            }
        })
    </script>
@stop