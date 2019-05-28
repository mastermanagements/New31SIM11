@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- bootstrap datepicker -->
    {{--<link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">--}}

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jasa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Jasa</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-jasa') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ketegori Jasa</label>
                                <select class="form-control select2" style="width: 100%;" name="id_kategori" required>
                                    @if(empty($kategori_jasa))
                                        <option>Kategori Jasa Masih Kosong</option>
                                    @else
                                        @foreach($kategori_jasa as $value)
                                            <option value="{{ $value->id }}">{{ $value->nm_kategori_p }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Ketegori Jasa</label>
                                <select class="form-control select2" style="width: 100%;" name="id_subkategori_produk" required>
                                    <option value="0">Kategori Belum dipilih</option>
                                </select>
                                <small style="color: orange">* Isi Jika Perlu</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Sub Ketegori Jasa</label>
                                <select class="form-control select2" style="width: 100%;" name="id_subsubkategori_produk" required>
                                    <option value="0">Sub Kategori Belum dipilih</option>
                                </select>
                                <small style="color: orange">* Isi Jika Perlu</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Jasa</label>
                                <input type="text" name="nm_jasa" class="form-control" placeholder="nama jasa" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga jasa</label>
                                <input type="number" min="0" name="harga_jasa" class="form-control" placeholder="Harga Jasa" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rincian Jasa</label>
                                <textarea name="rincian_jasa" class="form-control" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
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
    <!-- bootstrap datepicker -->
    {{--<script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'rincian_jasa',{
                height: 600
            } );
        };

//        $('#datepicker').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });
//        $('#datepicker1').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });

        $(function () {
            $('.select2').select2()
        });
    </script>
    @include('user.produksi.section.jasa.JS.JS')
@stop