@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop


@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Ubah Taks Proyek
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Taks Proyek</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-taksproyek/'.$data->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Tugas </label>
                                            <input type="text" class="form-control" name="nama_tugas" value="{{ $data->nama_tugas }}">
                                            <!-- /.input group -->
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Proyek</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_proyek" required>
                                                @if(empty($proyek))
                                                    <option>Anda Belum Memasukan data proyek </option>
                                                @else
                                                    @foreach($proyek as $value)
                                                        <option value="{{ $value->id }}" @if($value->id==$data->id_proyek) selected @endif> {{ $value->spk->nm_spk}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
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
        $(function () {
            $('.select2').select2();
        });
    </script>

@stop