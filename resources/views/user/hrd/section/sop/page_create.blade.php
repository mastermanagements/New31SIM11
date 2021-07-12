@extends('user.karyawan.master_user')

@section('skin')
   <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SOP (Standar Operasional Prosedur)
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir SOP</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-sop') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label>Nama SOP</label>
                                <input type="text" class="form-control pull-right" name="nm_sop" required>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1"> Isi SOP</label>
                                <textarea id="alasan" class="form-control" name="isi_sop"></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                       </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
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


@section('plugins')

    <script>


        CKEDITOR.replace('alasan', {
            height: 600
        });



    </script>
@stop