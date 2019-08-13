<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                 <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-saham-real"> <i class="fa fa-plus"></i> Dividen Investor</button>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Periode</th>
                         <th>Jumlah Saham Terbit</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    {{--@foreach($data as $value)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $i++ }}</td>--}}
                            {{--<td>{{ $value->periode_invest->periode_ke }}.{{ $value->periode_invest->nm_periode }} </td>--}}
                            {{--<td>{{ $value->jum_saham }}</td>--}}
                            {{--<td>Lembar</td>--}}
                             {{--<td>--}}
                                 {{--<form action="{{ url('delete-saham-real/'. $value->id) }}" method="post">--}}
                                     {{--<input type="hidden" name="_method" value="put">--}}
                                     {{--{{ csrf_field() }}--}}
                                    {{--<button type="button" class="btn btn-warning" onclick="edit_saham_real('{{ $value->id }}')">ubah</button>--}}
                                    {{--<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" >hapus</button>--}}
                                 {{--</form>--}}
                             {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>