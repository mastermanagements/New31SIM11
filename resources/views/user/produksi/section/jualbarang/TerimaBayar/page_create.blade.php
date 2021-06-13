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
            Terima Pembayaran
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      @if(!empty($data->no_so))
                      <h6 class="box-title">Formulir pembayaran Pesanan Penjualan No Transaksi: <font color="#FF00GG">{{ $data->no_so }}</font>, &nbsp;Klien: <font color="#FF00GG">@if(!empty($data->linkToKlien)){{ $data->linkToKlien->nm_klien }} @else Klien Umum @endif
                      @php($jumlah_bayar = $data->dp_so )
                      @else
                      <h6 class="box-title">Formulir pembayaran Penjualan No Transaksi: <font color="#FF00GG">{{ $data->no_sales }}</font>, &nbsp;Klien: <font color="#FF00GG">@if(!empty($data->linkToKlien)) {{ $data->linkToKlien->nm_klien }} @else Klien Umum @endif
                      @php($jumlah_bayar = $data->kurang_bayar )
                      @endif

                      </font></h6>
                       <h5 class="pull-right"><a href="{{ url('Penjualan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <form role="form" action="{{ url('terima-bayar') }}" method="post" enctype="multipart/form-data">
                          <div class="row">
                              {{ csrf_field() }}
                                <div class="col-md-12">
                                      <input type="hidden" name="id" value="{{ $data->id }}">
                                      <input type="hidden" name="jenis_bayar" value="{{ $jenis_bayars }}">

                                    <div class="form-group">
                                        <label>Tanggal Penjualan</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="tgl_bayar" value="{{ tanggalView(date('Y-m-d')) }}" class="form-control pull-right" id="datepicker" placeholder="Tanggal Pembayaran" >
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
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
                                        <label for="exampleInputEmail1">Bank Asal</label>
                                        <select class="form-control select2" style="width: 100%;" name="bank_asal" required>
                                            @if(empty($rek_asal))
                                                <option>Data Rekening Klien masih kosong</option>
                                            @else
                                                @foreach($rek_asal as $value)
                                                    <option value="{{ $value->id }}">{{$value->nama_bank}}, No. Rek: {{$value->no_rek}}, A.N. {{ $value->atas_nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bank Tujuan</label>
                                        <select class="form-control select2" style="width: 100%;" name="bank_tujuan" required>
                                            @if(empty($rek_tujuan))
                                                <option>Data Rekening Perusahaan Anda masih kosong</option>
                                            @else
                                                @foreach($rek_tujuan as $value)
                                                    <option value="{{ $value->id }}">{{$value->nama_bank}}, No. Rek: {{$value->no_rek}}, A.N. {{ $value->atas_nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Bayar</label>
                                        <input type="text" id="rupiah" class="form-control" name="jumlah_bayar" value="{{ rupiahView($jumlah_bayar) }}" required>
                                          <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Bukti Bayar</label>
                                        <input type="file" id="exampleInputFile" name="bukti_bayar" required>
                                        <p class="help-block" style="color:red">*Format file yang disarankan .jpg, .png</p>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
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
@include('user.global.rupiah_input')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

                $('#datepicker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });
    </script>

@stop
