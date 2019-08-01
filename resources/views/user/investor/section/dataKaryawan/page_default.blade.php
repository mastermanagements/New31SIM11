@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Investor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pencarian</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ url('tambah-investor') }}" class="btn btn-box-tool" ><i class="fa fa-user-plus"></i>
                            </a>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <form action="{{ url('cari-klien') }}" method="post">
                        <div class="input-group input-group-sm">
                             {{ csrf_field() }}
                                <input type="text" name="nm_klien" class="form-control" placeholder="cari berdasarkan nama investor" required>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                </span>
                        </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @if(empty($DI))
                <h5>Data Investor belum tersedia</h5>
            @else
                @foreach($DI as $index=>$value)
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header @if($index % 2) bg-green-gradient @else bg-orange-active @endif">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="{{ asset('image_superadmin_ukm/default.png') }}" alt="User Avatar">
                                </div>
                                <h3 class="widget-user-username">{{ $value->nm_investor}}</h3>
                                <h5 class="widget-user-desc">No. Nik {{ $value->nik }}</h5>
                           </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li>
                                     <form action="{{ url('hapus-investor/'. $value->id) }}" method="post" style="padding: 10px 15px ">
                                       Aksi
                                         {{ csrf_field() }}
                                         <input type="hidden" name="_method" value="put" >
                                         <button style="margin-left: 5px" class="btn badge bg-orange pull-right" onclick="return confirm('Apakah anda akan menghapus klien ini...?')"><i class="fa fa-trash"></i></button>
                                         <a style="margin-left: 5px" class="btn pull-right badge bg-red" href="{{ url('ubah-investor/'. $value->id) }}"><span class=""><i class="fa fa-pencil"></i></span></a>
                                         <button style="margin-left: 5px" type="button" class="btn pull-right badge bg-blue" onclick="uploadKtp('{{ $value->id }}')"><span class=""><i class="fa fa-upload"></i></span></button>
                                         <button type="button" class="btn pull-right badge bg-green" onclick="uploadPhoto('{{ $value->id }}')"><span class=""><i class="fa fa-upload"></i></span></button>
                                     </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                @endforeach
                {{ $DI->links() }}
            @endif
        </div>
    </section>
    <!-- /.content -->
</div>
    @include('user.investor.section.dataKaryawan.modal.modal')
@stop

@section('plugins')
    <script>
        uploadKtp = function(id){
           $('[name="id_inves"]').val(id)
           $('#modal-upload-ktp-inves').modal('show');
        }
        uploadPhoto = function(id){
            $('[name="id_invess"]').val(id)
            $('#modal-upload-photo-inves').modal('show');
        }
    </script>
@stop