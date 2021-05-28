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
            Pesanan Penjualan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Pesanan Penjualan</h3>
                        <h5 class="pull-right"><a href="{{ url('Penjualan')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <form role="form" action="{{ url('pesanan-penjualan') }}" method="post" enctype="multipart/form-data">

                          <div class="row">
                              {{ csrf_field() }}
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>No Pesanan</label>&nbsp;<strong style="color: red">*</strong>
                                          <input type="text" class="form-control" name="no_so" value="{{$no_surat}}" required>
                                      </div>
                                      <div class="form-group">
                                          <label>Tanggal Pesanan</label>&nbsp;<strong style="color: red">*</strong>
                                          <div class="input-group date">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" id="datepicker2" placeholder="Tanggal Pesanan" name="tgl_so" required >
                                          </div>
                                          <!-- /.input group -->

                                      </div>
                                    <!--<div class="form-group">
                                        <label for="exampleInputEmail1">No. PO</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_po" >
                                            <option value="null">Pilihan Penawaran Penjualan</option>
                                            @if(!empty($tawar_jual))
                                                @foreach($tawar_jual as $value)
                                                    <option value="{{ $value->id }}">{{ $value->no_tawar }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>-->
                                        <div class="form-group">
                                            <label>No Pesanan Pembelian</label>&nbsp;<strong style="color: red">*</strong>
                                            <input type="text" class="form-control" name="no_po" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Klien</label>&nbsp;<strong style="color: red">*</strong>
                                            <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                                @if(empty($klien))
                                                    <option>Klien masih kosong</option>
                                                @else
                                                    @foreach($klien as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nm_klien }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                         <div class="form-group">
                                            <label>Tanggal Barang Kirim</label>&nbsp;<strong style="color: red">*</strong>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker3" placeholder="Tanggal kirim sampai dengan" name="tgl_krm" required>
                                            </div>
                                            <!-- /.input group -->

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="box-footer">
                                        <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                     </div>
                                  </div>
                                  <!-- /.box-body -->
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
