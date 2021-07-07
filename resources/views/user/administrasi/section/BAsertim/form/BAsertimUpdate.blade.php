@section('skin')
    <script src="https://cdn.ckeditor.com/4.11.3/basic/ckeditor.js"></script>
@stop


<form action="{{ url('BA-Sertim-update/'.$dataSertimById->id) }}" method="post" enctype="multipart/form-data">
<div class="col-md-8">
    <div class="box-body">
      <div class="form-group">
           <label for="exampleInputEmail1">Isi Berita Acara Serah Terima</label>
           <textarea class="form-control" placeholder="Masukan Isi Berita Acara Serah Terima" name="isi_basertim" id="isi_basertim" required>{!! $dataSertimById->isi_basertim !!}</textarea>
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
                    <label>@if(empty($dataSertimById->file_basertim)) Unggah File @else Nama File Sudah tersimpan :{{ str_limit($dataSertimById->file_basertim,5) }} @endif </label><input type="file" name="file_basertim"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
            </div>
           <div class="form-group">
               <label for="exampleInputEmail1"></label>
               <span class="btn btn-default btn-file" >
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 20%; height: 20%;">
                    <p style="color: red"> Format file yang disarankan *rar dan zip</p>
                    <label>@if(empty($dataSertimById->scan_file)) Unggah File @else Nama File Sudah tersimpan :{{ str_limit($dataSertimById->scan_file,5) }} @endif </label></label><input type="file" name="scan_file"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
           </div>
           <div class="form-group">
               {{ csrf_field() }}
               <input type="hidden" name="id_spk" value="{{ $dataSertimById->id_spk }}">
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
            CKEDITOR.replace( 'isi_basertim',{
                height: 255
            } );
        };
    </script>
@stop