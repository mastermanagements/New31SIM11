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
                    @foreach($ST as $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->jabatan->nm_jabatan }}</td>
                        <td>{{ $value->item_tunjangan->nm_tunjangan}}</td>
                        <td>{{ $value->besar_tunjangan }}</td>
                        <td>@if($value->status_tunjangan==0)  <span class="badge bg-red" onclick="statuOnSkala('{{ $value->id }}')">Tunjangan Non Tetap</span>  @else <span class="badge bg-green" onclick="statuOffSkala('{{ $value->id }}')">Tunjangan Tetap</span>  @endif</td>
                        <td>
                            <form action="{{ url('delete-skala-tunjangan/'.$value->id) }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update_skala_tunjangan('{{ $value->id }}')" >Ubah</button>
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda akan menghapus data ini...?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>