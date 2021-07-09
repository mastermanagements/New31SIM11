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
                    <span class="info-box-icon">
						<img class="profile-user-img img-responsive img-circle" src="
                            @if(empty($perusahaan->logo))
							                    {{ asset('image_superadmin_ukm/default.png') }}
							@else
							{{ asset('logoUsaha/'.$perusahaan->logo) }}
							@endif
							" alt="User profile picture">
					</span>

                    <div class="info-box-content">

                        <span class="info-box-number">{{ $perusahaan->nm_usaha }}
                            @if($perusahaan->jenis_kantor !== NULL)
                              @if($perusahaan->jenis_kantor =='0')
                                    (Pusat)
                              @else ($perusahaan->jenis_kantor =='1')
                                    (Cabang)
                              @endif
                            @endif
                        </span>
                        <span class="progress-description">{{ $perusahaan->alamat }}</span>
						<span class="progress-description">{{ $perusahaan->kode_pos }}</span>
						<span class="progress-description">{{ $perusahaan->getKabupaten->nama_kabupaten }}, {{ $perusahaan->getProvinsi->nama_provinsi }}</span>
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

        <!--tampilkan untuk menu profil perusahaan sj-->
      @if($content_menu == "profil")
				<div class="info-box bg-white">
          <ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Email</b> <a class="pull-right">{{ $perusahaan->email }}</a>
						</li>
						@if(!empty($perusahaan->telp))
						<li class="list-group-item">
							<b>Telp</b> <a class="pull-right">{{ $perusahaan->telp }}</a>
						</li>
						@endif
						<li class="list-group-item">
							<b>Hp</b> <a class="pull-right">{{ $perusahaan->hp }}</a>
						</li>
						<li class="list-group-item">
							<b>WA</b> <a class="pull-right">{{ $perusahaan->wa }}</a>
						</li>
						<li class="list-group-item">
							<b>Telegram</b> <a class="pull-right">{{ $perusahaan->teleg }}</a>
						</li>
						<li class="list-group-item">
							<b>Fans page</b> <a class="pull-right">{{ $perusahaan->fp }}</a>
						</li>
						<li class="list-group-item">
							<b>Twitter</b> <a class="pull-right">{{ $perusahaan->twitter }}</a>
						</li>
						<li class="list-group-item">
							<b>IG</b> <a class="pull-right">{{ $perusahaan->ig }}</a>
						</li>
						<li class="list-group-item">
							<b>Tiktok</b> <a class="pull-right">{{ $perusahaan->tiktok }}</a>
						</li>

						<li class="list-group-item">
							<b>Badan Usaha</b>
							<a class="pull-right">
								@if ($perusahaan->badan_usaha  ='0')
									PT
								@elseif($perusahaan->badan_usaha  ='1')
									CV
								@elseif($perusahaan->badan_usaha  ='2')
									UD
								@elseif($perusahaan->badan_usaha  ='3')
									Firma
								@elseif($perusahaan->badan_usaha  ='4')
									Koperasi
								@elseif($perusahaan->badan_usaha  ='5')
									Yayasan
								@elseif($perusahaan->badan_usaha  ='6')
									Belum ada
								@endif
							</a>
						</li>
						<li class="list-group-item">
							<b>Jenis Usaha</b>
							<a class="pull-right">
								@if ($perusahaan->jenis_usaha  ='0')
									Perdagangan
								@elseif($perusahaan->jenis_usaha  ='1')
									Jasa
								@elseif($perusahaan->jenis_usaha  ='2')
									Perdagangan dan Jasa
								@elseif($perusahaan->jenis_usaha  ='3')
									Manufaktur
								@endif
							</a>
						</li>
            <li class="list-group-item">
							<b>Jenis kantor</b>
							<a class="pull-right">
								@if ($perusahaan->jenis_kantor  ='0')
									Pusat
								@elseif($perusahaan->jenis_usaha  ='1')
									Cabang
								@endif
							</a>
						</li>
						<li class="list-group-item">
							<b>Bidang Usaha</b> <a class="pull-right">{{ $perusahaan->bidang_usaha }}</a>
						</li>
						<li class="list-group-item">
							<b>Spesifikasi Usaha</b> <a class="pull-right">{{ $perusahaan->spesifik_usaha }}</a>
						</li>
						@if(!empty($perusahaan->jenis_jasa) AND ($perusahaan->jenis_jasa='0'))
						<li class="list-group-item">
							<b>Jenis</b> <a class="pull-right">Jasa Murni</a>
						</li>
						@else
							<li class="list-group-item">
							<b>Jenis</b> <a class="pull-right">Jasa dan Barang</a>
						</li>
						@endif
						<li class="list-group-item">
							<b>Website</b> <a href="{{ $perusahaan->web }}" target="_blank" class="pull-right">{{ $perusahaan->web }}</a>
						</li>
          </ul>
					<!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        @endif
          </div>
         @endforeach
            {{ $usaha->links() }}
        @endif

    </div>
</div>
