<div class="row">
    <div class="col-md-12">

            <!-- /.box-header -->
            <div class="box-body" style="">
                <h3 style="margin-top: 0px">Skala Tunjangan Proyek {{ $proyek->spk->nm_spk }}</h3>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Posisi</th>
                        <th>Acuan Perhitungan Tunjangan</th>
                        @if(!empty($kelas_proyek))
                            @foreach($kelas_proyek as $data)
                                <th>{{ $data->nm_kelas }}</th>
                            @endforeach
                        @else
                            <th>Kelas Proyek belum anda masukan</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @if(!empty($proyek->timProyek))
                        @foreach($proyek->timProyek as $tim_proyek)
                                <tr>
                                    <form action="{{ url('proses-skala-bonus-proyek/'.$proyek->id) }}" method="post">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $tim_proyek->jabatan_proyek }}</td>
                                            <th><input type="number" name="apt" class="form-control" value="@if(!empty($tim_proyek->bonus_proyek->nilai_apt)){{ $tim_proyek->bonus_proyek->nilai_apt }}@endif"></th>
                                            @if(!empty($kelas_proyek))
                                                @foreach($kelas_proyek as $data)
                                                    <th>
                                                        <input type="hidden" name="id_kelas_proyek[]" value="{{ $data->id }}">
                                                        <input class="form-control" type="text" value="{{ $tim_proyek->mannyBonusProject->where('id_kelas_proyek', $data->id)->first()['besar_tunjangan'] }}" readonly>

                                                    </th>
                                                @endforeach
                                            @else
                                                <th>Kelas Proyek belum anda masukan</th>
                                            @endif
                                            <td>
                                                {{ csrf_field() }}
                                                <button type="submit" value="{{ $tim_proyek->id }}" name="id_tim_proyek" class="btn btn-success">Proses</button>
                                            </td>
                                    </form>
                                </tr>

                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>