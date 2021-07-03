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
                Syarat dan Ketentuan Layanan Jasa
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Syarat dan Ketentuan Layanan Jasa</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('SK-Jasa/'.$skjasa->id) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('put')
                            <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Jenis SK</label>
                                  <div class="form-group">
                                      @foreach($jenis_sk as $key => $value)
                                          <label>
                                              <input type="radio"  name="jenis_sk" class="minimal" @if($key==$skjasa->jenis_sk) checked @endif value="{{ $key }}" required>
                                              {{ $value }}
                                          </label>
                                      @endforeach
                                      <p></p>
                                      <small style="color: red">* Tidak Boleh Kosong</small>
                                  </div>
                              </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Syarat dan Ketentuan</label>
                                    <textarea name="sk" class="form-control" id="sk" required>{!! $skjasa->sk  !!} </textarea>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
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
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        window.onload = function() {
            CKEDITOR.replace( 'sk',{
                height: 200
            } );
        };

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop
