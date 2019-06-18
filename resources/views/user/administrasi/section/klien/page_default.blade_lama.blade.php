@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Klien
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
                            <a href="{{ url('tambah-klien') }}" class="btn btn-box-tool" ><i class="fa fa-user-plus"></i>
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
                                <input type="text" name="nm_klien" class="form-control" placeholder="cari berdasarkan nama klien" required>
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

            @if(empty($data_klien))
                <h5>Data klien belum tersedia</h5>
            @else
                @foreach($data_klien as $value)
					
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
						
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="{{ asset('image_superadmin_ukm/default.png') }}" alt="User Avatar">
                                </div>
                                <h3 class="widget-user-username">{{ $value->nm_klien }}</h3>
                                <h5 class="widget-user-desc">No. Handphone {{ $value->hp }}</h5>
                           </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Perusahaan <span class="pull-right">{{ $value->nm_perusahaan }}</span></a></li>
                                    <li><a href="#">Alamat Perusahaan <span class="pull-right ">{{ $value->alamat_perusahaan }}</span></a></li>
                                    <li><a href="#">Telepon Perusahaan<span class="pull-right ">{{ $value->telp_perusahaan }}</span></a></li>
                                    <li>
                                     <form style="padding: 10px 15px ">
                                       Aksi
                                         <a href="{{ url('hapus-klien/'. $value->id) }}" onclick="return confirm('Apakah anda akan menghapus klien ini...?')"><span class="pull-right badge bg-orange"><i class="fa fa-trash"></i></span></a>
                                         <a href="{{ url('ubah-klien/'. $value->id) }}"><span class="pull-right badge bg-red"><i class="fa fa-pencil"></i></span></a>
                                     </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                @endforeach
                {{ $data_klien->links() }}
            @endif
        </div>
    </section>
    <!-- /.content -->
</div>
@stop