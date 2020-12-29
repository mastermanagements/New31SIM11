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
            Form Konversi Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Form Konversi Barang</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('atur-konversi/'.$data->id.'/konversi') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="id_konversi" value="{{ $data->id }}">
                                <label>Nama Barang Asal</label> <br>
                                <input name="tgl_konversi" type="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang Asal</label> <br>
                                <input type="text" class="form-control" value="{{ $data->linkToBarangAsal->nm_barang }} {{ $data->linkToBarangAsal->linkToSatuan->satuan_brg }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang Tujuan</label> <br>
                                <input type="text" class="form-control" value="{{ $data->linkToBarangTujuan->nm_barang }} {{ $data->linkToBarangTujuan->linkToSatuan->satuan_brg }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Satuan Konversi</label> <br>
                                <input type="number" class="form-control" name="jum_brg_dikonversi" value="0" required>
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
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
    </script>

@stop