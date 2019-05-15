@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Rekrutmen
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: xx-large">
                                    {{ $model->nm_loker }}
                                </p>
                                <i class="fa fa-clock-o"></i><span style="color: red">  Tanggal Buka:  {{ date('d-m-Y', strtotime($model->tgl_buka)) }} sampai Tanggal  {{ date('d-m-Y', strtotime($model->tgl_selesai)) }}  </span>
                            </div>
                            <div class="col-md-6">
                                @if(empty($model->file_loker))
                                    <a href="#" onclick="setID({{ $model->id }})" data-toggle="modal" data-target="#modal-upload-rekruimen" ><img src="{{ asset('component/icon_file_not_found.png') }}" class="mx-auto d-block" style="width: 50%;height: 60%"></a>
                                @else
                                    <a href="#" onclick="setID({{ $model->id }})" data-toggle="modal" data-target="#modal-upload-rekruimen" ><img src="{{ asset('fileLoker/'.$model->file_loker) }}" class="mx-auto d-block" style="width: 100%;height: 560px"></a>
                                @endif
                            </div>
                            <div class="col-md-6" style="width: 49%;height: 80%; overflow-y: scroll;">
                                <p>Deskripsi <br><hr> {!! $model->detail !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop