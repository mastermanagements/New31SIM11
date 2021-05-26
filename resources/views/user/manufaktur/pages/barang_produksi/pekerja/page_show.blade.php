@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tenaga Produksi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
          @if(!empty(session('message_success')))
              <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
          @elseif(!empty(session('message_fail')))
              <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
          @endif
          <p></p>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tenaga Produksi</h3>
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                         {{ csrf_field() }}
                                        <div class="col-md-12">
                                            <table class="table table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Karyawan&nbsp;<strong style="color: red">*</strong></th>
                                                        <th>Besaran Upah&nbsp;<strong style="color: red">*</strong></th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($no=1)
                                                    <tr>
                                                        <form action="{{ url('tenaga-produksi') }}" method="post">
                                                            <td> {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data_tambah_produksi->id }}"></td>
                                                            <td>
                                                                <select name="tenaga_kerja" class="form-control select2" style="width: 100%;" required>
                                                                    @if(!empty($karyawan))
                                                                        <option value="">Pilih Karyawan</option>
                                                                        @foreach($karyawan as $data_karyawan)
                                                                            <option value="{{ $data_karyawan->id }}">{{ $data_karyawan->nama_ky }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rupiah2" class="form-control" name="jumlah_upah" required>
                                                            </td>
                                                            <td><button type="submit" class="btn btn-primary">Simpan</button></td>
                                                        </form>
                                                    </tr>
                                                    @if(!empty($tenaga_prod))
                                                        @foreach($tenaga_prod as $tenaga_prod)
                                                            <tr>
                                                                <form action="{{ url('tenaga-produksi/'.$tenaga_prod->id) }}" method="post">
                                                                    <td>{{ $no++ }} @method('put') {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $tenaga_prod->id_tambah_produksi }}"></td>
                                                                    <td>
                                                                            <select name="tenaga_kerja" class="form-control select2" style="width: 100%;" required>
                                                                                @if(!empty($karyawan))
                                                                                    <option value="">Pilih Karyawan</option>
                                                                                    @foreach($karyawan as $karyawan_item)
                                                                                        <option value="{{ $karyawan_item->id }}" @if($tenaga_prod->tenaga_kerja == $karyawan_item->id) selected @endif>{{ $karyawan_item->nama_ky }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="jumlah_upah" value="{{ rupiahView($tenaga_prod->jumlah_upah) }}" required>
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" class="btn btn-warning">ubah</button>
                                                                        <a href="{{ url('tenaga-produksi/'.$tenaga_prod->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus data pekerja produksi ini...?')" type="submit" class="btn btn-danger">hapus</a>
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
                        </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
      @include('user.global.rupiah_input2')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@stop
