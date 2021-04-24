@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rincian Penjualan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <div class="row">
                              <div class="col-md-12">
                                <form role="form" action="{{ url('terima-bayar') }}" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}

                                        <div class="form-group">
                                            <label>No Transaksi</label>
                                            <input type="text" class="form-control" name="no_transaksi" value="@if(!empty($data->no_so)){{ $data->no_so }}@else {{ $data->no_sales }} @endif" readonly>
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
                                            <label>Total Bayar</label>
                                            <input readonly type="text" name="tgl_bayar" class="form-control" value="{{ $data->linkToMannyTerimaBayar->sum('jumlah_bayar') }}">
                                        </div>
                                </form>
                              </div>
                              <div class="col-md-12">
                                  <hr>
                                  <h4>Daftar rincian pembayaran</h4>
                                  <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Jenis Pembayaran</th>
                                                <th>Bank & Rek Asal</th>
                                                <th>Bank & Rek Tujuan</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                      <tbody>
                                        {{--Terima Byar PSO--}}
                                        @if(!empty($data->linkToMannyTerimaBayar))
                                            @php($no=1)
                                            @foreach($data->linkToMannyTerimaBayar as $item_pso)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item_pso->tgl_bayar)) }}</td>
                                                    <td>
                                                        @if($item_pso->metode_bayar=='0')
                                                            Transfer Bank
                                                        @elseif($item_pso->metode_bayar=='1')
                                                            Cek
                                                        @elseif($item_pso->metode_bayar=='2')
                                                            Langsung/Tunai
                                                        @elseif($item_pso->metode_bayar=='3')
                                                            Return Barang Jual
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $item_pso->bank_asal }} {{ $item_pso->rek_asal }}
                                                    </td>
                                                    <td>
                                                        {{ $item_pso->bank_tujuan }} {{ $item_pso->no_rek_tujuan }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($item_pso->jumlah_bayar,2,',','.') }}
                                                    </td>
                                                    <td>
                                                        <form action="{{ url('terima-bayar/'.$item_pso->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            @method('delete')
                                                            <a href="{{ url('terima-bayar/'.$item_pso->jenis_bayar.'/'.$item_pso->id.'/edit') }}" class="btn btn-warning">ubah</a>
                                                            <button class="btn btn-danger" onclick="return confirm('Apakah anda akan menhapus data')">hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                      </tbody>
                                  </table>
                              </div>
                          </div>
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