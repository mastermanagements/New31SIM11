<div class="tab-pane active" id="tab_1">
    <div class="row">
        <div class="col-md-12">
            <label style="font-size: 23px">Daftar Kontrak Kerja</label>
            <a href="{{ url('tambah-kontrak') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Kontrak</a>
        </div>
        <div class="col-md-12" style="padding-top: 5px">
            <form action="{{ url('cari-loker-psikotes') }}" method="post" style="width: 100%">
                <div class="input-group input-group-md" >
                    {{ csrf_field() }}
                    <select class="form-control select2" style="width: 100%;" name="id_loker" required>
                        {{--@if(empty($lokers))--}}
                            {{--<option>Lowongan Kerjad masih kosong</option>--}}
                        {{--@else--}}
                            {{--@foreach($lokers as $value)--}}
                                {{--<option value="{{ $value->id }}">--}}
                                    {{--{{ $value->nm_loker}}--}}
                                {{--</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    </select>

                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-md-12" style="padding-top: 12px">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @if(empty($kontrak_kerja))
                <div class="col-md-4"> <h5>Data Kontra belum tersedia</h5></div>
            @else
                @foreach($kontrak_kerja as $value)
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-primary">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="@if(empty($value->karyawan->pas_foto)) {{ asset('image_superadmin_ukm/default.png') }}  @else {{ asset('filePFoto/'.$value->karyawan->pas_foto) }} @endif" alt="User Avatar">
                                </div>
                                <h3 class="widget-user-username">{{ $value->karyawan->nama_ky }}</h3>
                                <h5 class="widget-user-desc">Nik {{ $value->karyawan->nik }}</h5>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Nama <span class="pull-right">{{ $value->karyawan->nama_ky }}</span></a></li>
                                    <li><a href="#">Nik <span class="pull-right ">{{ $value->karyawan->nik }}</span></a></li>
                                    <li><a href="#">No. Kontrak<span class="pull-right ">{{ $value->no_kontrak }}</span></a></li>
                                    <li><a href="#">Jenis Kontrak<span class="pull-right ">{{ $value->jenis_kontrak->jenis_kontrak }}</span></a></li>
                                    <li>
                                        <form style="padding: 10px 15px ">
                                            Aksi Kontrak
                                            <a href="{{ url('hapus-kontrak/'. $value->id) }}" onclick="return confirm('Apakah anda akan menghapus kontrak ini...?')"><span class="pull-right badge bg-orange"><i class="fa fa-trash"></i></span></a>
                                            <a href="{{ url('ubah-kontrak/'. $value->id) }}"><span class="pull-right badge bg-red"><i class="fa fa-pencil"></i></span></a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                @endforeach
                {{ $kontrak_kerja->links() }}
            @endif
        </div>
    </div>
</div>