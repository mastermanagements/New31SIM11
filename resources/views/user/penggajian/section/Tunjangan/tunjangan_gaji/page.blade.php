<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Jumlah Tunjangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($ky as $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->nama_ky }}</td>
                        <td>@if(!empty($value->jabatan_ky->getJabatan)) {{ $value->jabatan_ky->getJabatan->nm_jabatan }} @else <p style="color: red">Karyawan ini belum mendapatkan jabatan</p> @endif</td>
                        <td><a href="{{ url('detail-daftar-tunjangan/'.$value->id) }}"> <span class="badge bg-green">@if(!empty($value->getMannyTunjangan )) {{ $value->getMannyTunjangan->count('status_aktif') }} @else <p style="color: red">Tunjangan belum dimasukan</p> @endif</span> </a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>