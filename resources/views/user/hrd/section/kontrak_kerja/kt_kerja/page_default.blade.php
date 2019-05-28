<div class="tab-pane active" id="tab_1">
    <div class="row">
        <div class="col-md-12">
            <label style="font-size: 23px">Psikotes</label>
            <a href="{{ url('jenis-psikotes') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Jenis Psikotes</a>
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
            {{--@foreach($loker as $lokers)--}}
                {{--@php($i=1)--}}
            {{--<div class="box">--}}
                {{--<div class="box-header">--}}
                    {{--<h3 class="box-title" style="color: #0b93d5">{{ $lokers->nm_loker }}</h3>--}}
                {{--</div>--}}
                {{--<!-- /.box-header -->--}}
                {{--<div class="col-md-12">--}}
                    {{--<p>Daftar nama pelamar yang telah lulus seleksi berkas</p>--}}
                {{--</div>--}}
                {{--<div class="box-body no-padding">--}}

                    {{--<table class="table table-striped">--}}

                        {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<th style="width: 10px">#</th>--}}
                            {{--<th>Nama Pelamar</th>--}}
                            {{--<th>Posisi</th>--}}
                            {{--<th>Tanggal Tes</th>--}}
                            {{--<th>Jenis Tes</th>--}}
                            {{--<th style="width: 40px">Hasil</th>--}}
                            {{--<th style="width: 40px">Proses</th>--}}
                        {{--</tr>--}}
                        {{--@if(!empty($data_lamaran_pek=$lokers->lamaran_pek))--}}

                            {{--@foreach($data_lamaran_pek as $key=> $data_lamaran_pek)--}}
                                {{--@if($data_lamaran_pek->seleksi_berkas['hasil']==1)--}}
                                    {{--<tr>--}}
                                        {{--<td class="no_index">{{ $i++ }}</td>--}}
                                        {{--<td>{{ $data_lamaran_pek->nm_pel }}</td>--}}
                                        {{--<td>{{ $data_lamaran_pek->posisi }}</td>--}}
                                        {{--<td>--}}
                                            {{--<div class="input-group date">--}}
                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-calendar"></i>--}}
                                                {{--</div>--}}
                                                {{--<input type="text" class="form-control eventDate" name="tgl_tes" @if(!empty($tgl_tes=$data_lamaran_pek->psikotes['tgl_tes'])) value="{{ date('d-m-Y', strtotime($tgl_tes)) }}" @endif placeholder="Klik untuk mengisinya">--}}
                                                {{--<input type="hidden" id="id_oel{{ $key }}" value="{{ $data_lamaran_pek->id }}">--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<select class="form-control select2" style="width: 100%;" name="id_jenis_psikotes" id="idTes{{ $key }}" required>--}}
                                                {{--@if(empty($jenis_psikotes))--}}
                                                    {{--<option>Jenis Psikotes masih kosong</option>--}}
                                                {{--@else--}}
                                                    {{--@foreach($jenis_psikotes as $value)--}}
                                                        {{--<option value="{{ $value->id }}"--}}
                                                            {{--@if(!empty($id_jenis_psikotes=$data_lamaran_pek->psikotes['id_jenis_psikotes']))--}}
                                                                {{--@if($id_jenis_psikotes==$value->id)--}}
                                                                    {{--selected--}}
                                                                {{--@endif--}}
                                                            {{--@endif  >{{ $value->jenis_psikotes}}--}}
                                                        {{--</option>--}}
                                                    {{--@endforeach--}}
                                                {{--@endif--}}
                                            {{--</select>--}}
                                        {{--</td>--}}
                                        {{--<td><input type="number" min="0" max="100" id="hasil{{ $key }}" class="form-control" style="width: 80px" value="{{ $data_lamaran_pek->psikotes['nilai_akhir'] }}"/></td>--}}
                                        {{--<td><button class="btn bg-green" onclick="simpan('{{ $data_lamaran_pek->id }}', '{{ $key }}')"><i class="fa fa-save" id="loading{{ $key }}"></i> Simpan</button></td>--}}
                                    {{--</tr>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
                {{--<!-- /.box-body -->--}}
            {{--</div>--}}
            {{--@endforeach--}}
            {{--{{ $loker->links() }}--}}
        </div>
    </div>
</div>