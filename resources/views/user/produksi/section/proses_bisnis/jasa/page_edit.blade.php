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
                Proses Bisnis Jasa
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Proses Bisnis Jasa</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('Proses-Bisnis/'.$data_probis->id) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('put')
                            <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Proses Bisnis</label>
                                  <input type="text" name="proses_bisnis" class="form-control" placeholder="Proses Bisnis Jasa"   value="{{ $data_probis->proses_bisnis }}" required/>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keterangan</label>
                                    <textarea name="ket" class="form-control" id="ket" required>{!! $data_probis->ket  !!} </textarea>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
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
            CKEDITOR.replace( 'ket',{
                height: 100
            } );
        };

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop
