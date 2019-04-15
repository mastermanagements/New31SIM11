@section('skin')
    <script src="https://cdn.ckeditor.com/4.11.3/basic/ckeditor.js"></script>
@stop


<form action="{{ url('BA-Serops-update/'.$dataSeropsById->id) }}" method="post" enctype="multipart/form-data">
<div class="col-md-8">
    <div class="box-body">
      <div class="form-group">
           <label for="exampleInputEmail1">Isi Berita Acara Serah Terima Operasional</label>
           <textarea class="form-control" placeholder="Masukan Isi Berita Acara Serah Terima Operasional" name="isi_serops" id="isi_serops" required>{!! $dataSeropsById->isi_serops !!}</textarea>
           <small style="color: red">* Tidak boleh kosong</small>
      </div>
    </div>
</div>
<div class="col-md-3">
       <div class="box-body" >
            <div class="form-group">
             <label for="exampleInputEmail1"></label>
                <span class="btn btn-default btn-file">
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 20%; height: 20%;">
                    <p style="color: red"> Format file yang disarankan *rar dan zip</p>
                    <label>@if(empty($dataSeropsById->file_serops)) Unggah File @else Nama File Sudah tersimpan :{{ str_limit($dataSeropsById->file_serops,5) }} @endif </label><input type="file" name="file_serops"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
            </div>
           <div class="form-group">
               <label for="exampleInputEmail1"></label>
               <span class="btn btn-default btn-file" >
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 20%; height: 20%;">
                    <p style="color: red"> Format file yang disarankan *rar dan zip</p>
                    <label>@if(empty($dataSeropsById->scan_file)) Unggah File @else Nama File Sudah tersimpan :{{ str_limit($dataSeropsById->scan_file,5) }} @endif </label></label><input type="file" name="scan_file"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
           </div>
           <div class="form-group">
               {{ csrf_field() }}
               <input type="hidden" name="id_spk" value="{{ $dataSeropsById->id_spk }}">
               <input type="hidden" name="_method" value="put">
               <button type="submit" class="btn btn-primary pull-right">Submit</button>
           </div>
       </div>
</div>
</form>



@section('plugins')
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        window.onload = function() {
            CKEDITOR.replace( 'isi_serops',{
                height: 255
            } );
        };
    </script>
@stop