@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penawaran Penjualan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Penawaran Penjualan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-penjualan') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>No Penawaran</label>
                                        <input type="text" class="form-control" name="no_penawaran">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Penawaran </label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal barang penawaran" name="tgl_penawaran" >
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Berlaku sampai dengan</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal sampai dengan.." name="tgl_sd" >
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Klien</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                            @if(empty($klien))
                                                <option>Klien masih kosong</option>
                                            @else
                                                @foreach($klien as $value)
                                                    <option value="{{ $value->id }}">{{ $value->nm_klien }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="forms">
                                    <div id="form-vertical">
                                      {{--@include('user.produksi.section.jualbarang.form_vertical')--}}
                                    </div>
                                    <div id="form-dup">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>


                $('#datepicker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

    </script>

@stop