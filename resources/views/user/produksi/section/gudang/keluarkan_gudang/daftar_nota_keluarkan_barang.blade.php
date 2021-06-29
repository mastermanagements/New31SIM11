@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Daftar Nota keluarkan barang nota
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
                            <h4 class="box-title">Tabel Nota Keluarkan Barang</h4>
                        </div>
                        <div class="box-body">
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Pengirim</th>
                                    <th>Nama Penerima</th>
                                    <th>Gudang Asal</th>
                                    <th>Gudang Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @php($no=1)
                                    @foreach($data as $item_nota)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item_nota->tgl_transaksi)) }}</td>
                                            <td>{{ $item_nota->linkToPengirim->nama_ky }}</td>
                                            <td>{{ $item_nota->linkToPenerima->nama_ky }}</td>
                                            <td>{{ $item_nota->linkToGudangAsal->gudang }}</td>
                                            <td>{{ $item_nota->linkToGudangTujuan->gudang }}</td>
                                            <td>
                                                <a href="{{ url('detail-barang-keluar-gudang/'.$item_nota->id) }}" class="btn btn-warning">Detail Keluar Barang</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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
