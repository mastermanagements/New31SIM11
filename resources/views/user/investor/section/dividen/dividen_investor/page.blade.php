<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                 <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-dividen-investor"> <i class="fa fa-plus"></i> Dividen Investor</button>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Investor</th>
                        <th>Bulan Dividen</th>
                        <th>Besar Dividen</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data_dividen_investor as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->investor->nm_investor}}</td>
                            <td>{{ date('M', strtotime($value->bulan_dividen->bln_dividen)) }} {{ $value->bulan_dividen->thn_dividen }}</td>
                            <td>{{ number_format($value->besar_dividen,2,',','.') }}</td>
                             <td>
                                 <form action="{{ url('delete-saham-real/'. $value->id) }}" method="post">
                                     <input type="hidden" name="_method" value="put">
                                     {{ csrf_field() }}
                                    <button type="button" class="btn btn-warning" onclick="edit_dividen_investor('{{ $value->id }}')">ubah</button>
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