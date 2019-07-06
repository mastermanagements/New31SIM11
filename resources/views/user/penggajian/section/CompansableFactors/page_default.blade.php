@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Compansable Factors
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary collapsed">

                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Compansable Factors</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-compansable-factors') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_jabatan" required>
                                        @if(empty($jabatan))
                                            <option>Jabatan Masih Kosong</option>
                                        @else
                                            @foreach($jabatan as $value)
                                                <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                    <div class="form-group">
                                        <label>Faktor</label>
                                        <input type="text" class="form-control" name="faktor" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                <div class="form-group">
                                        <label>Bobot</label>
                                        <input type="number" class="form-control" name="bobot_cf" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>

                            </div>

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Compansable Factors</h3>
                            <div class="box-tools pull-right">
                               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-alokasi-gaji') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="thn"]').val(result.thn);
                  $('[name="persen"]').val(result.persen);
                  $('[name="jumlah"]').val(result.jumlah);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-alokasi-gaji') }}');
              }
          })
       }
    </script>
@stop