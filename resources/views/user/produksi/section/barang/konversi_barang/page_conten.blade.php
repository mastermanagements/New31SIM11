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
           Daftar Konversi Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tabel Konversi Barang</h3>
                    </div>

                    <div class="box-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <a href="{{ url('atur-konversi/'.$data->id.'/create') }}" class="btn btn-primary">Tambah Konvesi Barang</a>
                             </div>
                             <div class="col-md-12" style="margin-top: 10px">
                                {{--@if(!empty($data->linkToHargaJualSatuan))--}}
                                     {{--<table id="example1" class="table table-bordered table-striped">--}}
                                        {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<td>#</td>--}}
                                                {{--<td>Nama Barang</td>--}}
                                                {{--<td>Harga HPP</td>--}}
                                                {{--<td>Harga Jual</td>--}}
                                                {{--<td>Aksi</td>--}}
                                            {{--</tr>--}}
                                        {{--</thead>--}}
                                         {{--<tbody>--}}
                                            {{--@php($no=1)--}}
                                            {{--@foreach($data->linkToHargaJualSatuan as $data)--}}
                                                 {{--<tr>--}}
                                                     {{--<td>{{ $no++ }}</td>--}}
                                                     {{--<td>{{ $data->linkToBarang->nm_barang }}</td>--}}
                                                     {{--<td>{{ $data->linkToBarang->hpp }}</td>--}}
                                                     {{--<td>{{ $data->harga_jual }}</td>--}}
                                                     {{--<td>--}}
                                                         {{--<form action="{{ url('harga-jual-satuan/'.$data->id.'/delete') }}" method="post">--}}
                                                             {{--{{ csrf_field() }}--}}
                                                             {{--<input type="hidden" name="_method" value="put">--}}
                                                             {{--<a href="{{ url('harga-jual-satuan/'.$data->id.'/edit') }}" class="btn btn-sm btn-warning">ubah</a>--}}
                                                             {{--<button type="submit" onclick="return confirm('Apakah anda akan menghapus data ini coy ... ?')" class="btn btn-sm btn-danger">hapus</button>--}}
                                                         {{--</form>--}}
                                                     {{--</td>--}}
                                                 {{--</tr>--}}
                                            {{--@endforeach--}}
                                         {{--</tbody>--}}
                                     {{--</table>--}}
                                 {{--@endif--}}
                             </div>
                         </div>
                    </div>
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

@stop
