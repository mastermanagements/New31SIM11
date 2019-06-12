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
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-swot') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pilih Tahun</label>
									<select class="form-control select2" style="width: 100%;" name="tahun_swot" required>
										<option>Tahun</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach
                 
									</select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori SWOT</label>
                                <div class="form-group">
                                    @foreach($jenis_swot as $value)
                                        <label>
                                            <input type="radio"  name="kategori_swot" class="minimal" value="{{ $value}}" required>
                                            {{ $value}}
                                        </label>
                                    @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                             </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Isi (SWOT) anda</label>
                                    <textarea class="form-control" placeholder="Masukan SWOT usaha anda" name="isi" id="isi" required>

                                    </textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
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
     <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'isi',{
                height: 600
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
    </script>
@stop