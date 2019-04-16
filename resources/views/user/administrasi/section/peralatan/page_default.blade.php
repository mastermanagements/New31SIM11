@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Peralatan
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Peralatan </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('tambah-peralatan') }}" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah Peralatan </a>
                                </div>
                                <div class="col-md-9" >
                                    <form action="{{ url('cari-arsip') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="text" name="ket" class="form-control" placeholder="cari berdasarkan ketarangan nama alat" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_alat))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan Peralatan</h4></div>
                                @else
                                    @foreach($data_alat as $value)
                                        <div class="col-md-12">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">{{ (ucwords ($value->nm_alat)) }}</h3>

                                                <div class="box-tools pull-right">
                                                    <form action="{{ url('delete-peralatan/'.$value->id) }}" method="post">
                                                        <a href="{{ url('ubah-peralatan/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah peralatan"><i class="fa fa-pencil"></i>
                                                        </a>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini ... ?')" class="btn btn-box-tool" title="hapus peralatan"><i class="fa fa-eraser"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-3">
													
                                                        @if(empty($value->file_bukti))
                                                         <img src="{{ asset('fileBukti/default.png') }}" style="width: 150px; height: 175px;"> </a> 
                                                        @else
                                                             <a href="{{ asset('fileBukti/'.$value->file_bukti) }}" ><img src="{{ asset('fileBukti/'.$value->file_bukti) }}" style="width: 150px; height: 175px;"></a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                           <div class="col-md-8">
																<h5 style="font-weight: bold"> Jumlah Alat : {{ $value->jumlah_alat }}</h5>
																<p>Merk : {{ $value->merk }}, &nbsp; Tipe : {{ $value->tipe }} </p>
																<p>Tahun Pembuatan : {{ $value->thn_buat}}, &nbsp; Tanggal Pembelian : {{ date('d M Y', strtotime($value->tgl_beli)) }}</p>
																<p>Kondisi Alat : {{ $value->kondisi_alat }}</p>
																<p>Bukti Kepemilikan : {{ $value->bukti_kepemilikan }}</p>
                
															</div>
                                                            <div class="col-md-12">
                                                                <form action="{{ url('delete-peralatan/'. $value->id) }}" method="post">
                                                                    <a href="{{ url('ubah-peralatan/'. $value->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> ubah</a>
                                                                    <input type="hidden" name="_method" value="put">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini ... ?')"><i class="fa fa-eraser"></i> hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        

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
