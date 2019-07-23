<div class="row">
    <div class="col-md-4">

            <!-- /.box-header -->
            <form action="{{ url('store-kelas-proyek') }}" method="post" id="formulir_kelas_proyek">
                <div class="box-body" style="">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" class="form-control" name="nm_kelas" required>
                        <small style="color: red"> * Tidak Boleh Kosong </small>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan" required></textarea>
                        <small style="color: red"> * Tidak Boleh Kosong </small>
                    </div>
                    <div class="form-group">
                        <label>Persen Besar Proyek</label>
                        <input type="number" class="form-control" name="persen_besar_proyek" required>
                        <small style="color: red"> * Tidak Boleh Kosong </small>
                    </div>
                </div>
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <!-- /.box-body -->

    </div>
    <div class="col-md-8">

            <!-- /.box-header -->
            <div class="box-body" style="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>Keterangan</th>
                        <th>Persen</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data as $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->nm_kelas }}</td>
                        <td>{{ $value->keterangan }}</td>
                        <td>{{ $value->persen_besar_proyek }}</td>
                        <td>
                            <form action="{{ url('delete-kelas-proyek/'.$value->id) }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update_kelas_proyek('{{ $value->id }}')" >Ubah</button>
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