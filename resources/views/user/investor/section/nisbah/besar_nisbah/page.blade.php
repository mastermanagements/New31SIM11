<div class="row">

    <div class="col-md-12">
            <!-- /.box-header -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Tahun dividen</label>
                <input type="text" class="form-control" name="thn" id="datepicker3" value="{{ $thn_proses }}">
                <small style="color: darkgray">* Tahun akan disetting otomatis berdasarkan tahun server</small>
            </div>
        </div>
            <div class="box-body" style="">

                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-besar-nisbah"> <i class="fa fa-plus"></i> Besar Nisbah</button>
                    </div>
                    <div class="col-md-4">
                        @if(!empty(session('message_success')))
                            <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                        @elseif(!empty(session('message_fail')))
                            <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-danger pull-right" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-nisbah"> <i class="fa fa-book"></i> Daftar Nisbah</button>
                    </div>
                </div>

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
                    {{--@foreach($data_p as $value)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $i++ }}</td>--}}
                            {{--<td>{{ $value->karyawan->nama_ky }}</td>--}}
                            {{--<td>{{ $value->periode_invest->nm_periode}}</td>--}}
                            {{--<td>{{ $value->bentuk_invest->bentuk_investasi }}</td>--}}
                            {{--<td>{{ $value->persen_saham }}</td>--}}
                             {{--<td>--}}
                                 {{--<form action="{{ url('delete-pelaksana/'. $value->id) }}" method="post">--}}
                                     {{--<input type="hidden" name="_method" value="put">--}}
                                     {{--{{ csrf_field() }}--}}
                                    {{--<button type="button" class="btn btn-warning" onclick="edit_pelaksana('{{ $value->id }}')">ubah</button>--}}
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