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
            Status Return Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Status Return Pembelian Barang Nomor Order : <font color="#FF00GG">{{ $data_order->no_order }}</font>, Supplier : <font color="#DE8F06">{{ $data_order->linkToSuppliers->nama_suplier }}</font>  </h3>
                      <h5 class="pull-right"><a href="{{ url('Pembelian')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            @if($data_order->respon_supplier == 0)
                            <form role="form" action="{{ url('cek-barang/'.$data_order->id) }}" method="post" >

                                        {{ csrf_field() }}
                                  <input type="hidden" name="_method" value="put">
                                 <div class="col-md-12">
                                @php($no=1)
                                @php($sub_total=0)

                                        <h4>Respon Status Return Barang dari Supplier</h4>


                                            <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                                <th>No.</th>
                                                <th style="width:140px;">Nama Barang</th>
                                                <th style="width:100px;">Harga Beli</th>
                                                <th style="width:70px;">Diskon(%)</th>
                                                <th style="width:40px;">Qty</th>
                                                <th style="width:100px;">Jumlah</th>
                                                <th>Qty sesuai</th>
                                                <th>Qty tidak sesuai</th>
                                                <th>Quality sesuai</th>
                                                <th>Quality tidak sesuai</th>
                                                <th>Keterangan</th>
                                                <th style="width:90px;">Respon</th>
                                                <th>Alasan</th>
                                                {{-- <th>Aksi</th> --}}
                                           </tr>
                                          @if(!empty($data_order->linkToCekBarangDetail))
                                              @foreach($data_order->linkToCekBarangDetail as $data_tb)

                                                @if($data_tb->jum_no_sesuai !==0 OR $data_tb->jum_kualitas_no_sesuai !==0)

                                                    <tr>
                                                        <td>{{ $no++ }}</td>

                                                        <td>
                                                          {{  $data_tb->linkToBarang->nm_barang }},   {{  $data_tb->linkToBarang->linkToSatuan->satuan }}
                                                          <input type="hidden" name="id_barang[]" value="{{ $data_tb->id_barang}}">
                                                        </td>
                                                        <td>{{ rupiahView($data_tb->harga_beli) }}
                                                          <input type="hidden" name="harga_beli[]" value="{{ $data_tb->harga_beli}}">
                                                        </td>
                                                        <td>
                                                            {{ $data_tb->diskon_item }}
                                                            <input type="hidden" name="diskon_item[]" value="{{ $data_tb->diskon_item}}">
                                                        </td>
                                                        <td>
                                                            {{ $data_tb->jumlah_beli }}
                                                              <input type="hidden" name="jumlah_beli[]" value="{{ $data_tb->jumlah_beli}}">
                                                        </td>
                                                        <td>

                                                            {{ rupiahView($data_tb->jumlah_harga) }}
                                                              <input type="hidden" name="jumlah_harga[]" value="{{ $data_tb->jumlah_harga }}">
                                                        </td>
                                                        <td>
                                                            {{ $data_tb->jum_sesuai }}
                                                              <input type="hidden" name="jum_sesuai[]" value="{{ $data_tb->jum_sesuai}}">
                                                        </td>
                                                        <td>
                                                           {{ $data_tb->jum_no_sesuai }}
                                                            <input type="hidden" name="jum_no_sesuai[]" value="{{ $data_tb->jum_no_sesuai}}">
                                                        </td>
                                                        <td>
                                                            {{ $data_tb->jum_kualitas_sesuai }}
                                                              <input type="hidden" name="jum_kualitas_sesuai[]" value="{{ $data_tb->jum_kualitas_sesuai}}">
                                                        </td>
                                                        <td>
                                                            {{ $data_tb->jum_kualitas_no_sesuai }}
                                                              <input type="hidden" name="jum_kualitas_no_sesuai[]" value="{{ $data_tb->jum_kualitas_no_sesuai}}">
                                                        </td>
                                                        <td>
                                                            {{ $data_tb->ket }}
                                                            <input type="hidden" name="ket[]" value="{{ $data_tb->ket}}">

                                                        </td>

                                                          @if(empty($data_tb->status_return))
                                                          <td>
                                                                   <select class="form-control" name="respon[]" required>
                                                                      @foreach ($respon as $key=> $item)
                                                                          <option value="{{ $key }}">{{ $item }}</option>
                                                                      @endforeach
                                                                  </select>
                                                          </td>
                                                          @else
                                                            <td>

                                                              @if($data_tb->status_return_return =0)
                                                                Diterima
                                                              @else
                                                                Ditolak
                                                              @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                          @if(empty($data_tb->alasan_ditolak ))
                                                            <textarea class="form-control" name='alasan[]'>{{ $data_tb->alasan_ditolak}}</textarea>

                                                            <p></p>
                                                          @else
                                                          {{ $data_tb->alasan_ditolak}}
                                                          @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                          @endif

                                               </table>
                                               @if(empty($data_tb->status_return))
                                               <div class="form-group">
                                                  <button type="submit" class="btn btn-primary"> Simpan </button>
                                               </div>
                                               @else
                                               <div class="form-group">
                                                  <button disabled type="submit" class="btn btn-primary"> Simpan </button>
                                               </div>
                                              @endif
                                </div>
                            </form>
                            @else
                                <div class="box-header with-border">
                                    <h5 class="box-title">
                                      Status respon supplier terhadap claim barang sudah selesai dilakukan..! </h5>
                                </div>
                            @endif
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
