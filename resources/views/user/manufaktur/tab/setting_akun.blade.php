<div class="tab-pane" id="tab_5">
    <a href="{{ url('akun-manufaktur/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</a>
    <p></p>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered " style="width: 100%;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Transaksi</th>
                    <th>Keterangan transaksi</th>
                    <th>Kode & Nama Akun</th>
                    <th>Posisi</th>
                </tr>
                </thead>
                @if(!empty($akun_manufaktur))
                    @php($no=1)
                    @foreach($akun_manufaktur as $data)
                        @php($rowspan = 0)
                        @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                            @if($rows=$data->linkToOneKetTransaksi->dataAkun->count())
                                @php($rowspan=$rows+1)
                            @endif
                        @endif
                        <tr>
                            <th rowspan="{{ $rowspan }}">{{ $no++ }}</th>
                            <th rowspan="{{ $rowspan }}">{{ $jenis_jurnal[$data->jenis_jurnal] }}<br><a href="{{ url('akun-manufaktur/'.$data->id.'/edit') }}">ubah</a> <a href="{{ url('akun-manufaktur-delete/'.$data->id) }}" onclick="return confirm('Apakah anda akan menghapus akun manufaktur ini.');">hapus</a> </th>
                            <th rowspan="{{ $rowspan }}">{{ $data->linkToOneKetTransaksi->nm_transaksi }}</th>
                        </tr>
                        @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                            @if($data_ket=$data->linkToOneKetTransaksi->dataAkun)
                                @foreach($data_ket as $data)
                                    <tr>
                                        <td>{{ $data->transaksi->kode_akun_aktif }} {{ $data->transaksi->nm_akun_aktif }}</td>
                                        <td>@if($data->posisi_akun=='0') D @else K @endif</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>