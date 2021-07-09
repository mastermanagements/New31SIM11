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
            Harga Jual Berdasarkan Jumlah
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir ubah Harga Jual Berdasarkan Jumlah</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('harga-jual-baseon-jumlah/'.$data->id) }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode/Nama Barang :{{ $data->linkToBarang->kd_barang }} {{ $data->linkToBarang->nm_barang }}</label>
                                {{--<small style="color: red">* Tidak Boleh Kosong</small>--}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">HPP :{{ $data->linkToBarang->hpp }}</label>
                                <input type="hidden" name="hpp" class="form-control" value="{{ $data->linkToBarang->hpp }}"/>
                                {{--<small style="color: red">* Tidak Boleh Kosong</small>--}}
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="_method" value="put">
                                <label for="exampleInputEmail1">Jumlah Masimal Pembelian</label>
                                {{ csrf_field() }}
                                <input type="hidden" name="id_HBJ" value="{{ $data->id }}" required>
                                <input type="number" minlength="0" maxlength="100" value="{{ $data->jumlah_maks_brg }}" name="jumlah_maks_brg" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Besarnya Keuntungan</label>
                                <input type="text" name="nilai_persen" value="{{ rupiahView($untung) }}" class="form-control" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga Jual</label>
                                {{ csrf_field() }}
                                <input type="text" id="rupiah" name="harga_jual" minlength="0" maxlength="100"  value="{{ rupiahView($data->harga_jual) }}" name="harga_jual" class="form-control" required/>
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
        $('[name="harga_jual"]').keyup(function () {
            var hpp = ($('[name="hpp"]');
            var harga_jual = hpp - persentase;

            $('[name="nilai_persen"]').val(harga_jual);
        })
    </script>
    @include('user.global.rupiah_input')
@stop
