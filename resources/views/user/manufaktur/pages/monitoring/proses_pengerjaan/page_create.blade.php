@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">


@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proses Pengerjaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Proses Pengerjaan</h3>
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form role="form" action="{{ url('proses-pengerjaan') }}" method="post" enctype="multipart/form-data">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label>Barang Produksi</label>
                                            <input type="hidden" name="id_tambah_produksi" class="form-control" value="{{ $model_tambah_produksi->id }}" required/>
                                            <input type="text" name="proses_bisnis" class="form-control" value="{{ $model_tambah_produksi->linkToBarang->nm_barang }}-{{ $model_tambah_produksi->linkToBarang->linkToSatuan->satuan }}-{{ $model_tambah_produksi->linkToBarang->spec_barang }}" disabled required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahap Produksi</label>
                                            <select class="form-control select2" name="id_proses_bisnis" style="width: 100%">
                                                <option disabled>Pilih Tahap Produksi</option>
                                                @if(!empty($tahap_produksi))
                                                    @foreach($tahap_produksi as $item_tahap_produksi)
                                                        <option value="{{ $item_tahap_produksi->id }}"> {{ $item_tahap_produksi->proses_bisnis }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="ket"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="box-footer">
                            {{ csrf_field() }}

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
  
    <script>

        window.onload = function() {

        $(function () {
            $('.select2').select2()
        });
    </script>

@stop
