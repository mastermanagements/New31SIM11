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
               Return Penjualan Barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
          @if(!empty(session('message_success')))
              <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
          @elseif(!empty(session('message_fail')))
              <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
          @endif
            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                          <h6 class="box-title">Return Penjualan Barang dengan No Transaksi: <font color="#FF00GG">{{ $data->linkToSales->no_sales }}</font>, &nbsp;Klien: <font color="#FF00GG">@if(!empty($data->linkToSales->linkToKlien)){{ $data->linkToSales->linkToKlien->nm_klien }} @else Klien Umum @endif
                          </font></h6>
                          <h5 class="pull-right"><a href="{{ url('Penjualan') }}">Kembali ke Halaman utama</a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                            <form role="form" action="{{ url('return-barang-jual') }}" method="post" enctype="multipart/form-data">

                                            <div class="col-md-12">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_complain_barang" value="{{ $data->id }}">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Metod return</label>
                                                                <select class="form-control select2" style="width: 100%;" name="jenis_return">
                                                                    @if(!empty($jenis_return))
                                                                        @foreach($jenis_return as $keys=> $data_return)
                                                                            <option value="{{ $keys }}" @if(!empty($data->linkToReturnJual->jenis_return)) @if($data->linkToReturnJual->jenis_return == $keys) selected @endif @endif > {{ $data_return }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Tgl Return</label>
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Return" name="tgl_return" value="@if(!empty($data->linkToReturnJual->tgl_return)) {{ tanggalView($data->linkToReturnJual->tgl_return) }} @endif">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Ongkos Kirim</label>
                                                                <input type="text" id="rupiah" class="form-control pull-right" placeholder="Ongkos Kirim" name="ongkos_kirim" value="@if(!empty($data->linkToReturnJual->ongkir_return)) {{ rupiahView($data->linkToReturnJual->ongkir_return) }} @endif">
                                                                <!-- /.input group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-12">
                                                        <table id="example"  class="table table-bordered table-striped"  style="width: 100%;">
                                                          <tr>

                                                              <th>Klien</th>
                                                              <th>No. Faktur</th>
                                                              <th>Tgl Transaksi</th>
                                                              <th>Nama Barang</th>
                                                              <th>Harga Jual</th>
                                                              <th>Barang Kurang</th>
                                                              <th>Barang Rusak</th>
                                                              <th>Keterangan</th>
                                                              <th>Total Return</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>@if(!empty($data->linkToSales->linkToKlien)){{ $data->linkToSales->linkToKlien->nm_klien}}@else Klien Umum @endif</td>
                                                                <td>{{ $data->linkToSales->no_sales }}</td>
                                                                <td>{{ tanggalView($data->linkToSales->tgl_sales) }}</td>
                                                                <td>{{ $data->linkToBarang->nm_barang }}</td>
                                                                <td>{{ rupiahView($data->hpp) }}</td>
                                                                <td> {{ $data->complain_jumlah }}</td>
                                                                <td> {{ $data->complain_kualitas }}</td>
                                                                <td> {{ $data->ket }}</td>
                                                               <td>{{ rupiahView($data->total_return) }}</td>
                                                            </tr>
                                                          </tbody>
                                                      </table>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary pull-right">Simpan</button>
                                            </div>
                                            </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->


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
