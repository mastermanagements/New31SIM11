<div>
    @if($content_menu == "jabatan")
        <h3 style="text-align: center; margin-top: 5px; width: 100%">Pilihan Usaha Anda</h3>
    @else
        <a href="{{ url('tambah-usaha') }}" class="btn btn-block btn-info"><i class="fa fa-home"></i> Tambah Usaha</a>
    @endif

    @if(!empty(session('message_success')))
        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
    @elseif(!empty(session('message_fail')))
        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
    @endif
    <p></p>
    <div class="row">
        @if(empty($usaha))
            <div class="col-md-12">
                <a href="{{ url('tambah-usaha') }}" class="btn btn-block btn-info">
                    Anda Belum menambahkan usaha, Klik tombol ini untuk berahli ke Formulir Usaha ..!!
                </a>
            </div>
        @else
        @foreach($usaha as $perusahaan)
            <div class="col-md-6 col-md-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-home"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-number">{{ $perusahaan->nm_usaha }}</span>
                        <span class="progress-description">{{ $perusahaan->email }}</span>
                      <span class="progress-description">
                          @if($content_menu == "jabatan")
                          <a href="{{ url('pilih-usaha/'.$perusahaan->id.'/daftar-jabatan') }}" class="btn btn-xs btn-warning"><i ></i> Tampilkan semuah jabatan pada usaha ini </a>
                          @else
                          <form action="{{ url('delete-usaha/'.$perusahaan->id) }}" method="post">
                              <a href="{{ url('ubah-usaha/'.$perusahaan->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah </a>
                              {{ csrf_field() }}
                              <input name="_method" value="put" type="hidden">
                              <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini...?')"><i class="fa fa-trash"></i> Hapus </button>
                          </form>
                          @endif
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
         @endforeach
            {{ $usaha->links() }}
        @endif

    </div>
</div>