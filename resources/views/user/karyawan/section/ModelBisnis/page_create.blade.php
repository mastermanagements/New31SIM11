@extends('user.karyawan.master_user')

@section('skin')
<link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
<script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
@stop



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bisnis Model Canvas
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Bisnis Model Canvas</h3>
                        <h5 class="pull-right"><a href="{{ url('Model-Bisnis')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-mb') }}" method="post">
                      <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputFile">Elemen Model Bisnis</label>&nbsp;<strong style="color: red">*</strong>
                              <select class="form-control select2" style="width: 100%;" name="id_jenis_mb" required>
                                <option>Pilih Elemen Model Bisnis</option>
                                  @foreach($jenis_mb as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama_mb }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputFile">Sub Model Bisnis</label>&nbsp;<strong style="color: red">*</strong>
                                <select class="form-control select2" style="width: 100%;" name="id_sub_mb" required>
                                  <option>Pilih Sub Model Bisnis</option>
                                </select>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Isi</label>&nbsp;<strong style="color: red">*</strong>
                                  <textarea class="form-control" placeholder="Masukan isi uraian model bisnis" name="isi" id="isi" required></textarea>
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
<script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script>
    //Initialize Select2 Elements
   $(function () {
       $('.select2').select2();

       $('[name="id_jenis_mb"]').change(function () {
           $.ajax({
               url:"{{ url('getSubModelBisnis') }}/" + $(this).val(),
               dataType: "json",
               success: function (result) {
                   var option="<option>Pilih Sub Model Bisnis</option>";
                   $.each(result, function (id, val) {
                       option+="<option value="+val.id+">"+val.sub_mb+"</option>";
                   });
                   $('[name="id_sub_mb"]').html(option);
               }
           })
       })
   })
   window.onload = function() {
       CKEDITOR.replace( 'isi',{
           height: 100
       } );
   };
</script>
@stop
