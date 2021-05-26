@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Standard Operating Procedure (SOP) Produksi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir SOP Produksi</h3>
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('sop-produksi') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <label>Nama SOP</label>
                                <input type="text" name="nama_sop" class="form-control" placeholder="misal: SOP pembuatan kue, SOP pembuatan Paving, dll" required/>
                            </div>
                        </div>

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@stop
