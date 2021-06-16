@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Detail Penjualan barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">

                <div class="col-md-12">
                    @if(!empty(session('message_success')))
                        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                    @elseif(!empty(session('message_fail')))
                        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                    @endif
                    <div class="box box-warning">
                        <div class="box-header with-border">

                            <h6 class="box-title">Rincian Penjualan Faktur : <font
                                        color="#FF00GG">{{ $data->no_sales }}</font>, &nbsp;Klien: <font
                                        color="#FF00GG">@if($data->linkToKlien == NULL) Klien
                                    umum @else {{ $data->linkToKlien->nm_klien }}   @endif,
                                </font>
                                @if($data->id_group !=='0')
                                    @if(!empty($data->linkToKlien))
                                        @if(!empty($data->linkToKlien->linkToMannyGroupKlien->nama_group))
                                            Member:
                                            <font color="#FF00GG">  {{ $data->linkToKlien->linkToMannyGroupKlien->nama_group }}
                                                ,</font>
                                        @endif
                                    @else
                                        Non Member
                                    @endif
                                @endif
                                @if(!empty($data->linkToKlien))
                                    @if($data->linkToKlien->status_diskon =='0')
                                        Diskon Berjenjang:
                                        <font color="#FF00GG"> Ya </font>
                                    @else

                                        Diskon Berjenjang: Tidak </font>
                                    @endif
                                    <h6 class="box-title">Rincian Penjualan Faktur : <font
                                                color="#FF00GG">{{ $data->no_sales }}</font>, &nbsp;Klien: <font
                                                color="#FF00GG">@if(!($data->linkToKlien)){{ $data->linkToKlien->nm_klien }} @else
                                                Klien umum  @endif,
                                        </font>
                                        @if($data->id_group !=='0')
                                            @if(!empty($data->linkToKlien))
                                                @if(!empty($data->linkToKlien->linkToMannyGroupKlien->nama_group))
                                                    Member:
                                                    <font color="#FF00GG">  {{ $data->linkToKlien->linkToMannyGroupKlien->nama_group }}
                                                        ,</font>
                                                @endif
                                            @else
                                                Klien umum
                                            @endif
                                        @endif

                                        @if(!empty($data->linkToKlien))
                                            @if($data->linkToKlien->status_diskon =='0')
                                                Diskon Berjenjang:
                                                <font color="#FF00GG"> Ya </font>
                                            @else
                                                Diskon Berjenjang:  </font>

                                                <font color="#FF00GG">Tidak</font>

                                            @endif
                                        @else
                                            Klien Umum
                                        @endif
                                    </h6>
                                    <h5 class="pull-right"><a href="{{ url('Penjualan')}}">Kembali ke Halaman utama</a>
                                    </h5>

                                @else
                                    Tidak ada Skema Diskon
                                @endif
                            </h6>

                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <form action="{{ url('detail-penjualan-barang') }}" method="post">
                                        <input type="hidden" name="id_sales" value="{{ $data->id }}">
                                        <table style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Barang</th>
                                                <th>Harga Jual</th>
                                                <th>Banyak</th>
                                                <th>Diskon(%)</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td width="300">
                                                    {{ csrf_field() }}
                                                    <select class="form-control select2" style="width: 100%;"
                                                            name="id_barang" onchange="get_harga(3)" required>
                                                        <option disabled>Pilih Barang</option>
                                                        @if(!empty($barang))
                                                            @foreach($barang as $data_barang)
                                                                <option value="{{ $data_barang->id }}">{{ $data_barang->nm_barang }}
                                                                    , {{$data_barang->linkToSatuan->satuan}}
                                                                    , {{$data_barang->spec}}</option>
                                                            @endforeach
                                                        @endif
                                                        
                                                    </select>
                                                </td>
                                                <td><input type="text" name="hpp" class="form-control" id="show_harga"
                                                           required></td>
                                                <td><input type="number" name="jumlah_jual" class="form-control"
                                                           required></td>
                                                <td><input type="text" name="diskon_item" class="form-control" value="0"
                                                           readonly required></td>
                                                <td><input type="text" name="jumlah_harga" readonly class="form-control"
                                                           id="jumlah_harga" required></td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    @if(!empty($data->linkToDetailSales))
                                        <table style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Barang</th>
                                                <th>Harga Jual</th>
                                                <th>Banyak</th>
                                                <th>Diskon (%)</th>
                                                <th>Nilai Diskon</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($total_item = 0)
                                            @php($total_uang = 0)
                                            @php($total_diskon = 0)
                                            @foreach($data->linkToDetailSales as $keys=> $data_detail)
                                                <form action="{{ url('detail-penjualan-barang/'. $data_detail->id) }}"
                                                      method="post">
                                                    <tr>
                                                        <td width="200">
                                                            @method('put')
                                                            {{ csrf_field() }}
                                                            <select class="form-control select2" style="width: 100%;"
                                                                    onchange="get_harga(3,'{{$keys}}')" name="id_barang"
                                                                    id="id_barang{{$keys}}" required>
                                                                <option disabled>Pilih Barang</option>
                                                                @if(!empty($barang))
                                                                    @foreach($barang as $data_barang)
                                                                        <option value="{{ $data_barang->id }}"
                                                                                @if($data_barang->id==$data_detail->id_barang) selected @endif>{{ $data_barang->nm_barang }}
                                                                            , {{$data_barang->linkToSatuan->satuan}}
                                                                            , {{$data_barang->spec}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td width="150"><input type="text" name="hpp"
                                                                               class="form-control"
                                                                               id="show_harga{{$keys}}"
                                                                               value="{{ rupiahView($data_detail->hpp) }}"
                                                                               readonly required></td>
                                                        <td width="70"><input type="text" name="jumlah_jual"
                                                                              class="form-control"
                                                                              value="{{ rupiahView($data_detail->jumlah_jual) }}"
                                                                              required></td>
                                                        <td width="80"><input type="number" name="diskon"
                                                                              class="form-control"
                                                                              value="{{ $data_detail->diskon }}"
                                                                              required></td>
                                                        @php($nilai_diskon = $data_detail->hpp * $data_detail->diskon/100*$data_detail->jumlah_jual)
                                                        <td width="150"><input type="text" class="form-control" readonly
                                                                               value="{{ rupiahView($nilai_diskon) }}">
                                                        </td>
                                                        <td width="180"><input type="text" name="jumlah_harga" readonly
                                                                               class="form-control"
                                                                               value="{{ rupiahView($data_detail->jumlah_harga) }}"
                                                                               required></td>
                                                        <td>
                                                            @php($total_uang+=$data_detail->jumlah_harga)
                                                            @php($total_diskon += (($data_detail->hpp * $data_detail->diskon/100) * $data_detail->jumlah_jual))
                                                            @php($total_item+=$data_detail->jumlah_jual)
                                                            <button type="submit" class="btn btn-warning">ubah</button>
                                                            <a href="{{ url('detail-penjualan-barang/'.$data_detail->id.'/destroy') }}"
                                                               class="btn btn-danger"
                                                               onclick="return confirm('Apakah anda akan menghapus data ini...?')">hapus</a>
                                                        </td>
                                                    </tr>
                                                </form>
                                            @endforeach
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th colspan="2">&nbsp;&nbsp;&nbsp;{{ $total_item }} item</th>
                                                <th colspan="1"> &nbsp;&nbsp;&nbsp;{{ rupiahView($total_diskon) }}</th>
                                                <th> &nbsp;&nbsp;&nbsp;{{ rupiahView($total_uang) }}
                                                    <input type="hidden" id="sub_total" value="{{ $total_uang }}"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    @php($kembalian = 0)
                                    <div class="row">
                                        <form action="{{ url('penjualan-barang/'.$data->id.'/detail') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="sub_total" value="{{ $total_uang }}">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Uang Muka</label>
                                                    @if(!empty($data->linkToSo) AND ($data->dp_so == 0))
                                                        <input type="text" id="rupiah" name="dp_so" readonly
                                                               class="form-control"
                                                               @if(!empty($data->linkToSO->dp_so)) value="{{rupiahView($data->linkToSO->dp_so)}}"
                                                               @else value="0" @endif>
                                                    @else
                                                        <input type="text" id="rupiah" name="dp_so" readonly
                                                               @if(!empty($data->dp_so)) value="{{ rupiahView($data->dp_so) }}"
                                                               @else value="0" @endif class="form-control">
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Metode pembayaran</label>
                                                    <select class="form-control" name="metode_bayar"
                                                            onchange=" var value = $(this).val(); if(value==0){ $('#hutang').hide(), $('#jatuh_tempo').hide() }else{ $('#hutang').show(), $('#jatuh_tempo').show() }">
                                                        <option disabled>Pilih metode pembayaran</option>
                                                        @foreach ($metode_pembayaran as $key=> $item)
                                                            <option value="{{ $key }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea name="ket" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Pajak (%)</label>
                                                    <input type="number" name="pajak" class="form-control"
                                                           @if(!empty($data->pajak)) value="{{ $data->pajak }}"
                                                           @else value="0" @endif/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bayar</label>
                                                    <input type="text" id="rupiah2" name="bayar" class="form-control"
                                                           @if(!empty($data->bayar)) value="{{ rupiahView($data->bayar) }}"
                                                           @else value="0" @endif  required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Total Net</label>
                                                    <input type="text" name="total" id="total_keseluruhan"
                                                           @if(!empty($data->total)) value="{{rupiahView($data->total)}}"
                                                           @endif class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {{ csrf_field() }}
                                                    <label>Diskon Tambahan (Bilangan)</label>
                                                    <input type="text" id="rupiah3" name="diskon_tambahan"
                                                           class="form-control"
                                                           @if(!empty($data->diskon_tambahan)) value="{{ rupiahView($data->diskon_tambahan) }}"
                                                           @else value="0" @endif required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ongkos Kirim</label>
                                                    <input type="text" id="rupiah4" name="ongkir" class="form-control"
                                                           @if(!empty($data->ongkir)) value="{{ rupiahView($data->ongkir) }}"
                                                           @else value="0" @endif />
                                                </div>
                                                <div class="form-group">
                                                    <label>Kembali</label>
                                                    @php($kembalian = $data->bayar - $data->total )
                                                    <input type="text" id="id_kembalian"
                                                           value="{{rupiahView($kembalian)}}" class="form-control"
                                                           readonly>
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" id="hutang"
                                                     style="display: @if($data->metode_bayar=="0") none @else show @endif;">
                                                    <div class="form-group">
                                                        <label>Hutang</label>
                                                        <input type="text" name="kurang_bayar" readonly
                                                               @if(!empty($data->kurang_bayar)) value="{{ rupiahView($data->kurang_bayar) }}"
                                                               @else value="0" @endif class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group" id="jatuh_tempo"
                                                     style="display: @if($data->metode_bayar=="0") none @else show @endif;">
                                                    <label>Jatuh tempo</label>

                                                    <input type="text" class="form-control" id="datepicker"
                                                           name="tgl_jatuh_tempo"
                                                           @if(!empty($data->tgl_jatuh_tempo)) value="{{tanggalView($data->tgl_jatuh_tempo)}}" @endif />
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label><input type="checkbox" name="jurnal_otomatis" value="on"> Buat
                                                    jurnal penjualan otomatis </label>
                                                <label id="final_total" class="pull-right"></label>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

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
    @include('user.global.rupiah_input2')
    @include('user.global.rupiah_input3')
    @include('user.global.rupiah_input4')
    @include('user.global.CalculateTotalPenjualan')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


        $('[name="hpp"]').keyup(function () {
            calculate_total();
        })
        $('[name="jumlah_jual"]').keyup(function () {
            calculate_total();
        })

        $('[name="diskon_item"]').keyup(function () {
            calculate_total();
        })

        //        calculate_total = function(){
        //            var jumlah_harga = $('[name="hpp"]').val();
        //            var jumlah_jual = $('[name="jumlah_jual"]').val();
        //            var diskon = $('[name="diskon"]').val();
        //            var total =jumlah_jual * jumlah_harga;
        //            if(diskon !=0){
        //                diskon = total * (diskon/100);
        //                total = total - diskon;
        //            }
        //
        //            $('#tbl_jumlah').val(total);
        //        }

    </script>

@stop
