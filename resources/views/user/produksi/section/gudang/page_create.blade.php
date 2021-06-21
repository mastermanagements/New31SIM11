@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah Gudang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir tambah gudang</h3>
                            <h5 class="pull-right"><a href="{{ url('gudang')}}"><font color="#1052EE">Kembali ke Halaman
                                        Utama</font></a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('gudang') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Gudang</label>
                                    <input type="text" name="gudang" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Gudang</label> <br>
                                    <input type="radio" name="jenis_gudang" value="0" required/> Gudang
                                    <input type="radio" name="jenis_gudang" value="1"/> Showroom
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop
@section('plugins')
    @include('user.produksi.section.barang.JS.JS')
    @include('user.global.rupiah_input2')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            $('.select2').select2()
        });


    </script>

@stop
