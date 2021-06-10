@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
	 <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rincian Pesanan Penjualan Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rincian Pesanan Penjualan dengan Nomor SO : <font color="#FF00GG">{{ $data->no_so }}</font>, Klien: <font color="#FF00GG">@if(!empty($data->linkToKlien)){{ $data->linkToKlien->nm_klien }}@else Klien Umum @endif</font></h3>
                         <h5 class="pull-right"><a href="{{ url('Penjualan')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        @if(!empty(session('message_success')))
                            <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                        @elseif(!empty(session('message_fail')))
                            <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                        @endif
                        <div class="col-md-12">
                            <form role="form" action="{{ url('detail-pSo') }}" method="post">
                            <div class="col-md-12 row" style="margin-top:10px">

                                    {{ csrf_field() }}

                                    <table style="width: 100%; margin-bottom: 10px">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Harga Jual</th>
                                            <th>Banyaknya</th>
                                            <th>Diskon (misal: 10 %, tulis : 10)</td>
                                            <th>Sub Total</th>
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="id_so" value="{{ $data->id }}">
                                            <td>
                                                @if(!empty($barang))
                                                    <select class="form-control select2" style="width: 100%;" name="id_barang"  onchange="get_harga(3)"  required>
                                                        @foreach($barang as $item)
                                                            <option value="{{ $item->id }}" >{{ $item->nm_barang }}, {{ $item->linkToSatuan->satuan }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="hpp" class="form-control" value="0" id="show_harga" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah_jual" class="form-control" value="0">
                                            </td>
                                            <td>
                                                <input type="text" name="diskon_item" class="form-control" value="0">
                                            </td>
                                            <td>
                                                <input type="text" name="jumlah_harga" id="jumlah_harga" class="form-control" value="0" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Tambah Barang</button>
                                    </div>
                            </form>

                                    <h3>Daftar Pesanan Penjualan </h3>

                                        <table style="width: 100%; margin-bottom: 10px">
                                            <thead>
                                              <tr>
                                                <th>Nama Barang</th>
                                                <th>Harga Jual</th>
                                                <th>QTY</th>
                                                <th>Diskon (%)</th>
                                                <th>Nilai Diskon</th>
                                                <th>Sub Total Diskon</th>
                                                <th>Sub Total PO</th>
                                                <th>Aksi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @php($total_qty=0)
                                            @php($jumlah_uang=0)
                                            @php($total_diskon=0)
                                            @php($subtotal_diskon=0)
                                            @foreach($data->linkToDetailPSO as $keys=> $n_data)
                                            <form action="{{ url('detail-pSo/'. $n_data->id) }}" method="post">
                                              @method('put') {{ csrf_field() }}
                                                <tr>

                                                    <td width="190">
                                                        @if(!empty($barang))
                                                            <select class="form-control select2" style="width: 100%;" name="id_barang"  onchange="get_harga(3,'{{$keys}}')" id="id_barang{{$keys}}" required>
                                                                @foreach($barang as $item)
                                                                    <option value="{{ $item->id }}" @if($n_data->id_barang == $item->id) selected @endif>{{ $item->nm_barang }}, {{$item->linkToSatuan->satuan}}, {{$item->spec}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td width="130">
                                                        <input type="hidden" name="id_so" value="{{ $n_data->id_so }}">
                                                        <input type="text" name="hpp" class="form-control" value="{{ rupiahView($n_data->hpp) }}" id="show_harga{{$keys}}" >
                                                    </td>
                                                    <td width="70">
                                                          @php($total_qty += $n_data->jumlah_jual)
                                                        <input type="text" name="jumlah_jual" class="form-control" value="{{ rupiahView($n_data->jumlah_jual) }}">
                                                    </td>
                                                    <td width="50">
                                                        <input type="text" class="form-control" name="diskon_item"  value="{{ $n_data->diskon_item }}" required>
                                                    </td>
                                                      <td width="130">
                                                      @php($diskon_item = $n_data->hpp * $n_data->diskon_item/100)
                                                        <input type="text"  class="form-control" readonly value="{{ rupiahView($diskon_item) }}">
                                                    </td>
                                                    <td>
                                                      @php($subtotal_diskon =(($n_data->hpp * $n_data->diskon_item/100) * $n_data->jumlah_jual))
                                                      @php($total_diskon += (($n_data->hpp * $n_data->diskon_item/100) * $n_data->jumlah_jual))

                                                        <input type="text" class="form-control"   placeholder="diskon per item" value="{{ rupiahView($subtotal_diskon) }}" readonly >
                                                    </td>
                                                      <td width="140">
                                                        <input type="text" name="jumlah_harga" class="form-control" value="{{ rupiahView($n_data->jumlah_harga) }}" readonly>
                                                        @php($jumlah_uang += $n_data->jumlah_harga)
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                        <a href="{{ url('detail-pSo/'.$n_data->id.'/delete') }}" class="btn btn-danger" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"><i class="fa fa-eraser"></i></a>
                                                    </td>

                                                </tr>
                                            </form>
                                        @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th colspan="3">&nbsp;&nbsp;&nbsp;{{ $total_qty }} item</th>
                                                <th colspan="1"> &nbsp;&nbsp;&nbsp;{{ rupiahView($total_diskon) }}</th>
                                                <th>  &nbsp;&nbsp;&nbsp;{{ rupiahView($jumlah_uang) }}</th>
                                            </tr>
                                          </tfoot>
                                        </table>
                            </div>

                            </div>
                            <form action="{{ url('pesanan-penjualan/'.$data->id) }}" method="post">
                                {{ csrf_field() }}
                                  <input name="sub_total" type="hidden" value="{{ $jumlah_uang }}">
                                   <div class="col-md-12">
                                       <div class="row">
                                         <div class="col-md-4">
                                             <div class="form-group">
                                                 <label>Diskon Tambahan (Bilangan)</label>
                                                 <input type="text" id="rupiah2" name="diskon_tambahan" @if(!empty($data->diskon_tambahan)) value="{{ rupiahView($data->diskon_tambahan) }}" @else value="0" @endif class="form-control" required>
                                             </div>
                                            <div class="form-group">
                                                   <label>Pajak (dalam %, misal: 10 %, tulis : 10)</label>
                                                   <input type="number"  name="pajak" class="form-control" @if(!empty($data->pajak)) value="{{ $data->pajak }}" @else  value="0" @endif >
                                              </div>
                                           </div>
                                            <div class="col-md-4">
                                               <div class="form-group">
                                                   <label>Uang Muka</label>
                                                   <input type="text"  id="rupiah3" name="uang_muka" @if(!empty($data->dp_so)) value="{{ rupiahView($data->dp_so) }}" @else value="0" @endif class="form-control" required>
                                               </div>
                                               <div class="form-group">
                                                   <label>Kurang Bayar</label>
                                                   <input type="text" readonly name="kurang_bayar" class="form-control" @if(!empty($data->kurang_bayar)) value="{{ rupiahView($data->kurang_bayar) }}" @endif required>
                                               </div>
                                           </div>
                                           <div class="col-md-4">
                                               <div class="form-group">
                                                   <label>Total Net</label>
                                                   <input type="text"  readonly class="form-control" @if(!empty($data->total)) value="{{ rupiahView($data->total) }}" @endif >
                                               </div>
                                               <div class="form-group">
                                                   <label>Keterangan</label>
                                                   <textarea name="ket" class="form-control">@if(!empty($data->ket))  {!! $data->ket !!} @endif</textarea>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <label><input type="checkbox" name="jurnal_otomatis" value="on"> Buat jurnal pesanan penjualan otomatis  </label> <button type="submit" class="btn btn-primary"> Proses </button>
                                       <label id="final_total" class="pull-right"></label>
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
<!--./content-wrapper-->
@stop

@section('plugins')
@include('user.global.rupiah_input')
@include('user.global.rupiah_input2')
@include('user.global.rupiah_input3')
@include('user.global.CalculateTotalPenjualan')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });



        $('[name="hpp"]').keyup(function () {
            calculate_total();
        });

        $('[name="jumlah_jual"]').keyup(function () {
            calculate_total();
        });

        $('[name="diskon_item"]').keyup(function () {
            calculate_total();
        });

//        calculate_total = function(){
//            var harga_beli = $('[name="hpp"]').val();
//            var jumlah_jual = $('[name="jumlah_jual"]').val();
//            var diskon_item = $('[name="diskon_item"]').val();
//            var total;
//            total = harga_beli * jumlah_jual;
//
//            //diskon
//            if(diskon_item != 0 ){
//                var diskon = total * (diskon_item/100);
//                total = total - diskon;
//            }
//            $('#jumlah_harga').val(total);
//        }
    </script>

@stop
