@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

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
                              <h5 class="pull-right"><a href="{{ url('Barang')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-barang/'.$data_barang->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Barcode</label>
                                      <input type="text" name="barcode" class="form-control" placeholder="Barcode"  value="{{ $data_barang->barcode }}"/>

                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Kode barang</label>
                                      <input type="text" name="kd_barang" class="form-control" placeholder="nama barang" value="{{ $data_barang->kd_barang }}"/>

                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Barang</label>&nbsp;<strong style="color: red">*</strong>
                                      <input type="text" name="nm_barang" class="form-control" placeholder="nama barang" value="{{ $data_barang->nm_barang }}" required/>

                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Satuan</label>&nbsp;<strong style="color: red">*</strong>
                                      <select class="form-control select2" style="width: 100%;" name="id_satuan" required>
                                         <option >Pilih Satuan </option>
                                         @foreach($satuan as $data)
                                          <option value="{{ $data->id }}" @if($data->id ==$data_barang->id_satuan ) selected @endif>{{ $data->satuan }}</option>
                                         @endforeach
                                      </select>

                                 </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Spesifikasi Barang</label>
                                    <input type="text" name="spec_barang" class="form-control" value="{{ $data_barang->spec_barang }}"/>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Merk Barang</label>
                                    <input type="text" name="merk_barang" class="form-control" value="{{ $data_barang->merk_barang }}"/>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi Barang</label>
                                    <textarea name="desc_barang" class="form-control">{!! $data_barang->desc_barang !!} </textarea>

                                </div>

                                
                              </div>
								
								<div class="col-md-3">
									<div class="form-group">
                                    <label for="exampleInputEmail1">No Rak</label>
                                    <input type="number" min="0" name="no_rak" class="form-control" placeholder="Nomor Rak" value="{{ $data_barang->no_rak }}"/>

									</div>
									<div class="form-group">
                                      <label for="exampleInputEmail1">Stok Minimum</label>&nbsp;<strong style="color: red">*</strong>
                                      <input type="number" min="0" name="stok_minimum" class="form-control" value="{{ $data_barang->stok_minimum }}" placeholder="Stok Awal" required/>

									</div>
									<div class="form-group">
                                      <label for="exampleInputEmail1">Hpp (Harga Pokok Penjualan)</label>&nbsp;<strong style="color: red">*</strong>
                                      <input type="text" min="0" name="hpp" id="rupiah2" value="{{ rupiahView($data_barang->hpp) }}" class="form-control" placeholder="Harga Pokok Penjualan" required/>

									</div>
                                 
                                  
                                </div>

								<div class="col-md-3">
									 <div class="form-group">
                                      <label for="exampleInputEmail1">Metode Penjualan</label>
                                      <select class="form-control select2" style="width: 100%;" name="metode_jual" required>
                                          @foreach($metode_jual as $key=> $data)
                                              <option value="{{ $key }}" @if($data_barang=='0') selected @endif>{{ $data }}</option>
                                          @endforeach
                                      </select>

                                  </div>
									<div class="form-group">
                                      <label for="exampleInputEmail1">Jenis Barang</label>
                                      <select class="form-control select2" style="width: 100%;" name="jenis_barang" required>
                                          @foreach($jenis_barang as $key=> $data)
                                              <option value="{{ $key }}" @if($data_barang=='0') selected @endif>{{ $data }}</option>
                                          @endforeach
                                      </select>

									</div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Kategori Barang</label>&nbsp;<strong style="color: red">*</strong>
                                    <select class="form-control select2" style="width: 100%;" name="id_kategori" required>
                                        @if(empty($kategori_produk))
                                            <option>Kategori Produk Masih Kosong</option>
                                        @else
                                            @foreach($kategori_produk as $value)
                                                <option value="{{ $value->id }}" @if($data_barang->id==$value->id) selected @endif >{{ $value->nm_kategori_p }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Kategori Barang</label>&nbsp;<strong style="color: red">*</strong>
                                      <select class="form-control select2" style="width: 100%;" name="id_subkategori_produk" required>
                                          @foreach($subkategori_produk as $value)
                                              <option value="{{ $value->id }}" @if($data_barang->id == $value->id) selected @endif>{{ $value->nm_subkategori_produk }}</option>
                                          @endforeach
                                      </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Sub Kategori Barang</label>&nbsp;<strong style="color: red">*</strong>
                                    <select class="form-control select2" style="width: 100%;" name="id_subsubkategori_produk" required>
                                      @foreach($subsubkategori_produk as $value)
                                          <option value="{{ $value->id }}" @if($data_barang->id == $value->id) selected @endif>{{ $value->nm_subsub_kategori_produk }}</option>
                                      @endforeach
                                    </select>

                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gambar Barang</label>
                                    <input type="file"  name="gambar" class="form-control" placeholder="Gambar" />

                                </div>
                            </div>
                              <div class="col-md-12">
                                  <div class="box-footer">
                                  <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                                  </div>
                                  <div class="box-footer">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="_method" value="put">
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                  </div>
                              </div>
                          </div>
                          <!-- /.box-body -->
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
    @include('user.global.rupiah_input2')
@stop
