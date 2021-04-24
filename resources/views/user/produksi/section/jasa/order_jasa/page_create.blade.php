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
            Order Layanan Jasa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Order Jasa</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('Order-Jasa') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                              <div class="form-group">
                                  <label>Tanggal Order </label>
                                  <div class="input-group date">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Order Jasa" name="tgl_order" >
                                  </div>
                                  <!-- /.input group -->
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Nama Konsumen</label>
                              <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                    @if(empty($klien))
                                        <option>Data Konsumen masih kosong</option>
                                      @else
                                        @foreach($klien as $value)
                                          <option value="{{ $value->id }}">{{ $value->nm_klien }} - HP: {{ $value->hp }} - Alamat {!! $value->alamat !!}</option>
                                          @endforeach
                                    @endif
                              </select>
                              <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <input type="hidden" name="status_service" value="0">
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
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

        $(function () {
            $('.select2').select2()
        });


    </script>

@stop
