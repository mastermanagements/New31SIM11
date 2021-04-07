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
                Detail Penjualan barang s
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Detail Tambah Penjualan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form role="form" action="{{ url('penjualan-barang/'.$data->id) }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @method('put')

                                                    <div class="form-group">
                                                    <label>No Faktur</label>
                                                    <input type="text" class="form-control" name="no_sales" readonly value="{{ $data->no_sales }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Penjualan</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker2" readonly placeholder="Tanggal Pesanan" value="{{ $data->tgl_sales }}" name="tgl_sales" >
                                                    </div>
                                                    <!-- /.input group -->
                                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Pesanan Penjualan</label>
                                                    <select class="form-control select2" style="width: 100%;" name="id_so" disabled>
                                                        <option value="null">Pilihan pesanan penjualan</option>
                                                        @if(!empty($pesanan_jual))
                                                            @foreach($pesanan_jual as $value)
                                                                <option value="{{ $value->id }}" @if($value->id == $data->id_so) selected @endif>{{ $value->no_so }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Klien</label>
                                                    <select class="form-control select2" style="width: 100%;" name="id_klien" required disabled>
                                                        @if(empty($klien))
                                                            <option>Klien masih kosong</option>
                                                        @else
                                                            @foreach($klien as $value)
                                                                <option value="{{ $value->id }}" @if($value->id== $data->id_klien) selected @endif>{{ $value->nm_klien }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Barang Kirim</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker3" readonly="" placeholder="Tanggal kirim sampai dengan" value="{{ $data->tgl_kirim }}" name="tgl_kirim" >
                                                    </div>
                                                    <!-- /.input group -->
                                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Salesman</label>
                                                    <select class="form-control select2" style="width: 100%;" name="id_komisi_sales" required disabled>
                                                        @if(empty($komisi_sales))
                                                            <option>Klien masih kosong</option>
                                                        @else
                                                            @foreach($komisi_sales as $value)
                                                                <option value="{{ $value->id }}" @if($value->id == $data->id_komisi_sales) selected @endif>{{ $value->linkToKaryawan->nama_ky }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                                </div>

                                                <div class="form-group">
                                                  <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" name="ket" readonly>{{ $data->ket }}</textarea>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                <form action="{{ url('detail-penjualan-barang') }}" method="post">
                                                    <input type="hidden" name="id_sales" value="{{ $data->id }}">
                                                    <table style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Barang</th>
                                                            <th>Harga Jual</th>
                                                            <th>Banyak</th>
                                                            <th>Diskon</th>
                                                            <th>Jumlah</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th width="300">
                                                                {{ csrf_field() }}
                                                                <select class="form-control select2" style="width: 100%;" name="id_barang"  onchange="get_harga(3)" required>
                                                                    <option disabled>Pilih Barang</option>
                                                                    @if(!empty($barang))
                                                                        @foreach($barang as $data_barang)
                                                                            <option value="{{ $data_barang->id }}">{{ $data_barang->nm_barang }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </th>
                                                            <th><input type="number" name="hpp" class="form-control" id="show_harga" required></th>
                                                            <th><input type="number" name="jumlah_jual" class="form-control" required></th>
                                                            <th><input type="number" name="diskon" class="form-control" required></th>
                                                            <th><input type="number" name="jumlah_harga" readonly class="form-control" id="tbl_jumlah" required></th>
                                                            <th><button type="submit" class="btn btn-primary">Simpan</button></th>
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
                                                                <th>Diskon</th>
                                                                <th>Jumlah</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($total_item = 0)
                                                        @php($total_uang = 0)
                                                        @php($total_diskon = 0)
                                                        @foreach($data->linkToDetailSales as $keys=> $data_detail)


                                                            <form action="{{ url('detail-penjualan-barang/'. $data_detail->id) }}" method="post">
                                                                <tr>
                                                                    <th >

                                                                        @method('put')
                                                                        {{ csrf_field() }}
                                                                        <select class="form-control select2" style="width: 100%;" name="id_barang"  onchange="get_harga(3,'{{$keys}}')" id="id_barang{{$keys}}"  required>
                                                                            <option disabled>Pilih Barang</option>
                                                                            @if(!empty($barang))
                                                                                @foreach($barang as $data_barang)
                                                                                    <option value="{{ $data_barang->id }}" @if($data_barang->id==$data_detail->id_barang) selected @endif>{{ $data_barang->nm_barang }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </th>
                                                                    <th width="200"><input type="number" name="hpp" class="form-control" id="show_harga{{$keys}}" value="{{ $data_detail->hpp }}" required></th>
                                                                    <th width="200"><input type="number" name="jumlah_jual" class="form-control" value="{{ $data_detail->jumlah_jual }}" required></th>
                                                                    <th width="200"><input type="number" name="diskon" class="form-control" value="{{ $data_detail->diskon }}"  required></th>
                                                                    <th width="200"><input type="number" name="jumlah_harga" readonly class="form-control" value="{{ $data_detail->jumlah_harga }}" required></th>
                                                                    <th>
                                                                        @php($total_uang+=$data_detail->jumlah_harga)
                                                                        @php($total_diskon+=$data_detail->diskon)
                                                                        @php($total_item+=$data_detail->jumlah_jual)
                                                                        <button type="submit" class="btn btn-warning">ubah</button>
                                                                        <a href="{{ url('detail-penjualan-barang/'.$data_detail->id.'/destroy') }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini...?')">hapus</a>
                                                                    </th>
                                                                </tr>
                                                            </form>

                                                            @endforeach
                                                            <tr>
                                                                <td colspan="2">

                                                                </td>
                                                                <td>Total item  : <label id="total_item">{{ $total_item }}</label></td>
                                                                <td>Total diskon: <label id="total_diskon">{{ $total_diskon }}</label></td>
                                                                <td>Total Uang  : <label id="sub_total">{{ $total_uang }}</label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="row">
                                                    <form action="{{ url('penjualan-barang/'.$data->id.'/detail') }}" method="post">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                {{ csrf_field() }}
                                                                <label>Diskon Tambahan</label>
                                                                <input type="number" id="diskon_tambahan" name="diskon_tambahan" class="form-control" @if(!empty($data->diskon_tambahan)) value="{{ $data->diskon_tambahan }}" @else value="0" @endif required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pajak</label>
                                                                <input type="number" id="pajak_tambahan" name="pajak" class="form-control"  @if(!empty($data->pajak)) value="{{ $data->pajak }}" @else value="0" @endif required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Biaya tambahan lain</label>
                                                                <input type="number" id="biaya_tambahan" name="biaya_tambahan" class="form-control"  @if(!empty($data->biaya_tambahan)) value="{{ $data->biaya_tambahan }}" @else value="0" @endif  required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Jatuh tempo</label>
                                                                <input type="date" name="jatuh_tempo" class="form-control" @if(!empty($data->tgl_jatuh_tempo)) value="{{$data->tgl_jatuh_tempo}}"  @else value="{{$data->tgl_jatuh_tempo}}" @endif required/>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Uang Muka</label>
                                                            <input type="number" id="uang_muka" class="form-control" @if(!empty($data->dp_so)) value="{{$data->dp_so}}"  @else value="{{$total_uang}}" @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Hutang</label>
                                                                <input type="number" readonly id="kurang_bayar" class="form-control" name="hutang" @if(!empty($data->kurang_bayar)) value="{{$data->kurang_bayar}}"  @else value="0" @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Metode pembayaran</label>
                                                                <select class="form-control" name="metode_bayar">
                                                                    <option disabled>Pilih metode pembayaran</option>
                                                                    @foreach ($metode_pembayaran as $key=> $item)
                                                                        <option value="{{ $key }}">{{ $item }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Keterangan</label>
                                                                <textarea name="ket" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Total Keseluruhan</label>
                                                                <input type="text" name="total" id="total_keseluruhan" @if(!empty($data->bayar)) value="{{number_format($data->bayar,0,'','')}}" @endif class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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

        $('[name="hpp"]').keyup(function(){
            calculate_total();
        })
        $('[name="jumlah_jual"]').keyup(function(){
            calculate_total();
        })

        $('[name="diskon"]').keyup(function(){
            calculate_total();
        })

        calculate_total = function(){
            var jumlah_harga = $('[name="hpp"]').val();
            var jumlah_jual = $('[name="jumlah_jual"]').val();
            var diskon = $('[name="diskon"]').val();
            var total =jumlah_jual * jumlah_harga;
            if(diskon !=0){
                diskon = total * (diskon/100);
                total = total - diskon;
            }

            $('#tbl_jumlah').val(total);
        }

    </script>

@stop