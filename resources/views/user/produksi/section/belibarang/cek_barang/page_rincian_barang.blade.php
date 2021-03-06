@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
          href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1>
                Pengecekkan Barang Pembelian
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cek Barang Pembelian Nomor Order : <font
                                        color="#FF00GG">{{ $data_order->no_order }}</font>, Supplier : <font
                                        color="#DE8F06">{{ $data_order->linkToSuppliers->nama_suplier }}</font></h3>
                            <h5 class="pull-right"><a href="{{ url('Pembelian')}}"><font color="#1052EE">Kembali ke
                                        Halaman Utama</font></a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
							@if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif

                            @if($data_order->status_cekbarang == '0')

                                <form role="form" action="{{ url('cek-barang') }}" method="post">

                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        @php($no=1)
                                        @php($sub_total=0)
                                        <h4>Rincian Barang yang akan dicek</h4>
                                        {{ csrf_field() }}
                                        <table style="width: 100%; margin-bottom: 10px; ">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Barang</th>
                                                <th style="width:130px;">Harga Beli</th>
                                                <th style="width:70px;">Diskon</th>
                                                <th style="width:60px;">Banyak</th>
                                                <th style="width:130px;">Jumlah</th>
                                                <th>Qty sesuai</th>
                                                <th>Qty tidak sesuai</th>
                                                <th>Quality sesuai</th>
                                                <th>Quality tidak sesuai</th>
                                                <th>Keterangan</th>

                                            </tr>

                                            @if(!empty($data_order))
                                                @foreach ($data_order->linkToDetailOrder as $data_tb)

                                                    <tr>
                                                        <td>{{ $no++ }}</td>
														<!--<td>
                                                            {{ csrf_field() }}
                                                            <select name="id_barang[]" class="form-control" >
                                                                <option disabled>Pilih barang</option>
                                                                @foreach ($barang as $item)
                                                                    <option value="{{ $item->id }}" 
                                                                            @if ($item->id == $data_tb->id_barang)
                                                                            selected
                                                                            @endif
                                                                    >{{ $item->nm_barang }}
                                                                        , @if(!empty($item->linkToSatuan->satuan)){{ $item->linkToSatuan->satuan }} @endif </option>
                                                                @endforeach
                                                            </select>
                                                        </td>-->
														<td width="130">
															<input type="text" class="form-control" 
                                                                   value="{{ $data_tb->linkToBarang->nm_barang }},@if(!empty($item->linkToSatuan->satuan)){{ $item->linkToSatuan->satuan }} @endif"
                                                                   readonly>
															<input type="hidden" name="id_barang[]" value="{{ $data_tb->id_barang}}"                                                                                                                           >
														</td>
                                                        <td width="30">
                                                            <input type="text" class="form-control" name="harga_beli[]"
                                                                   value="{{ rupiahView($data_tb->harga_beli) }}"
                                                                   readonly required>
                                                            <input type="hidden" class="form-control" name="tgl_tiba"
                                                                   value="{{ $data_order->tgl_tiba }}" readonly
                                                                   required>
                                                            <input type="hidden" class="form-control" name="id_order"
                                                                   value="{{ $data_order->id }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                   name="diskon_item[]"
                                                                   value="{{ $data_tb->diskon_item }}" readonly
                                                                   required>
                                                        </td>
                                                        <td width="80">
                                                            <input type="number" class="form-control"
                                                                   name="jumlah_beli[]"
                                                                   value="{{ $data_tb->jumlah_beli }}" readonly
                                                                   required>

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control"
                                                                   name="jumlah_harga[]"
                                                                   value="{{ rupiahView($data_tb->jumlah_harga) }}"
                                                                   readonly required>
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control"
                                                                   name="jum_sesuai[]" value="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                   name="jum_no_sesuai[]" value="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                   name="jum_kualitas_sesuai[]" value="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                   name="jum_kualitas_no_sesuai[]" value="0"  required>
                                                        </td>

                                                        <td>
                                                            <textarea class="form-control" name='ket[]'></textarea>
                                                            <p></p>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                        <div class="form-group">
                                            <label><input type="checkbox" name="transfer_gudang" id="transfers"
                                                          value="transfer">Transer ke gudang </label>
                                        </div>
                                        <div id="tranfers-form">
                                            <div class="form-group">
                                                <label>Tanggal Transaksi</label>
                                                <input type="date" class="form-control" name="tgl_transaksi"
                                                       value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pengirim</label>
                                                <input type="text" class="form-control" name="nama_pengirim">
                                            </div>
                                            <div class="form-group">
                                                <label>Gudang</label>
                                                <select class="form-control" name="id_gudang">
                                                    <option value="">Pilih gudang</option>
                                                    @if(!empty($gudang))
                                                        @foreach($gudang as $data_gudang)
                                                            <option value="{{ $data_gudang->id }}">{{ $data_gudang->gudang }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"> Simpan</button>
                                        </div>
                                        @else
                                            <div class="box-header with-border">
                                                <h5 class="box-title">
                                                    Pengecekkan barang sudah selesai dilakukan pada
                                                    tanggal @if(!empty($data_order->linkToCekBarang->tgl_konfirm_cek)){{ tanggalView($data_order->linkToCekBarang->tgl_konfirm_cek) }} @endif
                                                    , oleh
                                                    : @if(!empty($data_order->linkToCekBarang->linkToKaryawan->nama_ky)){{ $data_order->linkToCekBarang->linkToKaryawan->nama_ky }} @endif</h5>
                                            </div>
                                        @endif
                                    </div>

                                </form>
                        </div>
                        <!-- /.box-body -->

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

        <!-- /.modal -->
    </div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    @include('user.produksi.section.belibarang.cek_barang.js')
    <script>
        $(function () {
            $('#tranfers-form').hide();
        });
    </script>
@stop
