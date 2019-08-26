@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Log Diary
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
                            <h3 class="box-title">Formulir Log Diary</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-LogDiary') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                <div class="form-group">
                                    <label>Tanggal Log Diary </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tahun" name="tgl_log_diary" required>
                                    </div>
                                    <!-- /.input group -->
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="input-group">
                                        <label>Key Moment</label>
                                    <textarea class="form-control" placeholder="Moment" name="key_moment" required></textarea>
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
                <div class="row">
                    @foreach($data as $value)
                    <div class="col-md-3">
                        <div class="box box-danger collapsed">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ date('d-m-Y', strtotime($value->tgl_log_diary)) }}</h3>
                                <div class="box-tools pull-right">
                                    <a href="#" onclick="update('{{ $value->id }}')"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('hapus-log-diary/'. $value->id) }}" onclick="return confirm('apakah anda akan menghapus diary ini..?')"><i class="fa fa-eraser"></i></a>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <p>{{ $value->key_moment }}</p>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                        @endforeach
                    {{ $data->links() }}
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });


        create = function(id){
            $('[name="id_ky"]').val(id);
            $('#modal-tesKemanajerial').modal('show');
        }

        update = function (id) {
            $.ajax({
                url: "{{ url('edit-log-diary') }}/"+id,
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    var tgl = result.tgl_log_diary.split('-');
                    $('[name="tgl_log_diary"]').val(tgl[2]+'-'+tgl[1]+'-'+tgl[0]);
                    $('[name="key_moment"]').val(result.key_moment);
                    $('[name="id"]').val(result.id);
                    $('#formulir').attr('action', '{{ url('update-log-diary') }}');
                    $('#modal-kpi').modal('show');
                }
            })
        }
    </script>
@stop