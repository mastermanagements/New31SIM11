@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
   <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Seleksi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Seleksi Berkas</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('simpan-seleksi/'.$data_peserta->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hasil</label>
                                <div class="form-group">
                                    @foreach($hasil as $key=>$value)
                                        <label>
                                            <input type="radio"  name="hasil" class="minimal" value="{{ $key}}" @if(!empty($data_peserta->seleksi_berkas->hasil))  @if($data_peserta->seleksi_berkas->hasil==$key) checked @endif @endif required>
                                            {{ $value }}
                                        </label>
                                        <br>
                                    @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea name="ket" class="form-control" id="exampleInputEmail1" placeholder="Nama Pelamar" required>@if(!empty( $data_peserta->seleksi_berkas->ket )) {{ $data_peserta->seleksi_berkas->ket }} @endif</textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
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

    <!-- iCheck 1.0.1 -->
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
  <script>
        //Initialize Select2 Elements


        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            });
            CKEDITOR.replace( 'ket',{
                height: 600
            } );


        })
    </script>
@stop