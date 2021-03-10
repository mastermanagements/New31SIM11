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
                Pesanan Penjualan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Pesanan Penjualan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                                <div class="row">

                                        <div class="col-md-12">

                                            <form role="form" action="{{ url('pesanan-penjualan/'.$data->id) }}" method="post" enctype="multipart/form-data">

                                                {{ csrf_field() }}
                                            @method('put')
                                            <div class="form-group">
                                                <label>No Pesanan</label>
                                                <input type="text" class="form-control" name="no_so" value="{{ $data->no_so }}" readonly>

                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Pesanan</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker2" value="{{ date('d-m-Y', strtotime($data->tgl_so)) }}" placeholder="Tanggal Pesanan" name="tgl_so" readonly>
                                                </div>
                                                <!-- /.input group -->
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No. PO</label>
                                                <select class="form-control select2" style="width: 100%;" name="id_po" disabled >
                                                    <option value="null">Pilihan Penawaran Penjualan</option>
                                                    @if(!empty($tawar_jual))
                                                        @foreach($tawar_jual as $value)
                                                            <option value="{{ $value->id }}" @if($value->id==$data->id_po) selected @endif>{{ $value->no_tawar }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Klien</label>
                                                <select class="form-control select2" style="width: 100%;" name="id_klien" disabled>
                                                    @if(empty($klien))
                                                        <option>Klien masih kosong</option>
                                                    @else
                                                        @foreach($klien as $value)
                                                            <option value="{{ $value->id }}" @if($value->id==$data->id_klien) selected @endif>{{ $value->nm_klien }}</option>
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
                                                    <input type="text" class="form-control pull-right" id="datepicker3" value="{{ date('d-m-Y', strtotime($data->tgl_dikirim)) }}" placeholder="Tanggal kirim sampai dengan" name="tgl_krm" readonly >
                                                </div>
                                                <!-- /.input group -->
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>

                                                <textarea class="form-control" name="ket" readonly>{{ $data->ket }}</textarea>
                                            </div>
                                            {{--<div class="form-group">--}}
                                                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                            {{--</div>--}}
                                            </form>
                                            @php($jumlah_item = 0)
                                            @php($jumlah_uang = 0)
                                            @php($no = 1)
                                            @if(empty($data->linkToPO))
                                                <div class="col-md-12">
                                                <hr>
                                                <form action="{{ url('detail-pSo') }}" method="post">
                                                    {{ csrf_field() }}
                                                     <table style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Nama</td>
                                                            <td>Harga Beli</td>
                                                            <td>Banyaknya</td>
                                                            <td>Diskon</td>
                                                            <td>Jumlah</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                            <tr>
                                                                <td># <input type="hidden" name="id_so" value="{{ $data->id }}"></td>
                                                                <td>
                                                                    @if(!empty($barang))
                                                                        <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                                                            @foreach($barang as $item)
                                                                                <option value="{{ $item->id }}" >{{ $item->nm_barang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="hpp" class="form-control" value="0">
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="jumlah_jual" class="form-control" value="0">
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="diskon_item" class="form-control" value="0">
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="jumlah_harga" id="jumlah_harga" class="form-control" value="0" readonly>
                                                                </td>
                                                            </tr>

                                                    </tbody>
                                                </table>
                                                    <div class="form-group" style="margin-top: 20px">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                                @if(!empty($data->linkToDetailPSO))
                                                    <div class="col-md-12">
                                                        <table style="width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <td>No</td>
                                                                <td>Nama</td>
                                                                <td>Harga Beli</td>
                                                                <td>Banyaknya</td>
                                                                <td>Diskon</td>
                                                                <td>Jumlah</td>
                                                                <td>Aksi</td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($data->linkToDetailPSO as $n_data)
                                                                <form action="{{ url('detail-pSo/'. $n_data->id) }}" method="post">
                                                                    <tr>
                                                                        <td>{{ $no++ }} @php($jumlah_item++)<input type="hidden" name="id_so" value="{{ $n_data->id_so }}"> @method('put') {{ csrf_field() }}</td>
                                                                        <td>
                                                                            @if(!empty($barang))
                                                                                <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                                                                    @foreach($barang as $item)
                                                                                        <option value="{{ $item->id }}" @if($n_data->id_barang == $item->id) selected @endif>{{ $item->nm_barang }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="hpp" class="form-control" value="{{ $n_data->hpp }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="jumlah_jual" class="form-control" value="{{ $n_data->jumlah_jual }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="diskon_item" class="form-control" value="{{ $n_data->diskon }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="jumlah_harga" class="form-control" value="{{ $n_data->jumlah_harga }}" readonly>
                                                                            @php($jumlah_uang += $n_data->jumlah_harga)
                                                                        </td>
                                                                        <td>
                                                                            <button type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                                            <a href="{{ url('detail-pSo/'.$n_data->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> <i class="fa fa-eraser"></i> </a>
                                                                        </td>
                                                                    </tr>
                                                                </form>
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td colspan="4">

                                                                </td>
                                                                <td>
                                                                    Total item: {{ $jumlah_item }}
                                                                </td>
                                                                <td>
                                                                    Total uang: {{ $jumlah_uang }}
                                                                </td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                @endif
                                            @else
                                                @if(!empty($data->linkToPO->linkToDetailTawarBeli))
                                                    <table style="width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Nama</td>
                                                            <td>Harga Beli</td>
                                                            <td>Banyaknya</td>
                                                            <td>Diskon</td>
                                                            <td>Jumlah</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($data->linkToPO->linkToDetailTawarBeli as $n_data)
                                                           <tr>
                                                               <th>{{ $no++ }} @php($jumlah_item++)</th>
                                                               <th>{{ $n_data->linkToBarang->nm_barang }}</th>
                                                               <th>{{ $n_data->hpp }}</th>
                                                               <th>{{ $n_data->jumlah_barang }}</th>
                                                               <th>{{ $n_data->diskon }}</th>
                                                               <th>{{ $n_data->total_tj }}  @php($jumlah_uang += $n_data->total_tj)</th>
                                                           </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="4">
                                                            </td>
                                                            <td>
                                                                Total item: {{ $jumlah_item }}
                                                            </td>
                                                            <td>
                                                                Total uang: {{ $jumlah_uang }}
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                @endif
                                            @endif


                                            <div class="col-md-12">
                                                <hr>
                                                <div class="row">
                                                    <form action="{{ url('pesanan-penjualan/'.$data->id) }}" method="post">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                {{ csrf_field() }}
                                                                <input name="sub_total" type="hidden" value="{{ $jumlah_uang }}">
                                                                <label>Diskon Tambahan</label>
                                                                <input type="number" class="form-control" name="diskon_tambahan" value="{{ $data->diskon_tambahan }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pajak</label>
                                                                <input type="number" class="form-control" name="pajak" value="{{ $data->pajak }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Uang Muka</label>
                                                                <input type="number" class="form-control" name="uang_muka" value="{{ $data->dp_so }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kurang Bayar</label>
                                                                <input type="number" class="form-control" name="kurang_bayar" value="{{ $data->kurang_bayar }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label><input type="checkbox" name="jurnal_otomatis" value="on"> Buat jurnal penjualan otomatis  </label> <button type="submit" class="btn btn-primary"> Proses </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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

        $('[name="hpp"]').keyup(function () {
            calculate_total();
        });

        $('[name="jumlah_jual"]').keyup(function () {
            calculate_total();
        });

        $('[name="diskon_item"]').keyup(function () {
            calculate_total();
        });

        calculate_total = function(){
            var harga_beli = $('[name="hpp"]').val();
            var jumlah_jual = $('[name="jumlah_jual"]').val();
            var diskon_item = $('[name="diskon_item"]').val();
            var total;
            total = harga_beli * jumlah_jual;

            //diskon
            if(diskon_item != 0 ){
                var diskon = total * (diskon_item/100);
                total = total - diskon;
            }
            $('#jumlah_harga').val(total);
        }
    </script>

@stop