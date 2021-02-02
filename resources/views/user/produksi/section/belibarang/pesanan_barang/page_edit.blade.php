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
                Pesanan Pembelian
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pesanan Pembelian</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="col-md-12" style="margin-top:10px">
                                <form role="form" action="{{ url('pesanan-pembelian') }}" method="post" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>No. PO</label>
                                        <input type="text" name="no_po" class="form-control" value="{{ $data->no_po }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal. PO</label>
                                        <input type="date" name="tgl_po" class="form-control"  value="{{ $data->tgl_po }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Penawaran Pembelian</label>
                                        <select class="form-control select2" name="id_tawar_beli" style="width: 100%">
                                            @if(!empty($penawaran_pembelian))
                                                <option value="0" @if($data->id_tawar_beli==0) selected @endif>Pilihan Penawaran pembelian</option>
                                                @foreach($penawaran_pembelian as $data_penawaran)
                                                    <option value="{{ $data_penawaran->id }}" @if($data->id_tawar_beli==$data_penawaran->id) selected @endif>{{ $data_penawaran->no_tawar }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control select2" name="id_supplier"  required style="width: 100%">
                                            @if(!empty($supplier))
                                                <option>Pilihan supplier</option>
                                                @foreach($supplier as $data_supplier)
                                                    <option value="{{ $data->id }}" @if($data->id_supplier==$data_supplier->id) selected @endif>{{ $data_supplier->nama_suplier }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Dikirim</label>
                                        <input type="date" name="tgl_dikirim" class="form-control" value="{{ $data->tgl_krm }}" required>
                                    </div>
                                    {{--<div class="form-group">--}}
                                        {{--<button class="btn btn-primary">Simpan</button>--}}
                                    {{--</div>--}}


                                </form>
                            </div>
                            <div class="col-md-12">
                                <form role="form" action="{{ url('tambah-barang-pembelian/'.$data->id) }}" method="post" >
                                <div class="col-md-12 row" style="margin-top:10px">

                                        {{ csrf_field() }}
                                        <table style="width: 100%; margin-bottom: 10px">
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td>Harga Beli</td>
                                                <td>Diskon</td>
                                                <td>Banyak</td>
                                                <td>Jumlah</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if(!empty($barang))
                                                        <select class="form-control select2" name="id_barang" style="width: 100%" required>
                                                            @foreach($barang as $datas)
                                                                <option value="{{ $datas->id }}">{{ $datas->nm_barang }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" class="form-control" name="id_po" value="{{ $data->id }}"  required>
                                                    <input type="text" class="form-control" name="hpp" value="0"  required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="diskon" placeholder="diskon"  required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="jumlah_beli"  required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="jumlah" disabled required>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Tambah barang</button>
                                        </div>       
                                </form>
                                @if(!empty($data->linkToDetailPO))
                                        <h3>Daftar Pesanan Pembelian </h3>

                                            <table style="width: 100%; margin-bottom: 10px">
                                                <tr>
                                                    <td>Nama Barang</td>
                                                    <td>Harga Beli</td>
                                                    <td>Diskon</td>
                                                    <td>Banyak</td>
                                                    <td>Jumlah</td>
                                                    <td>Aksi</td>
                                                </tr>
                                                @foreach($data->linkToDetailPO as $data_pesanan)
                                                <tr>
                                                    <form action="{{ url('ubah-barang-pembelian/'.$data_pesanan->id) }}" method="post">

                                                    <td>
                                                        {{ csrf_field() }}
                                                        @if(!empty($barang))
                                                            <select class="form-control select2" name="id_barang" style="width: 100%" required>
                                                                @foreach($barang as $datas)
                                                                    <option value="{{ $datas->id }}" @if($data_pesanan->id_barang==$datas->id) selected @endif>{{ $datas->nm_barang }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td width="100">
                                                        <input type="text" class="form-control" name="hpp" value="{{ $data_pesanan->hpp }}"  required>
                                                    </td>
                                                    <td width="100">
                                                        <input type="text" class="form-control" name="diskon" placeholder="diskon" value="{{ $data_pesanan->diskon_item }}" required>
                                                    </td>
                                                    <td width="100">
                                                        <input type="number" class="form-control" name="jumlah_beli" value="{{ $data_pesanan->jumlah_beli }}"  required>
                                                    </td>
                                                    <td width="100">
                                                        <input type="number" class="form-control" name="jumlah" disabled value="{{ $data_pesanan->jumlah_harga }}" required>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                        <a href="{{ url('hapus-barang-pembelian/'.$data_pesanan->id) }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                                                    </td>
                                                    </form>
                                                </tr>
                                                @endforeach
                                            </table>

                                    @endif

                                </div>

                                </div>
                                <form action="{{ url('ubah-pesanan-pembelian/'.$data->id) }}" method="post">
                                    {{ csrf_field() }}
                                       <div class="col-md-12">
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Diskon Tambahan</label>
                                                       <input type="number" name="diskon_tambahan" @if(!empty($data->diskon_tambahan)) value="{{ $data->diskon_tambahan }}" @endif class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Pajak</label>
                                                       <input type="number" name="pajak" class="form-control" @if(!empty($data->pajak)) value="{{ $data->pajak }}" @endif required>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Uang Muka</label>
                                                       <input type="number" name="uang_muka" class="form-control" @if(!empty($data->dp_po)) value="{{ $data->dp_po }}" @endif required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Kurang Bayar</label>
                                                       <input type="number" name="kurang_bayar" class="form-control" @if(!empty($data->kurang_bayar)) value="{{ $data->kurang_bayar }}" @endif required>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <button class="btn btn-primary pull-left"> Simpan Pesanan pembelian </button>
                                       </div>
                                </form>
                                {{--</form>--}}
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
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
    </script>

@stop