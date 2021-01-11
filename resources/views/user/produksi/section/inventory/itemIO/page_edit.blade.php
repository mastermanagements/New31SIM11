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
                                    <form action="{{ url('itemIO/'.$itemIO->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">

                                        <div class="form-group">
                                            <label>
                                                Jenis Item
                                            </label><br>
                                            <select name="jenis_item" class="form-control select2" required>
                                                @foreach($jenis_item as $key=>$jenis_item)
                                                    <option value="{{ $key }}" @if($itemIO->jenis_item == $key) selected @endif>{{$jenis_item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Tanggal
                                            </label>
                                            <input type="date" name="tgl" value="{{ $itemIO->tgl }}" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Nama Barang
                                            </label><br>
                                            <select name="id_barang" class="form-control select2" required>
                                                <option>Pilihan Barang</option>
                                                @if(!empty($barang))
                                                    @foreach($barang as $data)
                                                        <option value="{{ $data->id }}" @if($itemIO->id_barang == $data->id) selected @endif>{{ $data->nm_barang }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Keterangan
                                            </label>
                                            <textarea name="ket" class="form-control" required>{{ $itemIO->ket }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Jumlah Barang
                                            </label>
                                            <input type="text" name="jumlah_brg" value="{{ $itemIO->jumlah_brg }}" class="form-control" required/>
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