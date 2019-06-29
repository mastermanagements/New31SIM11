@extends('user.karyawan.master_user')

@section('skin')

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Keterangan Tambahan
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
                        <h3 class="box-title">Formulir Keterangan Tambahan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-keterangan/'.$pelamar->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Keterangan Tambahan</label>
                                <textarea class="form-control" placeholder="Masukan Penilaian anda" name="ket" style="height: 150px">{!! $hasil->ket !!}</textarea>
                                <!-- /.input group -->
                                <small style="color: orange">* Isi Jika Perlu</small>
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


@section('plugins')

    <script>
        window.onload = function() {
            CKEDITOR.replace( 'ket',{
                height: 600
            } );
        };

    </script>
@stop