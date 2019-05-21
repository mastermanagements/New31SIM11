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
                Pembelian
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Pembelian</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-beli-barang/'.$data->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Faktur</label>
                                    <input type="text" name="no_faktur" class="form-control" placeholder="No. Faktur" value="{{ $data->no_faktur }}" />
                                    <small style="color: orange">* Isi jika perlu</small>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Beli </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Barang dibeli" value="{{ date('d-m-Y', strtotime($data->tgl_beli)) }}" name="tgl_beli" >
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Barang</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                        @if(empty($barangs))
                                            <option>Barang masih kosong</option>
                                        @else
                                            @foreach($barangs as $value)
                                                <option value="{{ $value->id }}" @if($data->id_barang==$value->id) selected @endif>{{ $value->nm_barang }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_suplier" required>
                                        @if(empty($supplier))
                                            <option>Suppler masih kosong</option>
                                        @else
                                            @foreach($supplier as $value)
                                                <option value="{{ $value->id }}" @if($data->id_suplier==$value->id) selected @endif>{{ $value->nama_suplier }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Barang</label>
                                    <input type="number" min="0" name="jumlah_barang" class="form-control" value="{{ $data->jumlah_barang }}" placeholder="Jumlah Barang" />
                                    <small style="color: red">* Tidak Boleh kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Beli</label>
                                    <input type="number" min="0" name="harga_beli" class="form-control" value="{{ $data->harga_beli }}" placeholder="Harga barang" />
                                    <small style="color: orange">* Tidak Boleh kosong</small>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
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

        $(function () {
            $('.select2').select2()
        });
    </script>

@stop