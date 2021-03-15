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
                Tambah Penjualan barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Tambah Penjualan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <form role="form" action="{{ url('penjualan-barang/'.$data->id) }}" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    {{ csrf_field() }}
                                    @method('put')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Faktur</label>
                                            <input type="text" class="form-control" name="no_sales" value="{{ $data->no_sales }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Penjualan</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker2" placeholder="Tanggal Pesanan" value="{{ $data->tgl_sales }}" name="tgl_sales" >
                                            </div>
                                            <!-- /.input group -->
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No. Pesanan Penjualan</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_so" >
                                                <option value="null">Pilihan pesanan penjualan</option>
                                                @if(!empty($pesanan_jual))
                                                    @foreach($pesanan_jual as $value)
                                                        <option value="{{ $value->id }}" @if($value->id == $data->id_so) selected @endif>{{ $value->no_so }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Klien</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                                @if(empty($klien))
                                                    <option>Klien masih kosong</option>
                                                @else
                                                    @foreach($klien as $value)
                                                        <option value="{{ $value->id }}" @if($value->id== $data->id_klien) selected @endif>{{ $value->nm_klien }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Barang Kirim</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker3" placeholder="Tanggal kirim sampai dengan" value="{{ $data->tgl_kirim }}" name="tgl_kirim" >
                                            </div>
                                            <!-- /.input group -->
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Salesman</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_komisi_sales" required>
                                                @if(empty($komisi_sales))
                                                    <option>Klien masih kosong</option>
                                                @else
                                                    @foreach($komisi_sales as $value)
                                                        <option value="{{ $value->id }}" @if($value->id == $data->id_komisi_sales) selected @endif>{{ $value->linkToKaryawan->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" name="ket">{{ $data->ket }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                        </div>

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

        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $('#datepicker3').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

    </script>

@stop