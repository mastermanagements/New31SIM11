@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Biaya Overhead Produksi
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
                        <h3 class="box-title">Formulir Biaya Overhead Produksi</h3>
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
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
                                                        <th>Biaya Overhead</th>
                                                        <th>Besarnya Biaya Overhead</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($no=1)
                                                    <tr>
                                                        <form action="{{ url('biaya-overhead') }}" method="post">
                                                            <td> {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data_tambah_produksi->id }}"></td>
                                                            <td>
                                                                <select name="id_item_overhead" class="form-control select2" style="width: 100%;" required>
                                                                    @if(!empty($item_over_head))
                                                                        <option value="">Pilih Item Overhead</option>
                                                                        @foreach($item_over_head as $data_item_over_head)
                                                                            <option value="{{ $data_item_over_head->id }}">{{ $data_item_over_head->item_overhead }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="rupiah2" name="jumlah_biaya" required>
                                                            </td>
                                                            <td><button type="submit" class="btn btn-primary">Simpan</button></td>
                                                        </form>
                                                    </tr>
                                                    @if(!empty($data_biaya_overhead))
                                                        @foreach($data_biaya_overhead as $data_biaya_overhead)
                                                            <tr>
                                                                <form action="{{ url('biaya-overhead/'.$data_biaya_overhead->id) }}" method="post">
                                                                    <td>{{ $no++ }} @method('put') {{ csrf_field() }} <input type="hidden" name="id_tambah_produksi" value="{{ $data_biaya_overhead->id_tambah_produksi }}"></td>
                                                                    <td>
                                                                            <select name="id_item_overhead" class="form-control select2" style="width: 100%;" required>
                                                                                @if(!empty($item_over_head))
                                                                                    <option value="">Pilih Item Overhead</option>
                                                                                    @foreach($item_over_head as $data_item_over_head)
                                                                                        <option value="{{ $data_item_over_head->id }}" @if($data_biaya_overhead->id_item_overhead==$data_item_over_head->id) selected @endif>{{ $data_item_over_head->item_overhead }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="jumlah_biaya" value="{{ rupiahView($data_biaya_overhead->jumlah_biaya) }}" required>
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" class="btn btn-warning">ubah</button>
                                                                        <a href="{{ url('biaya-overhead/'.$data_biaya_overhead->id.'/delete') }}" onclick="return confirm('Apakah anda akan menghapus data biaya overhead ini...?')" type="submit" class="btn btn-danger">hapus</a>
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
    <script>

@stop
