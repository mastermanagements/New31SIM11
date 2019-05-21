@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proyek
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Proyek</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-proyek') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Proyek</label>
                                <select class="form-control select2" style="width: 100%;" name="jenis_proyek" required>
                                    @if(empty($jenis_proyek))
                                        <option>Proyek masih kosong</option>
                                    @else
                                        @foreach($jenis_proyek as $key=> $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama SPK</label>
                                <select class="form-control select2" style="width: 100%;" name="id_spk" required>
                                    @if(empty($spk))
                                        <option>SPK masih kosong</option>
                                    @else
                                        @foreach($spk as $value)
                                            <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lama Proyek</label>
                                <input type="number" min="0"  name="jangka_waktu" class="form-control" placeholder="Lama Proyek" required/>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Detail Proyek</label>
                                <textarea name="detail_proyek" class="form-control" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'detail_proyek',{
                height: 200
            } );
        };

//        $('#datepicker1').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });

        $(function () {
            $('.select2').select2()
        });
    </script>

@stop