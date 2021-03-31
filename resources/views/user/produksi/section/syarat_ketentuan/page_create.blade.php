@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Syarat Ketentuan Layanan Jasa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Syarat Ketentuan Jasa</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('SK-Jasa') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Syarat Ketentuan Untuk </label>
                              <div class="form-group">
                                  @foreach($jenis_sk as $key => $value)
                                      <label>
                                          <input type="radio"  name="jenis_sk" class="minimal" value="{{ $key }}" required>
                                          {{ $value }}
                                      </label>
                                  @endforeach
                                  <p></p>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Syarat dan Ketentuan Layanan</label>
                              <textarea name="sk" class="form-control" id="sk"></textarea>
                              <small style="color: red">* Tidak Boleh Kosong</small>
                          </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          {{csrf_field()}}
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
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
    window.onload = function() {
        CKEDITOR.replace( 'sk',{
            height: 200
        } );
    };
    </script>
@stop
