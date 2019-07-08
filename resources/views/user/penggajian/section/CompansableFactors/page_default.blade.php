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
                    <div class="row">
                        @foreach($jabatan as $data_jabatan)
                            <div class="col-md-6">
                                <div class="box box-primary collapsed">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ $data_jabatan->nm_jabatan }}</h3>
                                        <div class="box-tools pull-right">
                                           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Faktor</th>
                                                <th>Bobot</th>
                                                <th style="width: 40px">Aksi</th>
                                            </tr>
                                            @foreach($data_jabatan->Cf as $cf)
                                            <tr>
                                                <td>#</td>
                                                <td>{{ $cf->faktor }}</td>
                                                <td>
                                                    @if(!empty($cf->sub_cf))
                                                        {{ $cf->sub_cf->sum('bobot_subcf') }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ url('delete-cf/'. $cf->id) }}" method="post">
                                                        <a href="#" onclick="update('{{ $cf->id}}')"><span class="btn btn-warning"><i class="fa fa-pencil"></i></span></a>
                                                        <input type="hidden" name="_method" value="put">
                                                        {{ csrf_field() }}
                                                        <p></p>
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ...?')"><i class="fa fa-eraser"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>



                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        @endforeach
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
              url: "{{ url('edit-cf') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_jabatan"]').val(result.id_jabatan).trigger('change');
                  $('[name="faktor"]').val(result.faktor);
                  $('[name="bobot_cf"]').val(result.bobot);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-cf') }}');
              }
          })
       }
    </script>
@stop