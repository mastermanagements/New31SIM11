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
            Terima Pembayaran Penjualan Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Diskon</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <form role="form" action="{{ url('terima-bayar') }}" method="post" enctype="multipart/form-data">
                          <div class="row">
                              {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis Pembayaran</label>
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="hidden" name="jenis_bayar" value="{{ $jenis_bayars }}">
                                        <select class="select2 form-control" name="jenis_bayar" style="width: 100%" disabled readonly>
                                            <option disabled>Pilih Grup klien</option>
                                            @if(!empty($jenis_bayar))
                                                @foreach($jenis_bayar as $key=>$item_jenis_bayar)
                                                    <option value="{{ $key }}" @if($key==$jenis_bayars) selected @endif>{{ $item_jenis_bayar }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No Transaksi</label>
                                        <input type="text" class="form-control" name="no_transaksi" value="{{ $data->no_so }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Klien</label>
                                        <input type="text" class="form-control" name="klien" value="{{ $data->linkToKlien->nm_klien }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tgl Transaksi</label>
                                        <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($data->tgl_so)) }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tgl Bayar</label>
                                        <input type="text" name="tgl_bayar" class="form-control" id="datepicker">
                                    </div>
                                    <div class="form-group">
                                        <label>Metode Bayar</label>
                                        <select class="form-control select2" name="metode_bayar" style="width: 100%">
                                            @foreach($metode_bayar as $keys=> $data)
                                                <option value="{{ $keys }}">{{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank (asal)</label>
                                        <input type="text" class="form-control" name="bank_asal">
                                    </div>
                                    <div class="form-group">
                                        <label>No Rek (asal)</label>
                                        <input type="text" class="form-control" name="rek_asal">
                                    </div>
                                    <div class="form-group">
                                        <label>atas nama (asal)</label>
                                        <input type="text" class="form-control" name="nama_asal">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Bank (tujuan)</label>
                                        <input type="text" class="form-control" name="bank_tujuan">
                                    </div>
                                    <div class="form-group">
                                        <label>No Rek (tujuan)</label>
                                        <input type="text" class="form-control" name="no_rek_tujuan">
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah (tujuan)</label>
                                        <input type="text" class="form-control" name="jumlah_bayar">
                                    </div>
                                    <div class="form-group">
                                        <label>Bukti Terima</label>
                                        <input type="radio" name="terima_bukti" value="0"> Uang Belum Masuk
                                        <input type="radio" name="terima_bukti" value="1"> Uang Sudah Masuk
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