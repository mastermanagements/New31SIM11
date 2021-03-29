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
                            <h3 class="box-title">Complain Barang Penjualan</h3>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
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
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-12" style="overflow-x: scroll;">
                                                <hr>
                                                    @if(!empty($data->linkToDetailSales))
                                                        <table class="table-wrapper">
                                                        <thead>
                                                            <tr>
                                                                <th>Barang</th>
                                                                <th>Harga Jual</th>
                                                                <th>Banyak</th>
                                                                <th>Diskon</th>
                                                                <th>Jumlah</th>
                                                                <th>Complain</th>
                                                                <th>Keterangan</th>
                                                                <th>Status Barang</th>
                                                                <th>Alasan Ditolak</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($total_item = 0)
                                                        @php($total_uang = 0)
                                                        @php($total_diskon = 0)
                                                        @foreach($data->linkToDetailSales as $data_detail)
                                                            <form action="{{ url('complain-barang-jual') }}" method="post">
                                                                <tr>
                                                                    <th>
                                                                        <input type="hidden" name="id_detail_sales" value="{{ $data_detail->id }}">
                                                                        <input type="hidden" name="id_sales" value="{{ $data->id }}">
                                                                        {{ csrf_field() }}
                                                                        <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                                                            <option disabled>Pilih Barang</option>
                                                                            @if(!empty($barang))
                                                                                @foreach($barang as $data_barang)
                                                                                    <option value="{{ $data_barang->id }}" @if($data_barang->id==$data_detail->id_barang) selected @endif>{{ $data_barang->nm_barang }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </th>
                                                                    <th ><input type="number" name="hpp" class="form-control" value="{{ $data_detail->hpp }}" required></th>
                                                                    <th ><input type="number" name="jumlah_beli" class="form-control" value="{{ $data_detail->jumlah_jual }}" required></th>
                                                                    <th ><input type="number" name="diskon_item" class="form-control" value="{{ $data_detail->diskon }}"  required></th>
                                                                    <th ><input type="number" name="jumlah_harga" readonly class="form-control" value="{{ $data_detail->jumlah_harga }}" required></th>
                                                                    <th>
                                                                        @php($total_uang+=$data_detail->jumlah_harga)
                                                                        @php($total_diskon+=$data_detail->diskon)
                                                                        @php($total_item+=$data_detail->jumlah_jual)
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="complain_jumlah" value="@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->complain_jumlah }} @endif" placeholder="Jumlah barang kurang">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="complain_kualitas" value="@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->complain_kualitas }} @endif" placeholder="Kondisi Barang">
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <textarea class="form-control" name="ket">@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->ket }} @endif</textarea>
                                                                    </th>
                                                                    <th>
                                                                        <select class="form-control" name="status_complain">
                                                                            <option value="0" @if(!empty($data_detail->linkToComplainBarangJual)) @if($data_detail->linkToComplainBarangJual->status_complain=='0') selected @endif @endif>Diterima</option>
                                                                            <option value="1" @if(!empty($data_detail->linkToComplainBarangJual)) @if($data_detail->linkToComplainBarangJual->status_complain=='1') selected @endif @endif>Ditolak</option>
                                                                        </select>
                                                                    </th>
                                                                    <th>
                                                                        <textarea class="form-control" name="alasan_ditolak">@if(!empty($data_detail->linkToComplainBarangJual)) {{ $data_detail->linkToComplainBarangJual->alasan_ditolak }} @endif</textarea>
                                                                    </th>
                                                                    <th>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </th>
                                                                </tr>
                                                            </form>

                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                @endif
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

        $(document).ready(function () {
            var total_detail_ces = parseInt($('#total_uang').text());

            $('[name="diskon_tambahan"]').keyup(function(){
                var nilai_diskon = $(this).val();
                var sub_total = $('#total_uang').text();
                var diskon_tambahan = 0;
                var total_detail=0;
                if(nilai_diskon !=0){
                    diskon_tambahan = parseInt(sub_total)*(nilai_diskon/100);
                    total_detail = parseInt(sub_total)-diskon_tambahan;
                }

                $('#total_setelah_didiskon').val(total_detail);
                total_detail_ces = total_detail;
                $('#total_keseluruhan').val(total_detail_ces);
            });

            $('[name="pajak"]').keyup(function(){
                var vpajak = $(this).val();
                var total_pajak = total_detail_ces;
                if(vpajak != 0){
                    var pajak_new = total_pajak*(vpajak/100);
                    total_pajak = total_pajak + pajak_new;
                }
                $('#total_setelah_pajak').val(total_pajak);
                total_detail_ces = total_pajak;
                $('#total_keseluruhan').val(total_pajak);
            });

            $('[name="biaya_tambahan"]').keyup(function () {
                var total_plus_bTambahan =0;
                total_plus_bTambahan  = Number(total_detail_ces)+Number($(this).val());
               $('#total_keseluruhan').val(total_plus_bTambahan);
            })
        })
    </script>

@stop