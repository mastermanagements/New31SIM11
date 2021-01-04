@extends('user.keuangan.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Form Tahun Buku
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Panel Tahun Buku</h3>
                     </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('tahun-buku/'.$data->id) }}" method="post">
                        <div class="box-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Buku</label>
                                <input type="month"  class="form-control" name="thn_buku" value="{{ $data->thn_buku }}-{{ $data->bln_buku }}" required/>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop