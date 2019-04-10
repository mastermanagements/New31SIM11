@section('skin')
    <script src="https://cdn.ckeditor.com/4.11.3/basic/ckeditor.js"></script>
@stop



<form action="{{ url('BA-Kemajuan') }}" method="post" enctype="multipart/form-data">
<div class="col-md-8">
    <div class="box-body">
      <div class="form-group">
           <label for="exampleInputEmail1">Isi Berita Acara Kemajuan</label>
           <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_bakem" id="isi_bakem" required></textarea>
           <small style="color: red">* Tidak boleh kosong</small>
      </div>
    </div>
</div>
<div class="col-md-3">
       <div class="box-body" >
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                 <span class="btn btn-default btn-file" >
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 20%; height: 20%;">
                    <p style="color: red"> Format file yang disarankan *rar dan zip</p>
                    <label>Unggah File BA. Kemajuan</label><input type="file" name="file_bakem"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
            </div>
           <div class="form-group">
                <label for="exampleInputEmail1"></label>
                 <span class="btn btn-default btn-file" >
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 20%; height: 20%;">
                    <p style="color: red"> Format file yang disarankan *rar dan zip</p>
                    <label>Unggah Scan File BA. Kemajuan</label><input type="file" name="scan_file"><br>
                    <small style="color: blue">* Unggah file bisa dilakukan kapan saja.</small>
                </span>
            </div>
           <div class="form-group">
               {{ csrf_field() }}
               <input type="hidden" name="id_spk" value="{{ $spk->id }}">
               <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
