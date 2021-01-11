@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stok Awal
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    @include('user.produksi.section.inventory.menu')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap;">
                                <form action="{{ url('inventory/'.$data_stok->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put">
                                    <div class="form-group">

                                        <label>
                                            Nama Barang
                                        </label><br>
                                        <select name="id_barang" class="form-control select2" required>
                                            <option>Pilihan Barang</option>
                                            @if(!empty($barang))
                                                @foreach($barang as $data)
                                                    <option value="{{ $data->id }}" @if($data_stok->id_barang==$data->id) selected @endif>{{ $data->nm_barang }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Jumlah Barang
                                        </label>
                                        <input type="text" name="jumlah_brg" class="form-control" value="{{ $data_stok->jumlah_brg }}" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Tanggal Expired
                                        </label>
                                        <input type="date" name="expired_date" class="form-control" value="{{ $data_stok->expired_date }}" required/>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
@stop