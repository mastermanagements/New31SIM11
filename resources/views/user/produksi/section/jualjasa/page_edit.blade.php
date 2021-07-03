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
                Jual Jasa
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Jual Jasa</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-jual-jasa/'.$data_jualjasa->id) }}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Klien</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                        @if(empty($data_klien))
                                            <option>Klien masih kosong</option>
                                        @else
                                            @foreach($data_klien as $value)
                                                <option value="{{ $value->id }}" @if($data_jualjasa->id_klien==$value->id) selected @endif > {{ $value->nm_klien }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Jasa</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_jasa" required>
                                        @if(empty($data_jasa))
                                            <option>Klien masih kosong</option>
                                        @else
                                            @foreach($data_jasa as $value)
                                                <option value="{{ $value->id }}"  @if($data_jualjasa->id_jasa==$value->id) selected @endif >{{ $value->nm_jasa }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Detail Pesanan</label>
                                    <textarea name="detail_pesanan" class="form-control" required>{!! $data_jualjasa->detail_pesanan !!}</textarea>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Jual</label>
                                    <input type="number" min="0"  name="harga_jual" class="form-control" value="{{ $data_jualjasa->harga_jual }}" placeholder="Harga Jual" required/>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'detail_pesanan',{
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