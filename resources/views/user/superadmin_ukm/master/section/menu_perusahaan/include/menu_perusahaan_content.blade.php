<div>
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
					{{-- pisah link menu sesuai dg jenis perusahaan --}}
						{{--@if($perusahaan->jenis_usaha == '0')--}}
                        <a href="{{ url('pengaturan-menu/'. $perusahaan->id ) }}" class="btn btn-md btn-danger"><i class="fa fa-arrow-right"></i> Menu Utama  </a>
						{{--@elseif($perusahaan->jenis_usaha == '1')--}}
						{{--<a href="{{ url('pengaturan-menu-jasa/'. $perusahaan->id ) }}" class="btn btn-md btn-danger"><i class="fa fa-arrow-right"></i> Menu Utama  </a>--}}
						{{--@endif--}}
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