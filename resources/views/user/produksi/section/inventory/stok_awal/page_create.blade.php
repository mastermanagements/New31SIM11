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
                <div class="box box-primary">
                    @include('user.produksi.section.inventory.menu')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap;">
								<div class="box-header with-border">
									<h3 class="box-title"><b>Formulir Tambah Stok Awal Barang</b></h3>                       
								</div>
                                <form action="{{ url('inventory') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>
                                            Nama Barang
                                        </label> &nbsp;<strong style="color: red">*</strong><br>
                                        <select name="id_barang" class="form-control select2" required>
                                            <option disabled>Pilihan Barang</option>
                                            @if(!empty($barang))
                                                @foreach($barang as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nm_barang }}, Satuan: {{ $data->linkToSatuan->satuan }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Jumlah Barang
                                        </label> &nbsp;<strong style="color: red">*</strong>
                                        <input type="text" name="jumlah_brg" class="form-control" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Tanggal Expired
                                        </label>
                                        <input type="date" name="expired_date" class="form-control"/>
                                    </div>
										<div class="box-footer">
											<p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
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
