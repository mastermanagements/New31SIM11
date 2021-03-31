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
            Daftar Rincian Promosi Jasa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Rincian Promosi Jasa</h3>
                        <h3 class="box-title"><a href="{{ url('Jasa') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Back to Jasa</a></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                           <div class="col-md-12">
                               <form role="form" action="{{ url('tambah-rincian-promo/'.$data->id) }}" method="post">
                                   {{ csrf_field() }}
                                   <table style="width: 100%; margin-bottom: 10px">
                                       <tr>
                                           <td>Nama Layanan</td>
                                           <td>Harga Satuan</td>
                                           <td>Diskon</td>
                                           <td>Jumlah Minimum beli</td>
                                       </tr>
                                       <tr>
                                           <td>@if(!empty($jasa))
                                               <select class="form-control select2" name="id_jasa" style="width: 100%" required>
                                                       @foreach($jasa as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nm_layanan }}</option>
                                                       @endforeach

                                               </select>
                                               @endif

                                           </td>
                                           <td>
                                               <input type="text" class="form-control" name="hpp"  value="0" disabled required>
                                           </td>
                                           <td>
                                               <input type="number" class="form-control" name="diskon" placeholder="diskon %"  required>
                                           </td>
                                           <td>
                                               <input type="number" class="form-control" name="minimum_beli" required>
                                           </td>
                                       </tr>
                                   </table>
                                   <div class="form-group">
                                       <button class="btn btn-primary">Simpan</button>
                                   </div>
                               </form>
                           </div>
                            <div class="col-md-12">
                                @if(!empty($detail_promo->linkToDetailBarang))
                                    <h4>detail Jasa Promo</h4>
                                    {{ csrf_field() }}
                                    <table style="width: 100%; margin-bottom: 10px">
                                        <tr>
                                            <td>Nama Layanan</td>
                                            <td>Harga Satuan</td>
                                            <td>Diskon</td>
                                            <td>Jumlah Minimum Order</td>
                                            <td>aksi</td>
                                        </tr>
                                        @foreach($detail_promo->linkToDetailBarang as $data_detail_promo)

                                                <tr>
                                                    <form role="form" action="{{ url('ubah-detail-promo/'.$data_detail_promo->id) }}" method="post">
                                                        {{ csrf_field() }}

                                                        <td><input type="hidden" name="_method" value="put">
                                                            @if(!empty($jasa))
                                                                <select class="form-control select2" name="id_jasa" style="width: 100%" required>
                                                                    @foreach($jasa as $data)
                                                                        <option value="{{ $data->id }}" @if($data_detail_promo->id_jasa==$data->id) selected @endif>{{ $data->nm_layanan }}</option>
                                                                    @endforeach

                                                                </select>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="hpp"  value="0" disabled required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="diskon" value="{{ $data_detail_promo->diskon }}" placeholder="diskon %"  required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="minimum_beli" value="{{ $data_detail_promo->minimum_beli }}" required>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-warning">ubah</button>
                                                            <a href="#" onclick="if(confirm('Apakah anda yakin akan menghapus data layanan ini .. ?')){ window.location.href='{{  url('hapus-detail-promo/'.$data_detail_promo->id) }}'  }else { alert('proses hapus dihentikan')} " class="btn btn-danger">hapus</a>
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
