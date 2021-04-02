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
           Detail Barang Penawaran Penjualan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Barang Penawaran Penjualan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">


                          <div class="row">
                              <form role="form" action="{{ url('detail-barang-Tpenjualan') }}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id_tawar_jual" value="{{ $id_tawar_jual }}">
                                            <div class="form-group">
                                                <label for="id_barang">Barang</label>
                                                <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                                    <option disabled>Pilih Barang</option>
                                                    @if(!empty($barang))
                                                        @foreach($barang as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nm_barang }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jumlah Barang</label>
                                                <input type="number" class="form-control" name="jumlah_barang" value="0" required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Harga Satuan</label>
                                                <input type="number" class="form-control" name="hpp" value="0" required>
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                            <div class="form-group">
                                                <label>Diskon</label>
                                                <input type="number" class="form-control" name="diskon" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="total">Total</label>
                                                <input class="form-control" name="total" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control" name="keterangan"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Tambah barang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>

                              <div class="col-md-12">
                                  <hr>
                                  @if(!empty($data_jual->linkToDetailTawarBeli))
                                      @php($no=1)
                                      <h5>Data Barang Penawaran</h5>
                                        <table style="width: 100%;">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga satuan</th>
                                                <th>Jumlah barang</th>
                                                <th>Diskon</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                          @foreach($data_jual->linkToDetailTawarBeli as $item)
                                              <form action="{{ url('detail-barang-Tpenjualan/'. $item->id) }}" method="post">

                                                <tr>
                                                    <th>@method('put') {{ csrf_field() }} {{ $no++ }}</th>
                                                    <th>
                                                        @if(!empty($barang))
                                                            <select class="form-control select2" style="width: 100%;" name="id_barang" required>
                                                            @foreach($barang as $data)
                                                                <option value="{{ $data->id }}" @if($item->linkToBarang->id==$item->id_barang) selected @endif>{{ $data->nm_barang }}</option>
                                                            @endforeach
                                                            </select>
                                                        @endif
                                                    </th>
                                                    <th><input type="number" name="n_hpp" class="form-control" value="{{ $item->hpp }}"></th>
                                                    <th><input type="number" name="n_jumlah_barang" class="form-control" value="{{ $item->jumlah_barang }}"></th>
                                                    <th><input type="number" name="n_diskon" class="form-control" value="{{ $item->diskon }}"></th>
                                                    <th><input type="number" name="n_total" class="form-control" value="{{ $item->total_tj }}" readonly></th>
                                                    <th>
                                                        <button type="submit" class="btn btn-warning">ubah</button>
                                                        <a href="{{ url('detail-barang-Tpenjualan/'.$item->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus barang ini...?')">hapus</a>
                                                    </th>
                                                </tr>
                                              </form>
                                          @endforeach
                                        </table>
                                  @endif
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

                $('[name="jumlah_barang"]').keyup(function () {
                    hitung_total();
                })

                $('[name="hpp"]').keyup(function () {
                    hitung_total();
                })

                $('[name="diskon"]').keyup(function () {
                    hitung_total();
                })

                hitung_total = function () {
                    var diskon = $('[name="diskon"]').val()
                    var total_sebdis=0;
                    total_sebdis = $('[name="jumlah_barang"]').val() * $('[name="hpp"]').val();
                    if(diskon != 0){
                        var setelah_diskon = (total_sebdis * (diskon/100));
                        total_sebdis = total_sebdis - setelah_diskon;
                    }
                    $('[name="total"]').val(total_sebdis);
                }

    </script>

@stop
