@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Keluarkan Stok Gudang Gudang
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                @if(!empty(session('message_success')))
                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                @endif
                <p></p>

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Formulir keluarkan stok gudang</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <form action="{{ url('keluarkan-barang-gudang') }}" method="post">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="gudang_asal" value="{{ $id_gudang }}">
                                            <input type="date" name="tgl_transaksi" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Nama Pengirim</label>
                                            <select class="form-control" name="nama_pengirim" required>
                                                <option>Data Pengirim</option>
                                                @if(!empty($karyawan))
                                                    @foreach($karyawan as $item_karyawan)
                                                        <option value="{{ $item_karyawan->id }}">{{ $item_karyawan->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Nama penerima</label>
                                            <select class="form-control" name="nama_penerima" required>
                                                <option>Data penerima</option>
                                                @if(!empty($karyawan))
                                                    @foreach($karyawan as $item_karyawan)
                                                        <option value="{{ $item_karyawan->id }}">{{ $item_karyawan->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Gudang Tujuan</label>
                                            <select class="form-control" name="gudang_tujuan" required>
                                                <option>Data Gudang</option>
                                                @if(!empty($gudang_tujuan))
                                                    @foreach($gudang_tujuan as $gudang_tujuan)
                                                        <option value="{{ $gudang_tujuan->id }}">{{ $gudang_tujuan->gudang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">Buat</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->


        <!-- /.modal -->

    </div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.arsip.jenis_arsip.modal.JS')
    <script>

    </script>
@stop
