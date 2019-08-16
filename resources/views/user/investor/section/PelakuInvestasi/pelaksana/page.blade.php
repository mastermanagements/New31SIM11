<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                 <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-pelaksana"> <i class="fa fa-plus"></i> Pelaksana</button>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Karyawan</th>
                        <th>Periode Investasi</th>
                        <th>Bentuk Investasi</th>
                        <th>Persen Saham</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data_p as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->karyawan->nama_ky }}</td>
                            <td>{{ $value->periode_invest->nm_periode}}</td>
                            <td>{{ $value->bentuk_invest->bentuk_investasi }}</td>
                            <td>{{ $value->persen_saham }}</td>
                             <td>
                                 <form action="{{ url('delete-pelaksana/'. $value->id) }}" method="post">
                                     <input type="hidden" name="_method" value="put">
                                     {{ csrf_field() }}
                                    <button type="button" class="btn btn-warning" onclick="edit_pelaksana('{{ $value->id }}')">ubah</button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" >hapus</button>
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