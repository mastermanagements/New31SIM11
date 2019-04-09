<form action="{{ url('Proses-BApem') }}" method="post" enctype="multipart/form-data">
<div class="col-md-8">
    <div class="box-body">
      <div class="form-group">
           <label for="exampleInputEmail1">Isi Berita Acara Pemeriksaan</label>
           <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_bapem" id="isi_bapem" required></textarea>
           <small style="color: red">* Tidak boleh kosong</small>
      </div>
    </div>
</div>
<div class="col-md-3">
       <div class="box-body" >
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <label for="exampleInputEmail1"></label>
                <label for="exampleInputEmail1"></label>
                <span class="btn btn-default btn-file" style="height: 200px;" sty>
                    <img src="{{ asset('component/icon_plus.png') }}" style="width: 40%; height: 40%; margin-top: 40px">
                    <p></p>
                    <label>Unggah File</label><input type="file" name="file_bapem"><br>
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