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
            Barang Penawaran Pembelian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Barang Promosi</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                           <div class="col-md-12" style="margin-top:10px">
                               <form role="form" action="{{ url('tambah-pembelian-penawaran-barang/'.$data->id) }}" method="post" >
                                   {{ csrf_field() }}
                                   <table style="width: 100%; margin-bottom: 10px">
                                       <tr>
                                           <td>Nama Barang</td>
                                           <td>Harga Lama</td>
                                           <td>Harga Baru</td>
                                           <td>Jumlah Beli</td>
                                       </tr>
                                       <tr>
                                           <td>
                                               @if(!empty($barang))
                                               <select class="form-control select2" name="id_barang" style="width: 100%" onclick="" required>
                                                       @foreach($barang as $datas)
                                                            <option value="{{ $datas->id }}">{{ $datas->nm_barang }}</option>
                                                       @endforeach
                                               </select>
                                               @endif
                                           </td>
                                           <td>
                                               <input type="text" class="form-control" name="harga_lama" value="0" disabled required>
                                           </td>
                                           <td>
                                               <input type="text" class="form-control" name="harga_baru" placeholder="harga_baru"  required>
                                           </td>
                                           <td>
                                               <input type="number" class="form-control" name="jumlah_beli"  required>
                                           </td>
                                       </tr>
                                   </table>
                                   <div class="form-group">
                                       <button class="btn btn-primary">Simpan</button>
                                   </div>
                               </form>
                           </div>
                            <div class="col-md-12">
                                @if(!empty($data))
                                    <h4>detail barang penawaran</h4>
                                    {{ csrf_field() }}
                                        <table style="width: 100%; margin-bottom: 10px">
                                        <tr>
                                            <td>No.</td>
                                            <td>Nama Barang</td>
                                            <td>Harga Lama</td>
                                            <td>Harga Baru</td>
                                            <td>Jumlah Beli</td>
                                            <td>Aksi</td>
                                        </tr>
                                            @php($no=1)
                                            @foreach($data->linkToDetail as $data_tb)
                                                <tr>
                                                    <form role="form" action="{{ url('ubah-pembelian-penawaran-barang/'.$data_tb->id) }}" method="post" >

                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        @if(!empty($barang))
                                                            <select class="form-control select2" name="id_barang" style="width: 100%" required>
                                                                @foreach($barang as $datas)
                                                                    <option value="{{ $datas->id }}" @if($datas->id==$data_tb->id_barang) selected @endif>{{ $datas->nm_barang }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="harga_lama" value="0" disabled required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="harga_baru" value="{{ $data_tb->hpp_baru }}"  required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="jumlah_beli" value="{{$data_tb->jumlah_beli}}"  required>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-warning"> ubah </button>
                                                        <a href="{{ url('hapus-pembelian-penawaran-barang/'.$data_tb->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus </a>
                                                   </td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                    </table>
                                @endif


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