@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
   <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
   <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SWOT (Strength, Weakness, Opportunitie, Threats)
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-swot') }}" class="btn btn-primary">Buat SWOT anda</a>
        <p></p>
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah SWOT</h3>
                        <h5 class="pull-right"><a href="{{ url('Swot')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-swot') }}" method="post">
                        <div class="box-body">
                          <div class="form-group">
                              <label>Tahun</label>&nbsp;<strong style="color: red">*</strong>
                              <div class="input-group date">
                                  <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="datepicker"  name="tahun_swot" required>
                              </div>
                              <!-- /.input group -->
                          </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori SWOT</label>&nbsp;<strong style="color: red">*</strong>
                                <div class="form-group">
                                    @foreach($jenis_swot as $value)
                                        <label>
                                            <input type="radio"  name="kategori_swot" class="minimal" value="{{ $value}}" required>
                                            {{ $value}}
                                        </label>
                                        <br>
                                    @endforeach
                                    <p></p>
                             </div>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Isi (SWOT) anda</label>&nbsp;<strong style="color: red">*</strong>
                                      <textarea class="form-control" placeholder="Masukan SWOT usaha anda" name="isi" id="isi" required>
                                    </textarea>
                                </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                        </div>
                        <div class="box-footer">
                            {{ csrf_field() }}
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
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'isi',{
                height: 175
            } );
        };

        //Initialize Select2 Elements
        $(function () {

            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })

        })
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@stop
