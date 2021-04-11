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
                            <h3 class="box-title">Formulir Edit Barang</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-barang/'.$data_barang->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori Barang</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_kategori" required>
                                        @if(empty($kategori_produk))
                                            <option>Kategori Produk Masih Kosong</option>
                                        @else
                                            @foreach($kategori_produk as $value)
                                                <option value="{{ $value->id }}" @if($data_barang->id==$value->id) selected @endif >{{ $value->nm_kategori_p }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Kategori Barang</label>
                                      <select class="form-control select2" style="width: 100%;" name="id_subkategori_produk" required>
                                          @foreach($subkategori_produk as $value)
                                              <option value="{{ $value->id }}" @if($data_barang->id == $value->id) selected @endif>{{ $value->nm_subkategori_produk }}</option>
                                          @endforeach
                                      </select>
                                      <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Sub Kategori Barang</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_subsubkategori_produk" required>
                                      @foreach($subsubkategori_produk as $value)
                                          <option value="{{ $value->id }}" @if($data_barang->id == $value->id) selected @endif>{{ $value->nm_subsub_kategori_produk }}</option>
                                      @endforeach
                                    </select>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode barang</label>
                                    <input type="text" name="kd_barang" class="form-control" placeholder="nama barang" value="{{ $data_barang->kd_barang }}"/>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Barcode</label>
                                    <input type="text" name="barcode" class="form-control" placeholder="Barcode"  value="{{ $data_barang->barcode }}"/>
                                      <small style="color: orange">* Isi Jika Perlu</small>
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <input type="text" name="nm_barang" class="form-control" placeholder="nama barang" value="{{ $data_barang->nm_barang }}" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <select class="form-control select2" style="width: 100%;" name="id_satuan" required>
                                    <option >Pilih Satuan </option>
                                    @foreach($satuan as $data)
                                        <option value="{{ $data->id }}" @if($data->id ==$data_barang->id_satuan ) selected @endif>{{ $data->satuan }}</option>
                                    @endforeach
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Spesifikasi Barang</label>
                                    <input type="text" name="spec_barang" class="form-control" value="{{ $data_barang->spec_barang }}"/>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Merk Barang</label>
                                    <input type="text" name="merk_barang" class="form-control" value="{{ $data_barang->merk_barang }}"/>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi Barang</label>
                                    <textarea name="desc_barang" class="form-control">{!!  $data_barang->desc_barang !!} </textarea>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Rak</label>
                                    <input type="number" min="0" name="no_rak" class="form-control" placeholder="Nomor Rak" value="{{ $data_barang->no_rak }}"/>
                                    <small style="color: orange">* Isi Jika Perlu</small>
                                </div>
                              <div class="form-group">
                                    <label for="exampleInputEmail1">Stok Minimum</label>
                                    <input type="number" min="0" name="stok_minimum" class="form-control" value="{{ $data_barang->stok_minimum }}" placeholder="Stok Awal" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hpp (Harga Pokok Penjualan)</label>
                                    <input type="text" min="0" name="hpp" id="rupiah" value="{{ rupiahView($data_barang->hpp) }}" class="form-control" placeholder="Harga Pokok Penjualan" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Metode Penjualan</label>
                                    <select class="form-control select2" style="width: 100%;" name="metode_jual" required>
                                        @foreach($metode_jual as $key=> $data)
                                            <option value="{{ $key }}" @if($data_barang=='0') selected @endif>{{ $data }}</option>
                                        @endforeach
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gambar Barang</label>
                                    <input type="file"  name="gambar" class="form-control" placeholder="Gambar" />
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

            CKEDITOR.replace( 'desc_barang',{
                height: 100
            } );
        };


        $(function () {
            $('.select2').select2()
        });
    </script>
    @include('user.produksi.section.barang.JS.JS')
    @include('user.global.rupiah_input')
@stop
