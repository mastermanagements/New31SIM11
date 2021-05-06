@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Complain Barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h6 class="box-title">Penerimaan Complain Barang No Transaksi: <font color="#FF00GG">{{ $data->no_sales }}</font>, &nbsp;Klien: <font color="#FF00GG">{{ $data->linkToKlien->nm_klien }}
                            </font></h6>
                             <h5 class="pull-right"><a href="{{ url('Penjualan')}}">Kembali ke Halaman utama</a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                          <div class="row">
                                            <div class="col-md-12" style="overflow-x: scroll;">

                                                     @if(!empty($data->linkToDetailSales))
                                                        <table class="table-wrapper">
                                                        <thead>
                                                            <tr>
                                                                <th>Barang</th>
                                                                <th>Harga Jual</th>
                                                                <th>Banyak</th>
                                                                <th>Diskon(%)</th>
                                                                <th>Jumlah</th>
                                                                <th>Complain</th>
                                                                <th>Keterangan</th>
                                                                <th>Status Complain</th>
                                                                <th>Keterangan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($total_item = 0)
                                                        @php($total_uang = 0)
                                                        @php($total_diskon = 0)
                                                        @foreach($data->linkToDetailSales as $data_detail)

                                                          @if($data_detail->linkToComplainBarangJual == NULL)

                                                            <form action="{{ url('complain-barang-jual') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <tr>
                                                                        <input type="hidden" name="id_detail_sales" value="{{ $data_detail->id }}">
                                                                        <input type="hidden" name="id_sales" value="{{ $data->id }}">
                                                                        <input type="hidden" name="id_barang" value="{{ $data_detail->id_barang }}">

                                                                    <td width="150"><input type="text" class="form-control" value="{{ $data_detail->linkToBarang->nm_barang}}, {{$data_detail->linkToBarang->linkToSatuan->satuan}}, {{$data_detail->spec}}" readonly></td>
                                                                    <td ><input type="text" name="hpp" class="form-control" value="{{ rupiahview($data_detail->hpp) }}" readonly></td>
                                                                    <td width="60"><input type="text" name="jumlah_beli" class="form-control" value="{{ rupiahview($data_detail->jumlah_jual) }}" readonly></td>
                                                                    <td width="70"><input type="number" name="diskon_item" class="form-control" value="{{ $data_detail->diskon }}"  readonly></td>
                                                                    <td ><input type="text" name="jumlah_harga" readonly class="form-control" value="{{ rupiahview($data_detail->jumlah_harga) }}" readonly></td>
                                                                    <td>
                                                                        @php($total_uang+=$data_detail->jumlah_harga)
                                                                        @php($total_diskon+=$data_detail->diskon)
                                                                        @php($total_item+=$data_detail->jumlah_jual)
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="complain_jumlah" value="@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->complain_jumlah }} @endif" placeholder="Barang kurang">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="complain_kualitas" value="@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->complain_kualitas }} @endif" placeholder="Barang Rusak">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <textarea class="form-control" name="ket">@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->ket }} @endif</textarea>
                                                                    </td>
                                                                    <td width="100">
                                                                        <select class="form-control" name="status_complain">
                                                                            <option value="0" @if(!empty($data_detail->linkToComplainBarangJual)) @if($data_detail->linkToComplainBarangJual->status_complain=='0') selected @endif @endif>Diterima</option>
                                                                            <option value="1" @if(!empty($data_detail->linkToComplainBarangJual)) @if($data_detail->linkToComplainBarangJual->status_complain=='1') selected @endif @endif>Ditolak</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <textarea class="form-control" name="alasan_ditolak">@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->alasan_ditolak }} @endif</textarea>
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                              @endif

                                                          @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <!--tampilkanhasil pengecekkan complain-->
                                        <div class="col-md-12">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Hasil Penerimaan Complain Barang</h3>
                                            </div>

                                            <div class="col-md-12" style="overflow-x: scroll;">
                                                    @if(!empty($complain_barang))
                                                      <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Barang</th>
                                                                <th>Harga Jual</th>
                                                                <th>Banyak</th>
                                                                <th>Diskon(%)</th>
                                                                <th>Barang Kurang</th>
                                                                <th>Barang Rusak</th>
                                                                <th>Total Complain</th>
                                                                <th>Keterangan</th>
                                                                <th>Status Complain</th>

                                                                <th>Alasan Ditolak</th>
                                                                <th>Penerima</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($complain_barang as $complain)
                                                        @foreach($data->linkToDetailSales as $data_detail)
                                                          @if($complain->id_detail_sales == $data_detail->id)

                                                                <tr>
                                                                    <td width="180">{{ $complain->linkToBarang->nm_barang}}, {{$complain->linkToBarang->linkToSatuan->satuan}}, {{$complain->spec}}</td>
                                                                    <td width="100">{{ rupiahview($complain->hpp) }}</td>
                                                                    <td width="70">{{ rupiahview($complain->jumlah_beli) }}</td>
                                                                    <td width="70">{{ $complain->diskon_item }}</td>

                                                                    <td width="130">{{ $complain->complain_jumlah }}</td>
                                                                    <td width="130">{{ $complain->complain_kualitas	 }}</td>
                                                                    <td width="150">{{ rupiahview($complain->total_return) }}</td>
                                                                    <td width="100">{{ $complain->ket	 }}</td>
                                                                    <td width="130">@if($complain->status_complain=='0') Diterima @elseif($complain->status_complain=='1') DiTolak @endif</td>
                                                                    <td width="150">{{ $complain->alasan_ditolak	 }}</td>
                                                                    <td width="100">{{ $complain->linkToKaryawan->nama_ky	 }}</td>
                                                                </tr>

                                                            @endif
                                                          @endforeach
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                          </div>
                                      </div>
                                    <!--./ row-->
                                </div>
                              <!--./col-12-->
                        </div>
                        <!--./ row-->
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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@stop
