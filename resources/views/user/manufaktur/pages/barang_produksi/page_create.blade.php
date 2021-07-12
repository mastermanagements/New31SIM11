@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
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
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form role="form" action="{{ url('produksi-baru') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Barang Jadi</label>&nbsp;<strong style="color: red">*</strong>
                                            <select class="form-control select2" name="id_barang" style="width: 100%">
                                                <option disabled>Pilih Barang</option>
                                                @if(!empty($barang_jadi))
                                                    @foreach($barang_jadi as $data_barang_jadi)
                                                        <option value="{{ $data_barang_jadi->id }}"> {{ $data_barang_jadi->nm_barang }}, &nbsp; @if(!empty($data_barang_jadi->linkToSatuan->satuan)) {{ $data_barang_jadi->linkToSatuan->satuan }},  @endif&nbsp;{{ $data_barang_jadi->spec_barang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Barang Dalam Proses</label>
                                            <select class="form-control select2" name="brg_dalam_proses" style="width: 100%">
                                                <option value="">Pilih Barang</option>
                                                @if(!empty($barang_dalam_proses))
                                                    @foreach($barang_dalam_proses as $barang_dalam_proses_item)
                                                        <option value="{{ $barang_dalam_proses_item->id }}"> {{ $barang_dalam_proses_item->nm_barang }}, &nbsp; @if(!empty($barang_dalam_proses_item->linkToSatuan->satuan)){{ $barang_dalam_proses_item->linkToSatuan->satuan }} @endif , &nbsp;{{ $barang_dalam_proses_item->spec_barang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kode Produksi</label>
                                            <input type="text" class="form-control" name="kode_produksi" value="{{ $kode_produksi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Batch Number</label>
                                            <input type="text" class="form-control" name="batch_number">
                                        </div>
                                    </div>

                                  <div class="col-md-3">
                                        <div class="form-group">
                                            <label>No Serial</label>
                                            <input type="text" class="form-control" name="no_serial">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Mulai </label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="datepicker"  name="tgl_mulai" value="{{ tanggalView($current_date)}}" >
                                            </div>
                                        </div>
                                  </div>
                                  <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jam Mulai</label>&nbsp;<strong style="color: red">*</strong>
                                            <input type="text" class="form-control" name="jam_mulai" value="{{ $current_time }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Supervisor</label>
                                            <select class="form-control select2" name="id_supervisor_produksi" style="width: 100%">
                                                <option disabled>Pilih Supervisor</option>
                                                @if(!empty($supervisor))
                                                    @foreach($supervisor as $data_supervisor)
                                                        <option value="{{ $data_supervisor->id }}"> {{ $data_supervisor->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="box-footer">
                                        <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                                        </div>
                                        <div class="box-footer">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
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

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


        $(function () {
            $('.select2').select2()
        });
    </script>
@stop
