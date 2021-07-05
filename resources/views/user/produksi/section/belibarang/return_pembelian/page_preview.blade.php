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
            Return Pembelian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <h3 class="box-title">Return Pembelian Barang Nomor Order : <font color="#FF00GG">{{ $data->no_order }}</font>, Supplier : <font color="#DE8F06">{{ $data->linkToSuppliers->nama_suplier }}</font>  </h3>
                        <h5 class="pull-right"><a href="{{ url('Pembelian')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <form action="{{ url('simpan-return-barang') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                  <table>
                                      <tr>
                                          <th>Bentuk Return</th>
                                          <th>:</th>
                                          <th>
										
											@php($bentuk_return = $data->linkToReturnBeli->jenis_return )
												@if($bentuk_return == 0)
													Return Barang
												@elseif($bentuk_return == 1)
													Return Uang/Refund 
												@else 
													Potong Hutang
												@endif 
									

                                          </th>
                                      </tr>
                                      <tr>
                                          <th>Tanggal Return</th>
                                          <th>:</th>
                                          <th>
												@if(!empty($data->linkToReturnBeli->tgl_return)){{ tanggalView($data->linkToReturnBeli->tgl_return)}} @endif
										  </th>
                                      </tr>
                                      <tr>
                                          <th>Ongkos Kirim</th>
                                          <th>:</th>
                                          <th>@if(!empty($data->linkToReturnBeli->ongkir_return)){{ rupiahView($data->linkToReturnBeli->ongkir_return) }} @endif</th>
                                      </tr>
                                      <tr>
                                          <th>Petugas</th>
                                          <th>:</th>
                                          <th>@if(!empty($data->linkToReturnBeli->linkToKaryawan->nama_ky)){{ $data->linkToReturnBeli->linkToKaryawan->nama_ky }} @endif</th>
                                      </tr>

                                  </table>

                                </div>
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped"  style="width: 100%; margin-bottom: 10px; overflow-y:scroll; ">
                                        <thead>
                                            <tr>
                                              <th rowspan="2">No</th>
                                              <th rowspan="2">Nama Barang</th>
                                              <th rowspan="2"> Tgl Transaksi </th>
                                              <th rowspan="2"> Jumlah Beli</th>
                                              <th rowspan="2"> Harga Satuan </th>
                                              <th rowspan="2"> Diskon (%)</th>
                                              <th colspan="2"> Barang Kurang</th>
                                              <th colspan="2"> Barang Rusak</th>
                                              <th rowspan="2"> Total Harga return </th>
                                              <th rowspan="2">Alasan Return</th>
                                              <th rowspan="2">Respon Supplier</th>

                                            </tr>
                                            <tr>
                                              <th>Jumlah</th>
                                              <th>Harga</th>
                                              <th>Jumlah</th>
                                              <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @if (!empty($data))
                                          @php($no=1)
                                          @php($jum_brg_no_sesuai=0)
                                          @php($kualitas_brg_no_sesuai=0)
                                          @php($nilai_diskon=0)
                                          @php($nilai_diskon_b=0)
                                          @php($total_beli=0)
                                          @php($harga_jum_no_sesuai=0)
                                          @php($harga_kualitas_no_sesuai=0)
                                          @php($total_harga_return=0)
                                              @foreach ($data->linkToCekBarangDetail->where('status_return', 0) as $item)
                                                  <tr>
                                                      <td>{{ $no++ }}</td>
                                                      <td>{{ $item->linkToBarang->nm_barang }}</td>
                                                      <td>{{ tanggalView($item->linkToOrder->tgl_order) }}</td>
                                                      <td>{{ rupiahView($item->jumlah_beli) }}</td>
                                                      <td>{{ rupiahView($item->harga_beli) }}</td>
                                                      <td>{{ $item->diskon_item }}</td>
                                                          @php($jum_brg_no_sesuai += $item->jum_no_sesuai)
                                                          @php($kualitas_brg_no_sesuai += $item->jum_kualitas_no_sesuai)
                                                          <!-- harga brg jumlah kurng-->
                                                          @php($total_beli_a = $item->jum_no_sesuai * $item->harga_beli)
                                                          @php($nilai_diskon =$total_beli_a * $item->diskon_item/100)
                                                          @php($harga_jum_no_sesuai += $total_beli_a - $nilai_diskon)
                                                          <!-- harga brg kualitas kurng-->
                                                          @php($total_beli_b = $item->jum_kualitas_no_sesuai * $item->harga_beli)
                                                          @php($nilai_diskon_b =$total_beli_b * $item->diskon_item/100)
                                                          @php($harga_kualitas_no_sesuai += $total_beli_b - $nilai_diskon_b)

                                                          <td align="center">{{ $jum_brg_no_sesuai  }}</td>
                                                          <td align="right">{{ rupiahView($harga_jum_no_sesuai) }}</td>
                                                          <td align="center">{{ $kualitas_brg_no_sesuai  }}</td>
                                                          <td align="right">{{ rupiahView($harga_kualitas_no_sesuai) }}</td>
                                                          <td align="right">{{ rupiahView( $harga_jum_no_sesuai + $harga_kualitas_no_sesuai)  }}</td>
                                                          <td>{{ $item->ket }}</td>
                                                          <td>{{ $item->alasan_ditolak }}</td>


                                                  </tr>
                                              @endforeach
                                          @endif
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </form>
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

        $(function () {
            $('.select2').select2()
        });
    </script>

@stop
