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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Barang</h3>
                        <h5 class="pull-right"><a href="{{ url('Barang')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-barang') }}" method="post" enctype="multipart/form-data">
                      <div class="box-body">

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Barcode</label>
                                  <input type="text" name="barcode" class="form-control" placeholder="Barcode"/>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Kode Barang</label>
                                  <input type="text" name="kd_barang" class="form-control" placeholder="Kode Barang"/>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Barang</label>&nbsp;<strong style="color: red">*</strong>
                                  <input type="text" name="nm_barang" class="form-control" placeholder="nama barang" required/>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Satuan</label>&nbsp;<strong style="color: red">*</strong>
                                  <select class="form-control select2" style="width: 100%;" name="id_satuan" required>
                                      <option >Pilih Satuan </option>
                                      @foreach($satuan as $data)
                                       <option value="{{ $data->id }}">{{ $data->satuan }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="exampleInputEmail1">Spesifikasi Barang</label>
                                 <input type="text" name="spec_barang" class="form-control" placeholder="Spesifikasi barang">
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">Merk Barang</label>
                                 <input type="text" name="merk_barang" class="form-control" placeholder="Merk barang">
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">Deskripsi Barang</label>
                                 <textarea name="desc_barang" class="form-control" ></textarea>
                             </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">No Rak/Gudang</label>
                                  <input type="number" min="0" name="no_rak" class="form-control" placeholder="Nomor Rak"/>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Stok Minimum</label>
                                  <input type="number" min="0" name="stok_minimum" class="form-control" placeholder="Stok Minimal" value="0" required/>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Hpp (Harga Pokok Penjualan)</label>&nbsp;<strong style="color: red">*</strong>
                                  <input type="text" name="hpp" id="rupiah2" class="form-control" placeholder="Harga Pokok Penjualan" required/>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Metode Penjualan</label>
                                  <select class="form-control select2" style="width: 100%;" name="metode_jual" required>
                                      @foreach($metode_jual as $key=> $data)
                                          <option value="{{ $key }}">{{ $data }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Jenis Barang</label>
                                  <select class="form-control select2" style="width: 100%;" name="jenis_barang" required>
                                      @foreach($jenis_barang as $key=> $data)
                                          <option value="{{ $key }}">{{ $data }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Kategori Barang</label>&nbsp;<strong style="color: red">*</strong>
                                  <select class="form-control select2" style="width: 100%;" name="id_kategori" required>
                                      @if(empty($kategori_produk))
                                          <option>Kategori Produk Masih Kosong</option>
                                      @else
                                          <option>Pilih Kategori Barang</option>
                                          @foreach($kategori_produk as $value)
                                              <option value="{{ $value->id }}">{{ $value->nm_kategori_p }}</option>
                                          @endforeach
                                      @endif
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Sub Kategori Barang</label>&nbsp;<strong style="color: red">*</strong>

                                  <select class="form-control select2" style="width: 100%;" name="id_subkategori_produk" required>
                                      <option value="0">Kategori Belum dipilih</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Sub Sub Kategori Barang</label>&nbsp;<strong style="color: red">*</strong>
                                  <select class="form-control select2" style="width: 100%;" name="id_subsubkategori_produk" required>
                                      <option value="0">Sub Kategori Belum dipilih</option>
                                  </select>
                              </div>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
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
    @include('user.produksi.section.barang.JS.JS')
    @include('user.global.rupiah_input2')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
            CKEDITOR.replace( 'desc_barang',{
                height: 100
            } );
        };


        $(function () {
            $('.select2').select2()
        });


    </script>

@stop
