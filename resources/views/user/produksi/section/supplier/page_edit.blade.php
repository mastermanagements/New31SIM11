@extends('user.administrasi.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Supplier
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Supplier</h3>
							<h5 class="pull-right"><a href="{{ url('Supplier')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-supplier/'.$data_supplier->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Supplier</label>
                                    <input type="text" name="nm_supplier" class="form-control" placeholder="Nama Supplier" value="{{ $data_supplier->nama_suplier }}" required/>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kontak Person</label>
                                    <input type="text" name="cp_suplier" class="form-control" placeholder="Nomor Kontak Person" value="{{ $data_supplier->cp_suplier }}" />
                                    <small style="color: orange">* Isi Jika perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Telepon Supplier</label>
                                    <input type="text" name="telp_suplier" class="form-control" placeholder="No. Telepon Supplier"  value="{{ $data_supplier->telp_suplier }}"/>
                                    <small style="color: orange">* Isi Jika perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Handphone Supplier</label>
                                    <input type="text" name="hp_suplier" class="form-control" placeholder="No. Handphone Supplier"  value="{{ $data_supplier->hp_suplier }}"/>
                                    <small style="color: orange">* Isi Jika perlu</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Handphone Supplier</label>
                                    <input type="text" name="wa_suplier" class="form-control" placeholder="No. Whatsapp" value="{{ $data_supplier->wa_suplier }}" />
                                    <small style="color: orange">* Isi Jika perlu</small>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop
