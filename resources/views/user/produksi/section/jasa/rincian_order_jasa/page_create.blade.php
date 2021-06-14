@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Rincian Order Jasa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Rincian Order Jasa</h3>
                         <h5 class="pull-right"><a href="{{ url('Order-Jasa')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <div class="row">
                              <form role="form" action="{{ url('tambah-rincian-orderjasa/'.$order_jasa->id) }}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="id_barang">Layanan</label>
                                              <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                                                  <option disabled>Pilih Layanan</option>
                                                  @if(!empty($jasa))
                                                      @foreach($jasa as $data)
                                                          <option value="{{ $data->id }}">{{ $data->nm_layanan }}</option>
                                                      @endforeach
                                                  @endif
                                              </select>
                                              <small style="color: red">* Tidak Boleh Kosong</small>
                                          </div>
                                          @if ($order_jasa->getPerusahaan->jenis_jasa == '1')
                                            <div class="form-group">
                                                <label for="id_barang">Barang</label>
                                                <select class="form-control select2" style="width: 100%;" name="id_barang">
                                                    <option disabled>Pilih Barang</option>
                                                    @if(!empty($barang))
                                                        <option value="0">Pilih Barang</option>
                                                        @foreach($barang as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nm_barang }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                           @endif
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jumlah Order</label>
                                                <input type="number" class="form-control" name="qty" value="0" required>
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Biaya Layanan</label>
                                                <input type="number" class="form-control" name="biaya" value="0" required>
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Diskon(%)</label>
                                              <input type="number" class="form-control" name="diskon" value="0">
                                          </div>
                                          <div class="form-group">
                                              <label for="keterangan">Keterangan</label>
                                              <textarea class="form-control" name="ket"></textarea>
                                          </div>
                                          <div class="form-group">
                                              <label for="total">Total</label>
                                              <input class="form-control" name="total_biaya" readonly>
                                          </div>
                                          <div class="form-group" align="right">
                                              <button  type="submit" class="btn btn-primary">Tambah</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                </form>

                            <!---edit rincian order jasa-->
                            <div class="col-md-12">
                                <hr>
                                @if(!empty($order_jasa->getDetailOrderJasa))
                                    @php($no=1)
                                    <h5><b>Data Rincian Order Jasa</b></h5>
                                      <table style="width: 100%;">
                                          <tr>
                                              <th>No</th>
                                              <th>Nama Layanan</th>
                                              @if ($order_jasa->getPerusahaan->jenis_jasa == '1')
                                                <th>Nama Barang</th>
                                              @endif
                                              <th>Jumlah Order</th>
                                              <th>Biaya Satuan</th>
                                              <th>Diskon(%)</th>
                                              <th>Sub total</th>
                                              <th>Keterangan</th>
                                              <th>Aksi</th>
                                          </tr>
                                        @foreach($order_jasa->getDetailOrderJasa as $item)
                                            <form action="{{ url('ubah-detail-orderjasa/'. $item->id) }}" method="post">
                                                  {{ csrf_field() }}
                                              <tr>
                                                <input type="hidden" name="_method" value="put">
                                                  <td> {{ $no++ }}</td>
                                                  <td>
                                                      @if(!empty($jasa))
                                                          <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                                                          @foreach($jasa as $data)
                                                              <option value="{{ $data->id }}" @if($data->id==$item->id_jasa) selected @endif>{{ $data->nm_layanan }}</option>
                                                          @endforeach
                                                          </select>
                                                      @endif
                                                  </td>
                                                  @if ($order_jasa->getPerusahaan->jenis_jasa == '1')
                                                  <td>
                                                      <select class="form-control select2" style="width: 100%;" name="id_barang">

                                                            @foreach($barang as $data)
                                                              <option value="{{ $data->id }}" @if($item->getBarang->id==$item->id_barang) selected @endif>{{ $data->nm_barang }}</option>
                                                            @endforeach
                                                          </select>

                                                  </td>
                                                  @endif
                                                    <td><input type="number" name="qty" class="form-control" value="{{ $item->qty }}"></td>
                                                    <td><input type="number" name="biaya" class="form-control" value="{{ $item->biaya }}"></td>
                                                      <td><input type="number" name="diskon" class="form-control" value="{{ $item->diskon }}"></td>
                                                  <td><input type="number" name="total_biaya" class="form-control" value="{{ $item->total_biaya }}" readonly></td>
                                                  <td><textarea name="ket">{{ $item->ket }}</textarea></td>
                                                  @if($item->status_service == 0)
                                                  <td><button type="submit" class="btn btn-warning">ubah</button></td>
                                                  <td><a href="#" onclick="if(confirm('Apakah anda yakin akan menghapus data  ini .. ?')){ window.location.href='{{  url('hapus-detail-orderjasa/'.$item->id) }}'  }else { alert('proses hapus dihentikan')} " class="btn btn-danger">hapus</a></td>
                                                  @else
                                                  <td><button  class="btn btn-warning" disabled>ubah</button></td>
                                                  <td><a class="btn btn-danger" disabled>hapus</a></td>
                                                  @endif
                                                  <td>
                                                    <input type="checkbox" name="status_service" onchange="ubahStatusService({{ $item->id }})" @if($item->status_service==1) checked value="1" @endif data-toggle="toggle" data-size="mini" data-width="100" data-on="Sedang diproses" data-off="Belum diproses">
                                                  </td>

                                              </tr>

                                            </form>
                                        @endforeach
                                        <tr>

                                            <th colspan="4"></th>
                                            <th>Total</th>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $grand_total }}</b></td>
                                        </tr>
                                        <form action="{{ url('tambah-dp-orderjasa/'. $order_jasa->id) }}" method="post">
                                              {{ csrf_field() }}
                                          <tr>
                                            <input type="hidden" name="_method" value="put">
                                            <th colspan="4"></th>
                                            <th>Uang Muka</th>
                                            <td><input type="number" name="uang_muka" class="form-control" value="{{ $order_jasa->uang_muka }}"></td>
                                            <td>
                                                &nbsp;&nbsp;<button type="submit" class="btn btn-primary">Tambah</button>
                                            </td>
                                          </tr>
                                        </form>
                                          <tr>
                                            <th colspan="4"></th>
                                            <th>Sisa Bayar</th>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $grand_total - $order_jasa->uang_muka }}</b></td>
                                          </tr>

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

    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>

                $('[name="qty"]').keyup(function () {
                    hitung_total();
                })

                $('[name="biaya"]').keyup(function () {
                    hitung_total();
                })

                $('[name="diskon"]').keyup(function () {
                    hitung_total();
                })

                hitung_total = function () {
                    var diskon = $('[name="diskon"]').val()
                    var total_sebdis=0;
                    total_sebdis = $('[name="qty"]').val() * $('[name="biaya"]').val();
                    if(diskon != 0){
                        var setelah_diskon = (total_sebdis * (diskon/100));
                        total_sebdis = total_sebdis - setelah_diskon;
                    }
                    $('[name="total_biaya"]').val(total_sebdis);
                }



                    //iCheck for checkbox and radio inputs
                    $('input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass   : 'iradio_minimal-blue'
                    })

                    $(document).ready(function () {


                        ubahStatusService= function (id) {
                            $.ajax({
                                url : "{{ url('ubah-status-service') }}/"+id,
                                type : 'post',
                                data : {
                                    'id': id,
                                    '_method': 'put',
                                    '_token' : '{{ csrf_token() }}'
                                },
                                success :function (result) {
                                    alert(result.message);
                                }
                            })
                        }
                   });



    </script>

@stop
