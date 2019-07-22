<div class="row">
    <div class="col-md-4">

            <!-- /.box-header -->
            <form action="{{ url('store_skala_tunjangan') }}" method="post" id="formulir_skala_tunjangan">
                <div class="box-body" style="">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jabatan</label>
                        <select class="form-control select2" style="width: 100%;" name="id_jabatan" required>
                            @if(empty($jabatan))
                                <option>Jabatan Masih Kosong</option>
                            @else
                                @foreach($jabatan as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_jabatan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Item Tunjangan</label>
                        <select class="form-control select2" style="width: 100%;" name="id_item_tunjangan" required>
                            @if(empty($itemJabatan))
                                <option>Item tunjangan Masih Kosong</option>
                            @else
                                @foreach($itemJabatan as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_tunjangan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Besar Tunjangan</label>
                        <input type="number" class="form-control" name="besar_tunjangan" required>
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
                        <th>Jabatan</th>
                        <th>Item Tunjangan</th>
                        <th>Besar Tunjangan</th>
                        <th>Statu</th>
                        <th>Aksi</th>
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