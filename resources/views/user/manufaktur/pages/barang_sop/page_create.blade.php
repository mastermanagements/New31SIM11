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
            Barang SOP
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Barang SOP</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form role="form" action="{{ url('barang-sop') }}" method="post" enctype="multipart/form-data">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label>Proses Bisnis</label>
                                            <input type="hidden" name="id_sop_pro" class="form-control" value="{{ $id_sop_produksi }}" required/>
                                            <input type="text" name="proses_bisnis" class="form-control" value="{{ $sop_produksi->nama_sop }}" disabled required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Barang</label>
                                            <select class="form-control select2" name="id_barang" style="width: 100%">
                                                <option disabled>Pilih Barang</option>
                                                @if(!empty($barang))
                                                    @foreach($barang as $data_barang)
                                                        <option value="{{ $data_barang->id }}"> {{ $data_barang->nm_barang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-12">
                                    <hr>
                                    <h5 >Daftar Barang</h5>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Barang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($sop_produksi->LinkToMannyPSOBarang))
                                                @php($i=1)
                                                @foreach($sop_produksi->LinkToMannyPSOBarang as $sop_produksi)
                                                    <tr>
                                                        <form action="{{ url('barang-sop/'.$sop_produksi->id) }}" method="post">
                                                            <td>{{ $i++ }} {{ csrf_field() }} @method('put') <input type="hidden" name="id_sop_pro" class="form-control" value="{{ $sop_produksi->id_sop_pro }}" required/></td>
                                                            <td>
                                                                <select class="form-control select2" name="id_barang" style="width: 100%">
                                                                    <option disabled>Pilih Barang</option>
                                                                    @if(!empty($barang))
                                                                        @foreach($barang as $data_barang)
                                                                            <option value="{{ $data_barang->id }}" @if($data_barang->id==$sop_produksi->id_barang) selected @endif > {{ $data_barang->nm_barang }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="submit" class="btn btn-warning">Ubah</button>
                                                                <a href="{{ url('barang-sop/'.$sop_produksi->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')">Ubah</a>
                                                            </td>
                                                        </form>
                                                    </tr>

                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'spec_barang',{
                height: 200
            } );
            CKEDITOR.replace( 'desc_barang',{
                height: 200
            } );
        };

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
//        $('#datepicker1').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });

        $(function () {
            $('.select2').select2()
        });
    </script>
    @include('user.produksi.section.barang.JS.JS')
@stop