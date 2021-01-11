@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Perbaikan Stok Opname
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    @include('user.produksi.section.inventory.menu')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap;">
                                <form action="{{ url('ubah-perbaikan-stok/'.$data_barang->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>
                                            Tanggal
                                        </label><br>
                                        <input type="date" name="tgl_so" value="{{ $data_barang->tgl_so }}" class="form-control" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Nama Barang
                                        </label><br>
                                        <input type="hidden" name="id_barang" value="{{ $data_barang->linkToBarang->id }}" class="form-control" required/>
                                        <input type="text" name="nm_barang" value="{{ $data_barang->linkToBarang->nm_barang }}" class="form-control" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Stok AKhir
                                        </label>
                                        <input type="text" name="stok_akhir" value="{{ $data_barang->stok_akhir }}"  class="form-control" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Bukti fisik
                                        </label>
                                        <input type="number" min="0" name="bukti_fisik"  value="{{ $data_barang->bukti_fisik }}" class="form-control" placeholder="Masukan stok fisik"/>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Petugas
                                        </label><br>
                                        <input type="text" name="nm_petugas" value="{{ $data_barang->petugas }}"  class="form-control" />
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