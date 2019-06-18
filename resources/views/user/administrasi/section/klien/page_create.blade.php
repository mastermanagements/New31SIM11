@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Klien
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Klien</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-klien') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama </label>
                                <input type="text" name="nm_klien" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat </label>
                                    <textarea class="form-control"  name="alamat" id="alamat" required></textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone</label>
                                <input type="text" name="hp"  class="form-control" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Whatshapp</label>
                                <input type="text" name="wa"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telegram</label>
                                <input type="text" name="teleg"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Instagram</label>
                                <input type="text" name="ig"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook</label>
                                <input type="text" name="fb"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Twitter</label>
                                <input type="text" name="twiter"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perusahaan</label>
                                <input type="text" name="nm_perusahaan"  class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Perusahaan</label>
                                <textarea class="form-control"  name="alamat_perusahaan" id="alamat_perusahaan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telp Perusahaan</label>
                                <input type="text" name="telp_perusahaan" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1">
                                <input type="hidden" name="jenis_klien" value="0" class="form-control" id="exampleInputEmail1">
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
