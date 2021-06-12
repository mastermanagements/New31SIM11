@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">


@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ubah Proses Produksi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Ubah Proses Bisnis Manufaktur</h3>
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form  action="{{ url('proses-bisnis/'.$proses_bisnis->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                                @method('put')
                                <label>Proses Bisnis</label>
                                <input type="hidden" name="id_sop_pro" class="form-control" value="{{ $proses_bisnis->id_sop_pro }}" required/>
                                <input type="text" name="proses_bisnis" class="form-control" value="{{ $proses_bisnis->proses_bisnis }}"  required/>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" class="form-control" >{{ $proses_bisnis->ket }}</textarea>
                            </div>
                        </div>

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

    </script>

@stop
