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
            Pembelian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Pembelian</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <form action="{{ url('simpan-return-barang') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id_cek_barang" value="{{ $data->linkToCekBarang->id }}">
                                        <label for="no_order">No Order</label>
                                        <input type="text" class="form-control" name="no_order" value="{{ $data->no_order }}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <input type="text" class="form-control" name="supplier" value="{{ $data->linkToSuppliers->nama_suplier }}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_transaksi">Tanggal Transaksi</label>
                                        <input type="text" class="form-control" name="tgl_transaksi" value="{{ date('d/m/y', strtotime($data->tgl_order)) }}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_return">Bentuk return</label>
                                        <select name="jenis_return" class="select2" style="width: 100%" required> 
                                            <option disabled>Pilih bentuk return</option>
                                            @if (!empty($bentuk_return))
                                                @foreach ($bentuk_return as $key=> $item)
                                                    <option value="{{ $key }}" 
                                                        @if (!empty($data->linkToCekBarang->linkToReturnPembelian))
                                                            @if ($data->linkToCekBarang->linkToReturnPembelian->jenis_return==$key)
                                                                selected
                                                            @endif
                                                        @endif
                                                    >{{ $item }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_return">Tanggal Return</label>
                                        <input type="date" class="form-control" name="tgl_return" 
                                        @if (!empty($data->linkToCekBarang->linkToReturnPembelian))
                                           value="{{ $data->linkToCekBarang->linkToReturnPembelian->tgl_return }}"
                                        @endif 
                                    required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="ongkir_return">Ongkos Kirim</label>
                                        <input type="number" class="form-control" name="ongkir_return" 
                                            @if (!empty($data->linkToCekBarang->linkToReturnPembelian))
                                                value="{{ $data->linkToCekBarang->linkToReturnPembelian->ongkir_return }}"
                                            @endif  
                                        required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped"  style="width: 100%; margin-bottom: 10px; overflow-y:scroll; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Satuan</th>
                                                <th>Diskon</th>
                                                <th>Jumlah Barang</th>
                                                <th>Alasan Return</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($data->linkToCekBarangDetail))
                                            @php($no=1)
                                                @foreach ($data->linkToCekBarangDetail->where('status_return','1') as $item)
                                                    <tr>
                                                        <th>{{ $no++ }}</th>
                                                        <th>{{ $item->linkToBarang->nm_barang }}</th>
                                                        <th>{{ number_format($item->hpp,2,',','.') }}</th>
                                                        <th>{{ $item->diskon }}</th>
                                                        <th>{{ $item->jumlah_beli }}</th>
                                                        <th>{{ $item->alasan_ditolak }}</th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">simpan</button>
                                    </div>
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