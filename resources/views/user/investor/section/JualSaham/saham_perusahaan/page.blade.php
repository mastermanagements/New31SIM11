<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-jual-saham-perusahaan"> <i class="fa fa-plus"></i> Tambah Persentase Saham Yang akan dijual</button>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Periode</th>
                        <th>Jual Persen Saham</th>
                        <th>Jumlah Saham Terbit</th>
                       <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->periode_invest->periode_ke }}.{{ $value->periode_invest->nm_periode }} </td>
                            <td>{{ $value->jumlah_persen_saham }}</td>
                            <td>{{ $value->jumlah_saham_terbit }}</td>
                            <td>
                                <form action="{{ url('hapus-jual-saham-perusahaan/'.$value->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put">
                                    <button type="button" class="btn btn-warning" onclick="edit_jual_saham_perusahaan('{{ $value->id }}')">ubah</button>
                                    <button type="submit" value="" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ...?')">hapus</button>
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