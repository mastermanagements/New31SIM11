@extends('user.hrd.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Rekruitmen
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pencarian</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ url('tambah-rekrutment') }}" class="btn btn-box-tool" ><i class="fa fa-plus"></i>
                                </a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <form action="{{ url('cari-rekruitmen') }}" method="post">
                                <div class="input-group input-group-sm">
                                    {{ csrf_field() }}
                                    <input type="text" name="nm_loker" class="form-control" placeholder="cari berdasarkan nama rekruitmen" required>
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

                @if(empty($loker))
                    <div class="col-md-12">
                        <h5>Data Rekruitmen belum tersedia</h5>
                    </div>
                @else
                    @foreach($loker as $value)
                        <div class="col-md-3">
                            <div class="box box-primary">
                                <div class="box-header ">
                                    <h3 class="box-title">{{ str_limit($value->nm_loker,20,'...') }}</h3>
                                    <div class="box-tools pull-right">
                                        <a href="{{ url('ubah-rekruitmen/'. $value->id) }}" class="btn btn-box-tool"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ url('hapus-rekruitmen/'. $value->id) }}" class="btn btn-box-tool" onclick="return confirm('apakah anda akan menghapus data ini')"><i class="fa fa-trash"></i></a>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="">
                                    <div class="col-md-12 text-center">
                                    @if(empty($value->file_loker))
                                       <a href="#" onclick="setID({{ $value->id }})" data-toggle="modal" data-target="#modal-upload-rekruimen" ><img src="{{ asset('component/icon_file_not_found.png') }}" class="mx-auto d-block" style="width: 50%;height: 60%"></a>
                                    @else
                                       <a href="#" onclick="setID({{ $value->id }})" data-toggle="modal" data-target="#modal-upload-rekruimen" ><img src="{{ asset('fileLoker/'.$value->file_loker) }}" class="mx-auto d-block" style="width: 100%;height: 260px"></a>
                                    @endif
                                    </div>
                                    <div>
                                        <a href="{{ url('detail-rekruitmen/'. $value->id) }}"><h4 class="text-center" style="padding-top: 20px">{{ $value->nm_loker }}</h4></a>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @endforeach
                    {{ $loker->links() }}
                @endif
            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.hrd.section.loker.include.modal')
@stop

@section('plugins')
    <script>
        setID = function(id){
            $('[name="idLoker"]').val(id);
        }
    </script>
@stop