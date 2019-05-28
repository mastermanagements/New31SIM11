<div class="tab-pane active" id="tab_1">
    <div class="row">
        <div class="col-md-12">
            <label style="font-size: 23px">Psikotes</label>
            <a href="{{ url('jenis-psikotes') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Jenis Psikotes</a>
        </div>
        <div class="col-md-12">
            <h4>untuk Searching</h4>
            @foreach($loker as $lokers)
                @php($i=1)
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $lokers->nm_loker }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="col-md-12">
                    <p>Daftar nama pelamar yang telah lulus seleksi berkas</p>
                </div>
                <div class="box-body no-padding">

                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Pelamar</th>
                            <th>Posisi</th>
                            <th>Tanggal Tes</th>
                            <th style="width: 40px">Hasil</th>
                        </tr>
                        @if(!empty($data_lamaran_pek=$lokers->lamaran_pek))

                            @foreach($data_lamaran_pek as $data_lamaran_pek)
                                @if($data_lamaran_pek->seleksi_berkas['hasil']==1)
                                    <tr>
                                        <td class="no_index">{{ $i++ }}</td>
                                        <td>{{ $data_lamaran_pek->nm_pel }}</td>
                                        <td>{{ $data_lamaran_pek->posisi }}</td>
                                        <td>
                                            <span class="ubah-saat-diklik"><a href="#">Klik ini untuk isi tanggal</a></span>
                                        </td>
                                        <td><span class="badge bg-red">55%</span></td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Tidak ada pelamar</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            @endforeach
            {{ $loker->links() }}
        </div>
    </div>
</div>