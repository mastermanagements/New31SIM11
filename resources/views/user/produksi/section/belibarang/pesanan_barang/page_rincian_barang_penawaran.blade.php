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
                            <form role="form" action="{{ url('pesanan-pembelian') }}" method="post" >
                           <div class="col-md-12" style="margin-top:10px">
                               
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                       <label>No. PO</label>
                                       <input type="text" name="no_po" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal. PO</label>
                                       <input type="date" name="tgl_po" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Penawaran Pembelian</label>
                                       <select class="form-control select2" name="id_tawar_beli" style="width: 100%" onchange="if(confirm('Apakah anda akan mengambil data barang penawaran dari kode surat ini ... ?')){ return window.location.href='{{ url('rincian-penawaran') }}/'+$(this).val() }else{ alert('Data Barang tidak dapat diambil') }">
                                           @if(!empty($penawaran_pembelian))
                                               <option value="0">Pilihan Penawaran pembelian</option>
                                               @foreach($penawaran_pembelian as $data)
                                                     <option @if($barang_penawaran->id==$data->id) selected @endif value="{{ $data->id }}">{{ $data->no_tawar }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Supplier</label>
                                       <select class="form-control select2" name="id_supplier"  required style="width: 100%">
                                           @if(!empty($supplier))
                                               <option>Pilihan supplier</option>
                                               @foreach($supplier as $data)
                                                     <option @if($barang_penawaran->id_supplier == $data->id) selected @endif value="{{ $data->id }}">{{ $data->nama_suplier }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal Dikirim</label>
                                       <input type="date" name="tgl_dikirim" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <button class="btn btn-primary">Simpan</button>
                                   </div>
                                   {{--<div class="row">--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Diskon Tambahan</label>--}}
                                               {{--<input type="number" name="diskon_tambahan" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Pajak</label>--}}
                                               {{--<input type="number" name="pajak" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                                   {{--<div class="row">--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Uang Muka</label>--}}
                                               {{--<input type="number" name="uang_muka" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Kurang Bayar</label>--}}
                                               {{--<input type="number" name="kurang_bayar" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}

                              
                           </div>
                            <div class="col-md-12">
                                @if(!empty($barang_penawaran))
                                <h4>detail barang penawaran</h4>
                                {{ csrf_field() }}
                                    <table style="width: 100%; margin-bottom: 10px">
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama Barang</td>
                                        <td>Jumlah Beli</td>
                                        <td>Diskon</td>
                                        <td>Harga Beli</td>
                                        <td>Jumlah</td>
                                    </tr>
                                        @php($no=1)
                                        @foreach($barang_penawaran->linkToDetail as $data_tb)
                                            <tr>
                                            
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_barang[]" value="{{ $data_tb->linkToBarang->id }}">
                                                      {{  $data_tb->linkToBarang->nm_barang }}
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="jumlah_beli[]" value="{{$data_tb->jumlah_beli}}" readonly required>
                                                </td>
                                             
                                                <td>
                                                    <input type="text" class="form-control" name="diskon[]" value="0" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="hpp[]" value="{{ $data_tb->hpp_baru }}" readonly required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="jumlah[]" value="{{ $data_tb->jumlah_beli*$data_tb->hpp_baru }}" readonly required>
                                                </td>
                                               {{-- <td>
                                                    <button type="submit" class="btn btn-warning"> ubah </button>
                                                    <a href="{{ url('hapus-pembelian-penawaran-barang/'.$data_tb->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus </a>
                                               </td> --}}
                                           
                                            </tr>
                                        @endforeach
                                </table>
                            
                                 @endif
                                </div>
                            </form>
                            @if(!empty($barang_penawaran->linkToPpO))
                            <div class="col-md-12">
                                <form action="{{ url('ubah-pesanan-pembelian/'.$barang_penawaran->linkToPpO->id) }}" method="post">
                                    {{ csrf_field() }}
                                       <div class="col-md-12">
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Diskon Tambahan</label>
                                                       <input type="number" name="diskon_tambahan" value="{{  $barang_penawaran->linkToPpO->diskon_tambahan }}" class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Pajak</label>
                                                       <input type="number" name="pajak" value="{{ $barang_penawaran->linkToPpO->diskon_tambahan }}" class="form-control" required>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Uang Muka</label>
                                                       <input type="number" name="uang_muka" value="{{ $barang_penawaran->linkToPpO->uang_muka  }}" class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Kurang Bayar</label>
                                                       <input type="number" name="kurang_bayar" value="{{ $barang_penawaran->linkToPpO->kurang_bayar }}" class="form-control" required>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <button  class="btn btn-primary pull-left"> Simpan Pesanan pembelian </button>
                                       </div>
                                </form>
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