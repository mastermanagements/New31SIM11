@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
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
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Edit SWOT</h3>
                            <h5 class="pull-right"><a href="{{ url('Swot')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-swot/'. $data_swot->id) }}" method="post">
                            <div class="box-body">
                              <div class="form-group">
                                  <label>Tahun</label>&nbsp;<strong style="color: red">*</strong>

                                  <div class="input-group date">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="datepicker"  name="tahun_swot" value="{{ $data_swot->tahun_swot}}" required>
                                  </div>
                                  <!-- /.input group -->
                              </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori SWOT</label> &nbsp;<strong style="color: red">*</strong>
                                        <input type="text"  name="kategori_swot" class="form-control" id="exampleInputEmail1"  value="{{ $data_swot->kategori_swot }}" required readonly>
                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1">Isi SWOT</label>&nbsp;<strong style="color: red">*</strong>
                                    <textarea  name="isi" class="form-control" id="isi" required>
                                        {!!  $data_swot->isi !!}
                                    </textarea>
                            </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                              <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                            </div>
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
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'isi',{
                height: 175
            } );
        };

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@stop
