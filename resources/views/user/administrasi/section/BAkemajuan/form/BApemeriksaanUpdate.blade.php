@section('skin')
    <script src="https://cdn.ckeditor.com/4.11.3/basic/ckeditor.js"></script>
@stop


<form action="{{ url('Proses-BAkem/'.$dataBapemById->id) }}" method="post" enctype="multipart/form-data">
<div class="col-md-8">
    <div class="box-body">
      <div class="form-group">
           <label for="exampleInputEmail1">Isi Berita Acara Kemajuan</label>
           <textarea class="form-control" placeholder="Masukan Isi Berita Acara Kemajuan" name="isi_bakem" id="isi_bakem" required>{!! $dataBapemById->isi_bak !!}</textarea>
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
                    <label>@if(empty($dataBapemById->file_bakem)) Unggah File @else Nama File Sudah tersimpan :{{ str_limit($dataBapemById->file_bakem,5) }} @endif </label><input type="file" name="file_bakem"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
            </div>
           <div class="form-group">
               <label for="exampleInputEmail1"></label>
               <span class="btn btn-default btn-file" >
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 20%; height: 20%;">
                    <p style="color: red"> Format file yang disarankan *rar dan zip</p>
                    <label>@if(empty($dataBapemById->scan_file)) Unggah File @else Nama File Sudah tersimpan :{{ str_limit($dataBapemById->scan_file,5) }} @endif </label></label><input type="file" name="scan_file"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
           </div>
           <div class="form-group">
               {{ csrf_field() }}
               <input type="hidden" name="id_spk" value="{{ $dataBapemById->id_spk }}">
               <input type="hidden" name="_method" value="put">
               <button type="submit" class="btn btn-primary pull-right">Simpan</button>
           </div>
       </div>
</div>
</form>



@section('plugins')
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        window.onload = function() {
            CKEDITOR.replace( 'isi_bakem',{
                height: 255
            } );
        };
    </script>
@stop