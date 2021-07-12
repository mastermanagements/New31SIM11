@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Harga Jual Satuan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Harga Jual Satuan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('harga-jual-satuan') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode/Nama Barang :{{ $data->linkToBarang->kd_barang }} {{ $data->linkToBarang->nm_barang }}</label>
                                {{--<small style="color: red">* Tidak Boleh Kosong</small>--}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">HPP :{{ $data->linkToBarang->hpp }}</label>
                                {{--<small style="color: red">* Tidak Boleh Kosong</small>--}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Persentase Keuntungan</label>
                                {{ csrf_field() }}
                                <input type="number" minlength="0" maxlength="100" name="persentase" class="form-control" required/>
                                <input type="hidden" name="hpp" class="form-control" value="{{ $data->linkToBarang->hpp }}"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga Jual Barang</label>
                                {{ csrf_field() }}
                                <input type="hidden" name="id_barang" value="{{ $data->linkToBarang->id }}">
                                <input type="text" name="harga_jual" value="{{ $data->harga_jual }}" class="form-control" required readonly/>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
    </script>

@stop