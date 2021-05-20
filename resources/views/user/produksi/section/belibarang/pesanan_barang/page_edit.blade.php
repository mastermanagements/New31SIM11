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
                Rincian Pesanan Pembelian Barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Rincian Pesanan Pembelian dengan Nomor PO : <font color="#FF00GG">{{ $data->no_po }}</font> </h3>
                             <h5 class="pull-right"><a href="{{ url('Pembelian')}}">Kembali ke Halaman utama</a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="col-md-12">
                                <form role="form" action="{{ url('tambah-barang-pembelian/'.$data->id) }}" method="post" >
                                <div class="col-md-12 row" style="margin-top:10px">

                                        {{ csrf_field() }}
                                        <table style="width: 100%; margin-bottom: 10px">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Harga Beli</th>
                                                <th>Banyaknya</th>
                                                <th>Diskon (dalam %, misal: 10 %, tulis : 10)</td>
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
                                                    <input type="hidden" class="form-control" name="id_po" value="{{ $data->id }}"  required>
                                                    <input type="text" class="form-control" name="harga_beli" value="0" onkeyup="changer_format('harga_beli')" id="harga_beli" required>
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" name="jumlah_beli" value="0"  required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="diskon" placeholder="diskon" value="0" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="jumlah_total"  disabled required>
                                                    <input type="hidden" class="form-control" name="redirect" value="true">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Tambah barang</button>
                                        </div>
                                </form>

                                    @php($total_qty=0)
                                    @php($sub_item=0)
                                    @php($total_diskon=0)
                                        <h3>Daftar Pesanan Pembelian </h3>

                                            <table style="width: 100%; margin-bottom: 10px">
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Harga Beli</th>
                                                    <th>QTY</th>
                                                    <th>Diskon (%)</th>
                                                    <th>Nilai Diskon</th>
                                                    <th>Sub Total Diskon</th>
                                                    <th>Sub Total PO</th>
                                                    <th>Aksi</th>
                                                </tr>
                                                @foreach($data->linkToDetailPO as $keys=> $data_pesanan)

                                                    <form action="{{ url('ubah-barang-pembelian/'.$data_pesanan->id) }}" method="post">
                                                        <tr>
                                                            <td width="200">
                                                            {{ csrf_field() }}
                                                            @if(!empty($barang))
                                                                <select class="form-control select2" name="id_barang" style="width: 100%" required>
                                                                    @foreach($barang as $datas)
                                                                        <option value="{{ $datas->id }}" @if($data_pesanan->id_barang==$datas->id) selected @endif>{{ $datas->nm_barang }}, {{ $datas->linkToSatuan->satuan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                            </td>
                                                            <td width="140">
                                                                <input type="text" class="form-control" name="harga_beli" value="{{ rupiahView($data_pesanan->harga_beli) }}"  onkeyup="changer_format('harga_beli{{$keys}}')" id="harga_beli{{$keys}}" required>
                                                            </td>
                                                            <td width="80">
                                                                @php($total_qty += $data_pesanan->jumlah_beli)
                                                                <input type="number" class="form-control" name="jumlah_beli" value="{{ $data_pesanan->jumlah_beli }}"  required>
                                                            </td>
                                                            <td width="80">
                                                                <input type="text" class="form-control" name="diskon_item" placeholder="diskon per item" value="{{ $data_pesanan->diskon_item }}" required>
                                                            </td>
                                                            <td width="120">
                                                                @php($diskon_item = $data_pesanan->harga_beli * $data_pesanan->diskon_item/100)

                                                                <input type="text" readonly class="form-control"  placeholder="diskon per item" value="{{ rupiahView($diskon_item) }}" required>
                                                            </td>
                                                            <td width="150">
                                                              @php($subtotal_diskon=(($data_pesanan->harga_beli * $data_pesanan->diskon_item/100) * $data_pesanan->jumlah_beli))
                                                                <input type="text" class="form-control" readonly placeholder="diskon per item" value="{{ rupiahView($subtotal_diskon) }}" required>
                                                            </td>
                                                            <td width="150">
                                                                @php($sub_item+=$data_pesanan->jumlah_harga)
                                                                <input type="text" class="form-control" name="jumlah" readonly value="{{ rupiahView($data_pesanan->jumlah_harga) }}" required>
                                                            </td>
                                                              @php($total_diskon += (($data_pesanan->harga_beli * $data_pesanan->diskon_item/100) * $data_pesanan->jumlah_beli))

                                                            <td>
                                                                <button type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                                <a href="{{ url('hapus-barang-pembelian/'.$data_pesanan->id) }}" class="btn btn-danger" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"><i class="fa fa-eraser"></i></a>
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

                                </div>

                                </div>
                                <form action="{{ url('ubah-pesanan-pembelian/'.$data->id) }}" method="post">
                                    {{ csrf_field() }}
                                       <div class="col-md-12">
                                           <div class="row">
                                             <div class="col-md-6">
                                               <div class="form-group">
                                                   <label>Diskon Tambahan (Bilangan)</label>
                                                   <input type="text" id="rupiah2" name="diskon_tambahan" @if(!empty($data->diskon_tambahan)) value="{{ rupiahView($data->diskon_tambahan) }}" @else value="0" @endif class="form-control" required>
                                               </div>

                                             </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Pajak (dalam %, misal: 10 %, tulis : 10)</label>
                                                       <input type="number" name="pajak" class="form-control" @if(!empty($data->pajak)) value="{{ $data->pajak }}" @else  value="0" @endif >
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                             <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Uang Muka</label>
                                                       <input type="text"  id="rupiah" name="uang_muka" @if(!empty($data->dp_po)) value="{{ rupiahView($data->dp_po) }}" @else value="0" @endif class="form-control" required>
                                                   </div>
                                             </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Kurang Bayar</label>
                                                       <input type="hidden" name="sub_total" value="{{ $sub_item }}">
                                                       <input type="text" readonly name="kurang_bayar" class="form-control" @if(!empty($data->kurang_bayar)) value="{{ rupiahView($data->kurang_bayar) }}" @endif required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Keterangan</label>
                                                       <textarea name="ket" class="form-control">@if(!empty($data->ket))  {!! $data->ket !!} @endif</textarea>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Total Net</label>
                                                       <input type="text"  readonly class="form-control" @if(!empty($data->total)) value="{{ rupiahView($data->total) }}" @endif >
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <label><input type="checkbox" value="on" name="jurnal_otomatis"> Buat jurnal otomatis </label>  <button class="btn btn-primary"> Simpan Pesanan pembelian </button>
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
            var dis_total = 0;
            if(diskon !=0){
                n_diskon = diskon/100;
            }
            var jumlah_total =0;
            var sub_total =0;
            sub_total = (harga_beli.split('.').join('') * jumlah_beli);
            dis_total = sub_total * n_diskon;
            jumlah_total = sub_total - dis_total;

            $('[name="jumlah_total"]').val(formatRupiah(jumlah_total.toString()));
        }

    </script>

@stop
