@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
          <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Order Jasa
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Order Jasa</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('Order-Jasa/'.$order_jasa->id) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('put')
                            <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Tanggal Order</label>
                                  <input type="text" name="tgl_order" class="form-control" value="{{ tanggalView($order_jasa->tgl_order) }}" id="tgl_order" required/>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Klien</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                        @if(empty($klien))
                                            <option>Klien Masih Kosong</option>
                                        @else
                                            @foreach($klien as $value)
                                                <option value="{{ $value->id }}" @if($order_jasa->id_klien==$value->id) selected @endif>{{ $value->nm_klien }} - HP: {{ $value->hp }} - Alamat {!! $value->alamat !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
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
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

    $('#tgl_order').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

        $(function () {
            $('.select2').select2()
        });
    </script>
@stop
