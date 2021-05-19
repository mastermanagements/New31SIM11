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
            Pengaturan Akun Manufaktur
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Manufaktur</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ url('akun-manufaktur/'.$data->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                                @method('put')
                                <label for="exampleInputEmail1">Jenis Jurnal</label>
                                <select class="form-control select2" name="jenis_jurnal">
                                    <option disabled>Pilihlah jenis jurnal</option>
                                    @foreach($jenis_jurnal as $key=> $jenis_jur)
                                        <option value="{{ $key }}" @if($key==$data->jenis_jurnal) selected @endif>{{ $jenis_jur }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Catatan transaksi</label>
                                <select class="form-control select2" name="id_ket_transaksi">
                                    <option disabled>Pilihlah catatan transaksi</option>
                                    @foreach($keterangan_transaksi as $key=> $n_transaksi)
                                        <option value="{{ $n_transaksi->id }}" @if($n_transaksi->id==$data->id_ket_transaksi) selected @endif>{{ $n_transaksi->nm_transaksi }}</option>
                                    @endforeach
                                </select>
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


                $('#datepicker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

        $(function () {
            $('.select2').select2()
        });
    </script>

@stop