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
            Tambah Produksi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Produksi Baru</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form role="form" action="{{ url('produksi-baru') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Barang Jadi</label>
                                            <select class="form-control select2" name="id_barang" style="width: 100%">
                                                <option disabled>Pilih Barang</option>
                                                @if(!empty($barang_jadi))
                                                    @foreach($barang_jadi as $data_barang_jadi)
                                                        <option value="{{ $data_barang_jadi->id }}"> {{ $data_barang_jadi->nm_barang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Barang Dalam Proses</label>
                                            <select class="form-control select2" name="brg_dlm_proses" style="width: 100%">
                                                <option disabled>Pilih Barang</option>
                                                @if(!empty($barang_dalam_proses))
                                                    @foreach($barang_dalam_proses as $barang_dalam_proses_item)
                                                        <option value="{{ $barang_dalam_proses_item->id }}"> {{ $barang_dalam_proses_item->nm_barang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Produksi</label>
                                            <input type="text" class="form-control" name="kode_produksi" value="{{ $kode_produksi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Batch Number</label>
                                            <input type="text" class="form-control" name="batch_number">
                                        </div>
                                        <div class="form-group">
                                            <label>No Serial</label>
                                            <input type="text" class="form-control" name="no_serial">
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl Mulai</label>
                                            <input type="date" class="form-control" name="tgl_mulai" value="{{ $current_date }}"> - <input type="time" class="form-control" name="jam_mulai" value="{{ $current_time }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Status Produks</label>
                                            <input type="radio" name="status_produksi" value="0"> Produksi Baru
                                            <input type="radio" name="status_produksi"  value="1"> Sdg Berlangsung
                                            <input type="radio" name="status_produksi"  value="2"> Selesai Produksi
                                        </div>
                                        <div class="form-group">
                                            <label>Supervisor</label>
                                            <select class="form-control select2" name="id_supervisor_produksi" style="width: 100%">
                                                <option disabled>Pilih Barang</option>
                                                @if(!empty($supervisor))
                                                    @foreach($supervisor as $data_supervisor)
                                                        <option value="{{ $data_supervisor->id }}"> {{ $data_supervisor->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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