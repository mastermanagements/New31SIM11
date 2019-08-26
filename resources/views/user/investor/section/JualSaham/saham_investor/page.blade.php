<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                 <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-jual-saham-investor"> <i class="fa fa-plus"></i>Jual Saham Investor</button>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Jual</th>
                        <th>Periode</th>
                        <th>Nama Penjual</th>
                        <th>Lembar Saham Penjual</th>
                        <th>Jumlah saham dijual</th>
                        <th>Nama Pembeli</th>
                        <th>Sisa Saham Penjual</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->tgl_jual_s)) }}</td>
                            <td>{{ $value->periode_invest->periode_ke }}.{{ $value->periode_invest->nm_periode }} </td>
                            <td>{{ $value->investor_penjual->nm_investor }}</td>
                            <td>{{ $value->lembar_saham_penjual }}</td>
                            <td>{{ $value->jumlah_dijual }}</td>
                            <td>{{ $value->investor_pembeli->nm_investor }}</td>
                            <td>{{ $value->sisa_saham_dijual }}</td>
                             <td>
                                 <form action="{{ url('delete-jual-saham-investor/'. $value->id) }}" method="post">
                                     <input type="hidden" name="_method" value="put">
                                     {{ csrf_field() }}
                                    <button type="button" class="btn btn-warning" onclick="edit_jual_saham_investor('{{ $value->id }}')">ubah</button>
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