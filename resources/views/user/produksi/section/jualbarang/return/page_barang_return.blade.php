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
               Return Barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Return Barang Penjualan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="row">
                                            <form role="form" action="{{ url('return-barang-jual') }}" method="post" enctype="multipart/form-data">

                                            <div class="col-md-12">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>No Order</label>
                                                                <input type="hidden" name="id_sales" value="{{ $data->id }}">
                                                                <input type="text" class="form-control" name="no_order" readonly value="{{ $data->no_sales }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Transaksi</label>
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right" id="datepicker2" readonly placeholder="Tanggal Pesanan" value="{{ date('d-m-Y', strtotime($data->tgl_sales)) }}" name="tgl_sales" >
                                                                </div>
                                                                <!-- /.input group -->
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
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label>Metod return</label>
                                                                <select class="form-control select2" style="width: 100%;" name="id_metode_return">
                                                                    @if(!empty($jenis_return))
                                                                        @foreach($jenis_return as $keys=> $data_return)
                                                                            <option value="{{ $keys }}" @if(!empty($data->linkToReturnBarangJual)) @if($data->linkToReturnBarangJual->status_return == $keys) selected @endif @endif> {{ $data_return }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Tgl Return</label>
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Return" value="@if(!empty($data->linkToReturnBarangJual)) {{ date('d-m-Y', strtotime($data->linkToReturnBarangJual->tgl_return)) }} @endif " name="tgl_return">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Ongkos Kirim</label>
                                                                <input type="text" class="form-control pull-right"placeholder="Ongkos Kirim" value="@if(!empty($data->linkToReturnBarangJual)) {{ $data->linkToReturnBarangJual->ongkir_return }} @endif" name="ongkos_kirim">
                                                                <!-- /.input group -->
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                    @if(!empty($data->linkToMannyComplainJual))
                                                        @php($no=1)
                                                        <table id="example"  class="table table-bordered table-striped"  style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Barang</th>
                                                                <th>Jumlah</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Diskon</th>
                                                                <th>Jumlah Harga</th>
                                                                <th>Alasan Return</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($jumlah_item=0)
                                                        @php($jumlah_uang=0)
                                                            @foreach($data->linkToMannyComplainJual->where('status_complain','1') as $data)
                                                                <tr>
                                                                    <th>@php($jumlah_item++)@php($jumlah_uang+=$data->total_return){{ $no++ }}</th>
                                                                    <th>{{ $data->linkToBarang->nm_barang }}</th>
                                                                    <th>{{ $data->jumlah_beli }}</th>
                                                                    <th>{{ $data->hpp }}</th>
                                                                    <th>{{ $data->diskon_item }}</th>
                                                                    <th>{{ $data->total_return }}</th>
                                                                    <th>{{ $data->alasan_ditolak }}</th>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="2">Total</th>
                                                                    <th >{{ $jumlah_item }}</th>
                                                                    <th ></th>
                                                                    <th ></th>
                                                                    <th >{{ number_format($jumlah_uang,2,',','.') }}</th>
                                                                    <th ></th>
                                                                </tr>
                                                            </tfoot>
                                                    </table>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary pull-right">Simpan</button>
                                            </div>
                                            </form>
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