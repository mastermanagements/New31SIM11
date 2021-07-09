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
                      <div class="box-body">
                          <form role="form" action="{{ url('penawaran-penjualan/'.$data->id) }}" method="post" enctype="multipart/form-data">

                          <div class="row">
                              {{ csrf_field() }}
                              @method('put')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Promo</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_promo" required>
                                            <option value="0" disabled> Pilih promo</option>
                                            @if(empty($promo))
                                                <option value="0">Klien masih kosong</option>
                                            @else
                                                @foreach($promo as $value)
                                                    <option value="{{ $value->id }}" @if($data->id_promo == $value->id) selected @endif>{{ $value->nama_promo }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No Penawaran</label>
                                        <input type="text" class="form-control" name="no_penawaran" value="{{ $data->no_tawar }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Penawaran </label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal barang penawaran" value="{{ $data->tgl_tawar }}" name="tgl_penawaran" >
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
                                            <input type="text" class="form-control pull-right" id="datepicker2" placeholder="Tanggal sampai dengan.." name="tgl_sd" value="{{ $data->tgl_berlaku }}">
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Kirim</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker3" placeholder="Tanggal kirim sampai dengan" name="tgl_krm" value="{{ $data->tgl_krm }}">
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
                                                    <option value="{{ $value->id }}" @if($data->id_klien==$value->id) selected @endif>{{ $value->nm_klien }}</option>
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
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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