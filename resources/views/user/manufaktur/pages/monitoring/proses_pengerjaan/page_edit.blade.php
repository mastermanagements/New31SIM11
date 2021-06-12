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
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Proses Pengerjaan</h3>
                          <h5 class="pull-right"><a href="{{ url('manufaktur')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form role="form" action="{{ url('proses-pengerjaan/'.$data_proses_produksi->id) }}" method="post" enctype="multipart/form-data">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ csrf_field() }} @method('put')
                                            <label>Tanggal Selesai</label>
                                            <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($current_date)) }}" readonly required/>
                                        </div>
                                        <div class="form-group">
                                            {{ csrf_field() }} @method('put')
                                            <input type="hidden" name="id_tambah_produksi" class="form-control" value="{{ $data_proses_produksi->id_tambah_produksi}}" readonly required/>
                                            <label>Jam Selesai</label>
                                            <input type="text" class="form-control" value="{{ $current_time }}" readonly required/>
                                        </div>
                                         <div class="form-group">
                                            {{ csrf_field() }}
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="ket">{{ $data_proses_produksi->ket }}</textarea>
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

@stop
