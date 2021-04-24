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
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Ubah Model Bisnis Canvas</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <form role="form" method="post" action="{{ url('update-mb/'.$mb->id) }}" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="form-group">
                            <div class="form-group">
                                  <label for="exampleInputFile">Elemen Model Bisnis</label>
                                    @if(empty($mb->id_jenis_mb))
                                       <select class="form-control select2" style="width: 100%;" name="id_jenis_mb" required>
                                            <option>Pilih mb</option>
                                            @foreach($jenis_mb as $value)
                                             <option value="{{ $value->id }}">{{ $value->nama_mb }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                          <select class="form-control select2" style="width: 100%;" name="id_jenis_mb" required>
                                                <option>Pilih mb </option>
                                                @foreach($jenis_mb as $value)
                                                    <option value="{{ $value->id }}" @if($mb->id_jenis_mb == $value->id) selected @endif>{{ $value->nama_mb }}</option>
                                                @endforeach
                                          </select>
                                          @endif
                                    <small style="color:red;">* Tidak boleh kosong</small>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputFile">Sub Model Bisnis</label>
                                      @if(empty($mb->id_sub_mb))
                                        <select class="form-control select2" style="width: 100%;" name="id_sub_mb" required>
                                            <option>Pilih sub mb</option>
                                        </select>
                                        @else
                                        <select class="form-control select2" style="width: 100%;" name="id_sub_mb" required>
                                            <option>Pilih sub</option>
                                            @foreach($sub_mb as $value)
                                                <option value="{{ $value->id }}" @if($mb->id_sub_mb == $value->id) selected @endif>{{ $value->sub_mb }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                        <small style="color:red;">* Tidak boleh kosong</small>
                                  </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Uraian</label>
                                <textarea class="form-control" placeholder="Masukan uraian bisnis model anda" name="isi" id="isi" required>
                                  {!! $mb->isi !!}
                                </textarea>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <input type="hidden" name="id"value="">
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
   CKEDITOR.replace( 'isi',{
        height: 100
   } );
</script>
@stop
