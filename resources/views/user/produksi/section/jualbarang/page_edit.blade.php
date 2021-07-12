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
                Penjualan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Penjualan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-penjualan/'.$data_penjualan->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal Jual </label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Barang dibeli" name="tgl_jual" value="{{ date('d-m-Y', strtotime($data_penjualan->tgl_jual)) }}" >
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
                                                        <option value="{{ $value->id }}" @if($data_penjualan->id_klien == $value->id_klien) selected @endif>{{ $value->nm_klien }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>

                                    </div>
                                    <div class="forms">
                                        <div id="form-vertical">
                                           <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">Barang</label>
                                                     <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                                          @if(empty($barangs))
                                                             <option>Barang masih kosong</option>
                                                           @else
                                                                 @foreach($barangs as $value)
                                                                    <option value="{{ $value->id }}" @if($data_penjualan->id_barang == $value->id_klien) selected @endif>{{ $value->nm_barang }}</option>
                                                                 @endforeach
                                                             @endif
                                                         </select>
                                                  <small style="color: red">* Tidak Boleh Kosong</small>
                                                 </div>
                                                </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label for="exampleInputEmail1">Jumlah Barang</label>
                                                    <input type="number" min="0" name="jumlah_barang" class="form-control" placeholder="Jumlah Barang" value="{{ $data_penjualan->jumlah_barang }}" />
                                                   <small style="color: red">* Tidak Boleh kosong</small>
                                                      </div>
                                            </div>
                                        </div>
                                        <div id="form-dup">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
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