@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

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
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Edit SWOT</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-swot/'. $data_swot->id) }}" method="post">
                            <div class="box-body">
								<div class="form-group">
									<label for="exampleInputEmail1">Tahun</label>
									<input type="text" min="1" max="4" name="tahun_swot" class="form-control" id="exampleInputEmail1" value="{{ $data_swot->kategori_swot}}" required>
									<small style="color: red">* Tidak Boleh Kosong</small>
								</div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pilih Kategori SWOT</label> &nbsp;
										
                                        <label>
										
                                            <input type="radio" name="kategori_swot" class="minimal" value="{{ $data_swot->kategori_swot}}" checked>
                                        </label>
                                    
									
                                    <small style="color: red" id="notify"></small>
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Isi SWOT</label>
                                    <textarea class="form-control" placeholder="Isi Swot" name="isi" id="isi" value="{{ $data_swot->isi }}" required>
                                        {!!  $data_swot->isi !!}
                                    </textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
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
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });
        window.onload = function() {
            CKEDITOR.replace( 'isi',{
                height: 600
            } );
        };

        //Initialize Select2 Elements
        //        $(function () {
        //
        //            //iCheck for checkbox and radio inputs
        //            $('input[type="radio"].minimal').iCheck({
        //                checkboxClass: 'icheckbox_minimal-blue',
        //                radioClass   : 'iradio_minimal-blue'
        //            })
        //
        //        })
    </script>
@stop