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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Supplier</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-supplier') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Supplier</label>
                                <input type="text" name="nm_supplier" class="form-control" placeholder="Nama Supplier" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Kontak Person</label>
                                <input type="text" name="cp_suplier" class="form-control" placeholder="Nomor Kontak Person" />
                                <small style="color: orange">* Isi Jika perlu</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Telepon Supplier</label>
                                <input type="text" name="telp_suplier" class="form-control" placeholder="No. Telepon Supplier" />
                                <small style="color: orange">* Isi Jika perlu</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone Supplier</label>
                                <input type="text" name="hp_suplier" class="form-control" placeholder="No. Handphone Supplier" />
                                <small style="color: orange">* Isi Jika perlu</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone Supplier</label>
                                <input type="text" name="wa_suplier" class="form-control" placeholder="No. Whatsapp" />
                                <small style="color: orange">* Isi Jika perlu</small>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
