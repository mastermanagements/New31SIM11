<div class="tab-pane active" id="tab_1">
    <div class="row">
        <div class="col-md-12">
            <label style="font-size: 23px">Keahlian</label>
            <a href="{{ url('item-keahlian') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Item Keahlian</a>
        </div>

        <div class="col-md-12" style="padding-top: 5px">
            <form action="{{ url('cari-loker-keahlian') }}" method="post" style="width: 100%">
                <div class="input-group input-group-md" >
                    {{ csrf_field() }}
                    <select class="form-control select2" style="width: 100%;" name="id_loker" required>
                        @if(empty($lokers))
                            <option>Lowongan Kerjad masih kosong</option>
                        @else
                            @foreach($lokers as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->nm_loker}}
                                </option>
                            @endforeach
                        @endif
                    </select>

                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-12" style="padding-top: 12px">
            @foreach($loker as $lokers)
                @php($i=1)
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="color: #0b93d5">{{ $lokers->nm_loker }}</h3>
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
                                <th  >Hasil</th>
                                <th style="width: 40px">Proses</th>
                            </tr>
                            @if(!empty($data_lamaran_pek=$lokers->lamaran_pek))

                                @foreach($data_lamaran_pek as $key=> $data_lamaran_pek)
                                    @php($hasil=0)
                                    @if($data_lamaran_pek->seleksi_berkas['hasil']==1)
                                        <tr>
                                            <td class="no_index">{{ $i++ }}</td>
                                            <td>{{ $data_lamaran_pek->nm_pel }}</td>
                                            <td>{{ $data_lamaran_pek->posisi }}</td>
                                            <td>
                                                @if($data_lamaran_pek->tes_keahlian->sum('nilai_akhir') !=0 && $data_lamaran_pek->tes_keahlian->count('nilai_akhir')!=0)
                                                    @php($hasil=$data_lamaran_pek->tes_keahlian->sum('nilai_akhir')/$data_lamaran_pek->tes_keahlian->count('nilai_akhir'))
                                                @endif
                                                {{ $hasil }}
                                            </td>
                                            <td><a href="{{ url('mulai-tes-keahlian/'.$data_lamaran_pek->id) }}" class="btn bg-green" ><i class="fa fa-file-text" ></i> Mulai Tes Keahlian </a></td>
                                        </tr>
                                    @endif
                                @endforeach
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