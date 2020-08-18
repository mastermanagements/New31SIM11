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
                Barang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Barang</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-barang/'.$data_barang->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ketegori Barang</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_kategori" required>
                                        @if(empty($kategori_jasa))
                                            <option>Kategori Jasa Masih Kosong</option>
                                        @else
                                            @foreach($kategori_jasa as $value)
                                                <option value="{{ $value->id }}" @if($data_barang->id==$value->id) selected @endif >{{ $value->nm_kategori_p }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Ketegori Jasa</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_subkategori_produk" required>
                                        <option value="0">Kategori Belum dipilih</option>
                                    </select>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Sub Ketegori Barang</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_subsubkategori_produk" required>
                                        <option value="0">Sub Kategori Belum dipilih</option>
                                    </select>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode barang</label>
                                    <input type="text" name="kd_barang" class="form-control" placeholder="nama barang" value="{{ $data_barang->nm_barang }}" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Barcode</label>
                                    <input type="text" name="barcode" class="form-control" placeholder="Barcode"  value="{{ $data_barang->barcode }}" required/>
                                    {{--<small style="color: red">* Tidak Boleh Kosong</small>--}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <input type="text" name="nm_barang" class="form-control" placeholder="nama barang" value="{{ $data_barang->nm_barang }}" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <select class="form-control select2" style="width: 100%;" name="id_satuan" required>
                                    <option >Pilih Satuan </option>
                                    @foreach($satuan as $data)
                                        <option value="{{ $data->id }}">{{ $data->satuan_brg }}</option>
                                    @endforeach
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>                                <div class="form-group">
                                    <label for="exampleInputEmail1">Speksifikasi Barang</label>
                                    <textarea name="spec_barang" class="form-control" required>{!!  $data_barang->spec_barang !!} </textarea>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi Barang</label>
                                    <textarea name="desc_barang" class="form-control" required>{!!  $data_barang->desc_barang !!} </textarea>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Expired</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" value=" @if($data_barang->expired_date != '1970-01-01'){{  date('d-m-Y', strtotime($data_barang->expired_date)) }} @endif" placeholder="Tanggal Barang Expired" name="expired_date" >
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Rak</label>
                                    <input type="number" min="0" name="no_rak" class="form-control" placeholder="Nomor Rak" value="{{ $data_barang->no_rak }}" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok Awal</label>
                                    <input type="number" min="0" name="stok_awal" class="form-control"  value="{{ $data_barang->stok_awal }}" placeholder="Stok Awal" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok Minimum</label>
                                    <input type="number" min="0" name="stok_minimum" class="form-control" value="{{ $data_barang->stok_minimum }}" placeholder="Stok Awal" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hpp (Harga Pokok Penjualan)</label>
                                    <input type="number" min="0" name="hpp" value="{{ $data_barang->hpp }}" class="form-control" placeholder="Harga Pokok Penjualan"/>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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

        window.onload = function() {
            CKEDITOR.replace( 'spec_barang',{
                height: 200
            } );
            CKEDITOR.replace( 'desc_barang',{
                height: 200
            } );
        };

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
        //        $('#datepicker1').datepicker({
        //            autoclose: true,
        //            format: 'dd-mm-yyyy'
        //        });

        $(function () {
            $('.select2').select2()
        });
    </script>
    @include('user.produksi.section.barang.JS.JS')
@stop