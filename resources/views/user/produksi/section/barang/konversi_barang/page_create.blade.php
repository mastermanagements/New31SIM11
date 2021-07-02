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
            Form Tambah Konversi Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Tambah Konversi Barang</h3>
						<h5 class="pull-right"><a href="{{ url('Barang')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('atur-konversi') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama Barang dan Satuan Asal</label> <br>
                                <select name="id_barang_asal" class="form-control select2" style="width: 100%" required>
                                    <option>Pilih Barang Asal</option>
                                    @if(!empty($data))
                                        @foreach($data as $data_barang_asal)
                                            <option value="{{ $data_barang_asal->id }}">{{ $data_barang_asal->nm_barang }}, {{ $data_barang_asal->linkToSatuan->satuan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang dan Satuan Tujuan</label> <br>
                                <select name="id_barang_tujuan" class="form-control select2" style="width: 100%"  required>
                                    <option>Pilih Barang Tujuan</option>
                                    @if(!empty($data))
                                        @foreach($data as $data_barang_tujuan)
                                            <option value="{{ $data_barang_tujuan->id }}">{{ $data_barang_tujuan->nm_barang }}, {{ $data_barang_tujuan->linkToSatuan->satuan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Satuan Konversi (Misal 1 Lusin= 12 Pcs), Tulis : 12</label> <br>
                                <input type="number" class="form-control" name="jumlah_konversi_satuan" value="0" required>
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
