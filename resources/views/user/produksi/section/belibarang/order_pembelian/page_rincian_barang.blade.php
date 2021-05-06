@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Rincian Pembelian Barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Rincian Pembelian dengan Nomor Order : <font color="#FF00GG">{{ $data_order->no_order }}</font> </h3>
                             <h5 class="pull-right"><a href="{{ url('Pembelian')}}">Kembali ke Halaman utama</a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="col-md-12">
                                <form role="form" action="{{ url('Order/'.$data_order->id.'/simpan') }}" method="post">
                                <div class="col-md-12 row" style="margin-top:10px">

                                        {{ csrf_field() }}
                                        <table style="width: 100%; margin-bottom: 10px">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Harga Beli</th>
                                                <th>Banyaknya</th>
                                                <th>Diskon (10%, tulis:10)</td>
                                                <th>Expire Date</th>
                                                <th>Sub Total</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if(!empty($barang))
                                                        <select class="form-control select2" name="id_barang" style="width: 100%" required>
                                                            @foreach($barang as $datas)
                                                                <option value="{{ $datas->id }}">{{ $datas->nm_barang }}, {{ $datas->linkToSatuan->satuan }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" class="form-control" name="id_order" value="{{ $data_order->id }}"  required>
                                                    <input type="number" class="form-control" name="harga_beli" value="0" required>
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" name="jumlah_beli" value="0"  required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="diskon" placeholder="diskon" value="0" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="expire_date" id="datepicker3">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="jumlah_total"  disabled required>
                                                    <input type="hidden" class="form-control" name="redirect" value="true">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Tambah barang</button>
                                        </div>
                                </form>
                                @if(!empty($data_order->linkToDetailOrder))
                                    @php($total_qty=0)
                                    @php($sub_item=0)
                                    @php($total_diskon=0)
                                        <h3>Daftar Pesanan Pembelian </h3>

                                            <table style="width: 100%; margin-bottom: 10px">
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Harga Beli</th>
                                                    <th>Banyaknya</th>
                                                    <th>Diskon Per item</th>
                                                    <th>Expire Date</th>
                                                    <th>Sub Total Diskon</th>
                                                    <th>Sub Total PO</th>
                                                    <th>Aksi</th>
                                                </tr>
                                                @foreach($data_order->linkToDetailOrder as $detail_order)

                                                    <form action="{{ url('Order/ubah-rincian-pembelian/'.$detail_order->id) }}" id="form-detail" method="post">
                                                        <tr>
                                                            <td width="200">
                                                            {{ csrf_field() }}
                                                            @if(!empty($barang))
                                                                <select class="form-control select2" name="id_barang" style="width: 100%" required>
                                                                    @foreach($barang as $datas)
                                                                        <option value="{{ $datas->id }}" @if($detail_order->id_barang==$datas->id) selected @endif>{{ $datas->nm_barang }}, {{ $datas->linkToSatuan->satuan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                            </td>
                                                            <td width="130">
                                                                <input type="text" class="form-control" name="harga_beli" value="{{ rupiahView($detail_order->harga_beli) }}"  required>
                                                            </td>
                                                            <td width="100">
                                                                @php($total_qty += $detail_order->jumlah_beli)
                                                                <input type="number" class="form-control" name="jumlah_beli" value="{{ $detail_order->jumlah_beli }}"  required>
                                                            </td>
                                                            <td width="120">
                                                                @php($diskon_item = $detail_order->harga_beli * $detail_order->diskon_item/100)

                                                                <input type="text" class="form-control" name="diskon_item" placeholder="diskon per item" value="{{ rupiahView($diskon_item) }}">
                                                            </td>
                                                            <td width="90">
                                                                <input type="text" class="form-control" name="expire_date" id="datepicker" @if(!empty($detail_order->expire_date)) value="{{ tanggalView($detail_order->expire_date) }}" @endif required>
                                                            </td>
                                                            <td width="130">
                                                              @php($subtotal_diskon=(($detail_order->harga_beli * $detail_order->diskon_item/100) * $detail_order->jumlah_beli))
                                                                <input type="text" class="form-control" readonly placeholder="diskon per item" value="{{ rupiahView($subtotal_diskon) }}">
                                                            </td>
                                                            <td width="130">
                                                                @php($sub_item+=$detail_order->jumlah_harga)
                                                                <input type="text" class="form-control" name="jumlah" readonly value="{{ rupiahView($detail_order->jumlah_harga) }}">
                                                            </td>
                                                              @php($total_diskon += (($detail_order->harga_beli * $detail_order->diskon_item/100) * $detail_order->jumlah_beli))

                                                            <td>
                                                                <button type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                                <a href="{{ url('hapus-detail-order/'.$detail_order->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus </a>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach

                                                <tr>

                                                    <th colspan="2">Total</th>
                                                    <th colspan="3">&nbsp;&nbsp;&nbsp;{{ $total_qty }} item</th>
                                                    <th colspan="1"> &nbsp;&nbsp;&nbsp;{{ rupiahView($total_diskon) }}</th>
                                                    <th>  &nbsp;&nbsp;&nbsp;{{ rupiahView($sub_item) }}</th>
                                                </tr>
                                            </table>

                                        @endif

                                    </div>


                                </div>
                                <!---update p_order-->
                                <br>
                                <form action="{{ url('Order/'.$data_order->id.'/simpan-rincian-pembelian') }}" method="post">
                                    {{ csrf_field() }}
                                        <input type="hidden" name="sub_total" value="{{ $sub_item }}">
                                       <div class="col-md-12">
                                           <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Uang Muka PO</label>
                                                    @if(!empty($data_order->linkToPO) AND ($data_order->dp_po == 0))
                                                        <input type="text"  id="rupiah" readonly name="uang_muka" @if(!empty($data_order->linkToPO->dp_po)) value="{{ rupiahView($data_order->linkToPO->dp_po) }}" @else value="0" @endif class="form-control" required>
                                                    @else
                                                        <input type="text"  id="rupiah" readonly name="uang_muka" @if(!empty($data_order->dp_po)) value="{{ rupiahView($data_order->dp_po) }}" @else value="0" @endif class="form-control" required>
                                                    @endif
                                                </div>
                                              </div>
                                               <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Pajak (dalam %, misal: 10 %, tulis : 10)</label>
                                                     <input type="number" name="pajak" class="form-control" @if(!empty($data_order->pajak)) value="{{ $data_order->pajak }}" @else  value="0" @endif >
                                                 </div>
                                             </div>
                                           </div>
                                           <div class="row">
                                             <div class="col-md-6">
                                               <div class="form-group">
                                                   <label>Diskon Tambahan (Bilangan)</label>
                                                   <input type="text" id="rupiah2" name="diskon_tambahan" class="form-control" @if(!empty($data_order->diskon_tambahan)) value="{{ rupiahView($data_order->diskon_tambahan) }}" @else  value="0" @endif >

                                               </div>
                                           </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">

                                                       <label>Ongkos Kirim</label>
                                                       <input type="text" id="rupiah3" name="onkir" class="form-control" @if(!empty($data_order->ongkir)) value="{{ rupiahView($data_order->ongkir) }}" @else  value="0" @endif >

                                                   </div>
                                               </div>

                                           </div>
                                           <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Metode pembayaran</label>
                                                        <select class="form-control" name="metode_bayar" onchange=" var value = $(this).val(); if(value==0){ $('#hutang').hide(), $('#jatuh_tempo').hide() }else{ $('#hutang').show(), $('#jatuh_tempo').show() }">
                                                            <option disabled>Pilih metode pembayaran</option>
                                                            @foreach ($metode_pembayaran as $key=> $item)
                                                                <option value="{{ $key }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bayar</label>

                                                        <input class="form-control" id="rupiah4" name="bayar" value="{{ rupiahView($data_order->bayar) }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="hutang" style="display: @if($data_order->metode_bayar=="0") none @else show @endif;">
                                                    <div class="form-group">
                                                        <label>Hutang</label>

                                                        <input type="text" id="rupiah5" name="kurang_bayar" readonly @if(!empty($data_order->kurang_bayar)) value="{{ rupiahView($data_order->kurang_bayar) }}" @else value="0" @endif class="form-control">

                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="jatuh_tempo" style="display: @if($data_order->metode_bayar=="0") none @else show @endif;">
                                                    <div class="form-group">

                                                        <label>Jatuh Tempo</label>

                                                        <input type="text" class="form-control" name="tgl_jatuh_tempo"  @if(!empty($data->tgl_jatuh_tempo)) value="{{ tanggalView($data->tgl_jatuh_tempo) }}" @endif required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <textarea name="ket" class="form-control">@if(!empty($data->ket))  {!! $data->ket !!} @endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                       <div class="col-md-12">
                                          <label><input type="checkbox" name="jurnal_otomatis" value="on"> Buat jurnal umum otomatis </label> <button type="submit" onclick="return confirm('Pastikan yang anda isi telah sesuai atau tidak')" class="btn btn-primary"> Simpan daftar pembelian </button>
                                       </div>
                                </form>
                          </div>
                        <!-- /.box-body -->
                    </div>
                  <!-- /.box-primary-->
              </div>
              <!--./col-md-12-->
          </div>
          <!--./row-->
        </section>
        <!-- /.content -->
    </div>
  <!--./content-wrapper -->
@stop
@section('plugins')
    @include('user.global.rupiah_input')
    @include('user.global.rupiah_input2')
    @include('user.global.rupiah_input3')
    @include('user.global.rupiah_input4')
    @include('user.global.rupiah_input5')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="harga_beli"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="harga_beli"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
        var harga_beli = 0;
        var diskon = 0;
        var jumlah_beli=0;
        var total=0;
        $('[name="harga_beli"]').keyup(function(){
            harga_beli = $(this).val();
            calculate_jumlah();
        })

        $('[name="diskon"]').keyup(function(){
            diskon = $(this).val();
            calculate_jumlah();
        })

        $('[name="jumlah_beli"]').keyup(function(){
            jumlah_beli = $(this).val();
            calculate_jumlah();
        })

        calculate_jumlah  = function(){
            var n_diskon = 0;
            if(diskon !=0){
                n_diskon = diskon/100;
            }
            var jumlah_total =0;
            var sub_total =0;
            sub_total = (harga_beli * jumlah_beli)
            dis_total = sub_total * n_diskon;
            jumlah_total = sub_total - dis_total;
            $('[name="jumlah_total"]').val(jumlah_total);
        }
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
        $('#datepicker4').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

    </script>

@stop
