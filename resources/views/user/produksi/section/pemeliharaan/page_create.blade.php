@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeliharaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Pemeliharaan</h3>
                    </div>
                    <!-- /.box-header -->
                    @if(!empty(session('message_success')))
                        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                    @elseif(!empty(session('message_fail')))
                        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                    @endif
                    <!-- form start -->
                    <form role="form" action="{{ url('store-pemeliharaan') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jual Jasa</label>
                                        <select class="form-control select2" name="id_jasa" style="width: 100%;" required>
                                            @if(empty($jasa))
                                                <option>Ada Belum Memasukan data kedalam menu jual jasa</option>
                                            @else
                                                @foreach($jasa as $data)
                                                    <option value="{{ $data->id }}"> {{ $data->nm_jasa }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Pemeliharaan</label>
                                        <select class="form-control select2" name="id_jenis_pem" style="width: 100%;" required>
                                            @if(empty($jenis_pemeliharaan))
                                                <option>Ada Belum Memasukan data kedalam menu jual jasa</option>
                                            @else
                                                @foreach($jenis_pemeliharaan as $data)
                                                    <option value="{{ $data->id }}"> {{ $data->jenis_pem }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Pemeliharaan</label>
                                        <input type="text"  class="form-control"name="nm_pemeliharaan" placeholder="Masukan nama pemeliharaan anda" required >
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Jangka Waktu</label>
                                        <input type="number" min="0" class="form-control "  name="jangka_waktu" placeholder="Masukan Jangka waktu pengerjaan" >
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Biaya Pemeliharaan</label>
                                        <input type="number" min="0" class="form-control"  name="biaya_pem" placeholder="Masukan Biaya Pemeliharaan" >
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                       <textarea class="form-control" name="ket"></textarea>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>



                                </div>

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
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

    <script>
        window.onload = function() {
            CKEDITOR.replace( 'ket',{
                height: 300
            } );
        };

        $(function () {
            $('.select2').select2();
            //Date range picker
        });

    </script>

@stop