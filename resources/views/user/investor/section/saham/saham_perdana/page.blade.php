<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                @if($data->count('id') <= 0 )
                     <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-saham-perdana"> <i class="fa fa-plus"></i> Saham Perdana</button>
                @endif

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Periode</th>
                        <th>Valuasi</th>
                        <th>Jumlah Saham Terbit</th>
                        <th>Satuan</th>
                        <th>Nilai Per Lembar Saham</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->periode_invest->periode_ke }}.{{ $value->periode_invest->nm_periode }} </td>
                            <td>{{ $value->periode_invest->nilai_valuasi }}</td>
                            <td>{{ $value->lembar_saham_perdana }}</td>
                            <td>Lembar</td>
                            <td>{{ $value->nilai_saham }}</td>
                            <td><button class="btn btn-warning" onclick="edit_saham_perdana('{{ $value->id }}')">ubah</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>