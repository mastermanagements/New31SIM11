<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-pemodal"> <i class="fa fa-plus"></i> Pemodal</button>
                <table id="example1" class="table table-bordered table-striped tbdividenPerusahaan" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Investor</th>
                            <th>Periode</th>
                            <th>Nama Investor</th>
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
                            <td>{{ date('d-m-Y',strtotime($value->tgl_invest))}} </td>
                            <td>{{ $value->periode_investor->nm_periode }}</td>
                            <td>{{ $value->investor->nm_investor}}</td>
                            <td>{{ $value->bentuk_investor->bentuk_investasi }}</td>
                            <td>{{ number_format($value->persen_saham,2,',','.') }}</td>
                            <td>
                                <form action="{{ url('delete-pemodal/'. $value->id) }}" method="post">
                                    <input type="hidden" name="_method" value="put">
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-warning" onclick="edit_pemodal('{{ $value->id }}')">ubah</button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ... ?')">hapus</button>
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